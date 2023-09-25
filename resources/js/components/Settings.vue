<template>
    <div>
        <button @click="isOpen = true" class="mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </button>

        <modal
            v-if="isOpen"
            name="settings"
            @closed="isOpen = false"
        >
            <div class="flex flex-col h-full">
                <header class="text-lg font-semibold px-5 py-3 bg-gray-200 rounded-t-lg flex items-center justify-between border-b">
                    {{ __('Video Einstellungen') }}
                </header>
                <div class="flex-1 px-5 py-6 text-gray">
                    <div class="px-2 m-0 @container form-group publish-field text-fieldtype w-full">
                        <label for="title" class="block">Titel</label>
                        <div class="input-group">
                            <input type="text" id="title" name="title" v-model="videoTitle" class="input-text">
                        </div>
                    </div>

                    <div class="px-2 m-0 @container form-group publish-field text-fieldtype w-full">
                        <label for="thumbnail" class="block">Thumbnail URL</label>
                        <div class="input-group">
                            <input type="text" id="thumbnail" name="thumbnail" v-model="thumbnailUrl" class="input-text">
                        </div>
                        <small class="text-xs">Wenn das Thumbnail geändert werden soll, kann hier die direkte URL zum neuen Bild eingegeben werden.</small>
                    </div>
                </div>
                <div class="px-5 py-3 bg-gray-200 rounded-b-lg border-t flex items-center justify-end text-sm">
                    <button class="text-gray hover:text-gray-900" @click="isOpen = false" v-text="__('Cancel')" />
                    <button class="ml-4 btn-primary" :class="buttonClass" v-text="__('Save')" @click="save" />
                </div>
            </div>
        </modal>
    </div>
</template>
<script>
import axios from 'axios';
import { emitter } from '@/cp.js';

export default {
    data() {
        return {
            isOpen: false,
            videoTitle: this.title,
            thumbnailUrl: null
        }
    },
    props: {
        id: String,
        title: String,
        api: String,
        library: Number,
        hostname: String
    },
    methods: {
        save() {
            if(this.title != this.videoTitle) {
                this.$progress.start('title');
                this.changeTitle();
            }

            if(this.thumbnailUrl != null) {
                this.$progress.start('thumbnail');
                this.changeThumbnail();
            }

            this.isOpen = false;
        },
        changeTitle() {
            const options = {
                method: 'POST',
                url: 'https://video.bunnycdn.com/library/' + this.library + '/videos/' + this.id,
                headers: {
                    accept: 'application/json',
                    'content-type': 'application/*+json',
                    AccessKey: this.api
                },
                data: '{"title":"' + this.videoTitle + '"}'
            };

            axios
            .request(options)
            .then((response) => {
                this.$toast.success('Videoname wurde geändert');
                this.$progress.complete('title');
                emitter.emit('load');
            })
            .catch((error) => {
                this.$toast.error('Fehler beim Speichern');
                console.error(error);
                this.$progress.complete('title');
            });
        },
        changeThumbnail() {
            const options = {
                method: 'POST',
                url: 'https://video.bunnycdn.com/library/' + this.library + '/videos/' + this.id + '/thumbnail?thumbnailUrl=' + this.thumbnailUrl,
                headers: {
                    accept: 'application/json',
                    AccessKey: this.api
                }
            };

            axios
            .request(options)
            .then((response) => {
                this.$toast.success('Thumbnail wurde geändert.');
                this.thumbnailUrl = null;
                this.$progress.complete('thumbnail');
                emitter.emit('load');
            })
            .catch((error) => {
                this.$toast.error('Fehler beim Ändern des Thumbnails');
                console.error(error);
                this.$progress.complete('thumbnail');
            });
        },
    }
}
</script>