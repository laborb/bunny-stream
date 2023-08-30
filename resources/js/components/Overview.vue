<template>
    <div>
        <div class="flex justify-between">
            <h1 class="mb-4">Videos</h1>
            <button class="btn-primary" id="uppy">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                </svg>
                Upload Video
            </button>
        </div>
        <videobrowser
            :api="api"
            :library="library"
            :hostname="hostname"
        ></videobrowser>
    </div>
</template>
<script>
import Uppy from '@uppy/core';
import Dashboard from '@uppy/dashboard';
import Tus from '@uppy/tus';
import axios from 'axios';
import { sha256 } from 'js-sha256';
import { emitter } from '@/cp.js';

export default {
    data() {
        return {
            isOpen: false,
            uppy: null,
            continueUpload: true,
            expirationTime: 234567891,
        }
    },
    props: {
        api: String,
        library: Number,
        hostname: String
    },
    created() {
        emitter.on('upload', e => document.getElementById('uppy').click());
    },
    mounted() {
        this.expirationTime = this.getExpirationTime();

        this.uppy = new Uppy({
            onBeforeUpload: (files) => {
                this.continueUpload = true;

                Object.keys(files).forEach(key => {
                    this.createVideo(files[key]);
                });

                return this.continueUpload;
            },
        })
        .use(Dashboard, {
            inline: false,
            trigger: '#uppy',
            width: 'auto',
            proudlyDisplayPoweredByUppy: false,
            closeModalOnClickOutside: true,
            closeAfterFinish: true,
            metaFields: [
                { id: 'name', name: 'Name', placeholder: 'Dateiname' },
                { id: 'bunnyId', name: 'Bunny ID', 
                    render: ({ value }, h) => {
                        return h(
                            'input',
                            {
                                type: 'text',
                                class: 'uppy-u-reset uppy-c-textInput uppy-Dashboard-FileCard-input bg-gray-300',
                                value: value,
                                placeholder: 'Bunny ID',
                                disabled: true
                            },
                            []
                        );
                    }
                }
            ],
        })
        .use(Tus, { 
            endpoint: "https://video.bunnycdn.com/tusupload",
            retryDelays: [0, 30, 50, 3000, 5000, 10000, 60000],
            onBeforeRequest: (req, file) => {
                if(typeof this.uppy.getFile(file.id).meta.bunnyId !== 'undefined') {
                    req.setHeader('AuthorizationSignature', this.getAuthorizationSignature(this.uppy.getFile(file.id).meta.bunnyId));
                    req.setHeader('AuthorizationExpire', this.expirationTime);
                    req.setHeader('VideoId', this.uppy.getFile(file.id).meta.bunnyId); // the GUID returned after "preparing" (creating) the video
                    req.setHeader('LibraryId', this.library); // fixed or whatever you'd like
                } else {
                    throw '';
                }
            }
            });

            this.uppy.on('complete', (result) => {
                if(result.successful.length > 0) {
                    if(result.successful.length == 1) {
                        this.$toast.success(result.successful.length + ' Video erfolgreich hochgeladen.');
                    } else {
                        this.$toast.success(result.successful.length + ' Videos erfolgreich hochgeladen.');
                    }
                }

                if(result.failed.length > 0) {
                    console.log('failed files: ', result.failed);
                }

                emitter.emit('load');
            });
    },
    methods: {
        createVideo(file) {
            let options = {
                method: 'POST',
                url: 'https://video.bunnycdn.com/library/' + this.library + '/videos',
                headers: {
                    accept: 'application/json',
                    'content-type': 'application/*+json',
                    AccessKey: this.api
                },
                data: '{"title": "' + file.meta.name + '"}'
            };

            axios
            .request(options)
            .then(response => {
                this.uppy.setFileMeta(file.id, { bunnyId: response.data.guid });
            })
            .catch(function (error) {
                console.error(error);

                // Block upload if an error occurs
                this.continueUpload = false;
            });
        },

        getAuthorizationSignature(videoId) {
            let signature = this.library + this.api + this.expirationTime + videoId;

            return sha256(signature);
        },

        getExpirationTime() {
            const d = new Date()
            d.setDate(d.getDate() + 1)
            return d.getTime()
        }
    }
}
</script>