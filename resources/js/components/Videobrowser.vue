<template>
    <div>
        <div v-if="loading" class="flex items-center">
            <div role="status" class="mt-4 mx-auto">
                <svg aria-hidden="true" class="w-8 h-8 mr-2 animate-spin" viewBox="0 0 100 101" style="color: #eef2f6" fill="#2D9EFC" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div v-else-if="!loading && videos.totalItems >= 1">
            <div id="card">
                <div class="container w-100 lg:w-4/5 mx-auto flex flex-col">
                    <div v-for="video in videos.items">
                        <div v-if="video.status >= 4" class="flex flex-col md:flex-row overflow-hidden bg-white rounded shadow-xl w-full mb-4">
                            <a :href="'https://iframe.mediadelivery.net/play/' + video.videoLibraryId + '/' + video.guid" target="_blank" class="h-64 w-auto md:w-1/2">
                                <img class="inset-0 h-full w-full object-cover object-center" :src="'https://' + hostname + '/' + video.guid + '/' + video.thumbnailFileName" />
                            </a>
                            <div class="w-full md:w-2/3 py-4 px-6 text-gray-800 flex flex-col justify-between">
                                <div class="flex justify-between">
                                    <a :href="'https://iframe.mediadelivery.net/play/' + video.videoLibraryId + '/' + video.guid" target="_blank" class="font-semibold text-lg leading-tight truncate mr-6">{{ video.title }}</a>
                                    <div class="flex">
                                        <video-settings
                                            :api="api"
                                            :library="library"
                                            :hostname="hostname"
                                            :id="video.guid"
                                            :title="video.title"
                                        ></video-settings>
                                        <button @click="confirmDeletion(video.guid, video.title)">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <p class="mt-2 flex justify-start">
                                    <a :href="'https://iframe.mediadelivery.net/play/' + library + '/' + video.guid + ''" target="_blank" class="flex justify-start items-center">
                                        Direct Play
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="ml-1 w-4 h-4">
                                            <path fill-rule="evenodd" d="M4.25 5.5a.75.75 0 00-.75.75v8.5c0 .414.336.75.75.75h8.5a.75.75 0 00.75-.75v-4a.75.75 0 011.5 0v4A2.25 2.25 0 0112.75 17h-8.5A2.25 2.25 0 012 14.75v-8.5A2.25 2.25 0 014.25 4h5a.75.75 0 010 1.5h-5z" clip-rule="evenodd" />
                                            <path fill-rule="evenodd" d="M6.194 12.753a.75.75 0 001.06.053L16.5 4.44v2.81a.75.75 0 001.5 0v-4.5a.75.75 0 00-.75-.75h-4.5a.75.75 0 000 1.5h2.553l-9.056 8.194a.75.75 0 00-.053 1.06z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a :href="'https://' + hostname + '/' + video.guid + '/' + video.thumbnailFileName" target="_blank" class="flex ml-6 justify-start items-center">
                                        Thumbnail
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="ml-1 w-4 h-4">
                                            <path fill-rule="evenodd" d="M4.25 5.5a.75.75 0 00-.75.75v8.5c0 .414.336.75.75.75h8.5a.75.75 0 00.75-.75v-4a.75.75 0 011.5 0v4A2.25 2.25 0 0112.75 17h-8.5A2.25 2.25 0 012 14.75v-8.5A2.25 2.25 0 014.25 4h5a.75.75 0 010 1.5h-5z" clip-rule="evenodd" />
                                            <path fill-rule="evenodd" d="M6.194 12.753a.75.75 0 001.06.053L16.5 4.44v2.81a.75.75 0 001.5 0v-4.5a.75.75 0 00-.75-.75h-4.5a.75.75 0 000 1.5h2.553l-9.056 8.194a.75.75 0 00-.053 1.06z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </p>
                                <div class="text-sm text-gray-600 flex justify-between">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-gray-500 w-5 h-5 mr-2">
                                            <path fill-rule="evenodd" d="M10.5 3.75a6 6 0 00-5.98 6.496A5.25 5.25 0 006.75 20.25H18a4.5 4.5 0 002.206-8.423 3.75 3.75 0 00-4.133-4.303A6.001 6.001 0 0010.5 3.75zm2.03 5.47a.75.75 0 00-1.06 0l-3 3a.75.75 0 101.06 1.06l1.72-1.72v4.94a.75.75 0 001.5 0v-4.94l1.72 1.72a.75.75 0 101.06-1.06l-3-3z" clip-rule="evenodd" />
                                        </svg>
                                        {{ new Date(video.dateUploaded).toLocaleString() }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-gray-500 w-5 h-5 mr-2">
                                            <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                            <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
                                        </svg>
                                        {{ video.views }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-else class="flex flex-col overflow-hidden bg-white rounded shadow-xl w-full mb-4 p-6 items-center justify-center">
                            <h2 class="text-lg">Video wird verarbeitet - {{ video.encodeProgress * 2 }}%</h2>
                            <p class="text-xs text-gray-600">Dies kann einige Zeit in Anspruch nehmen.</p>
                            <button class="text-xs text-red-500" @click="confirmDeletion(video.guid, video.title)">Abbrechen und Video löschen</button>
                            <div role="status" class="mt-4 mx-auto">
                                <svg aria-hidden="true" class="w-8 h-8 mr-2 animate-spin" viewBox="0 0 100 101" style="color: #eef2f6" fill="#2D9EFC" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button @click="openUpload()" v-else class="flex flex-col overflow-hidden border-gray-600 border-dashed border-2 rounded shadow-xl w-full mb-4 p-6 items-center justify-center">
            <h2 class="text-xl">Video hochladen</h2>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </button>

        <confirmation-modal
            v-if="triggerDeletion"
            :title="'Video ' + this.videoTitleToDelete + ' löschen?'"
            @confirm="deleteVideo"
            @cancel="cancelDeletion"
            danger="true"
        />
    </div>
</template>
<script>
import axios from 'axios';
import { emitter } from '@/cp.js';

export default {
    data() {
        return {
            loading: true,
            polling: null,
            videos: null,
            triggerDeletion: false,
            videoToDelete: null,
            videoTitleToDelete: null,
        }
    },
    props: {
        api: String,
        library: Number,
        hostname: String
    },
    created() {
        this.getVideos();
        emitter.on('load', e => this.getVideos());

	    this.pollData()
    },
    methods: {
        pollData () {
            this.polling = setInterval(() => {
                this.getVideos();
            }, 3000)
        },
        getVideos() {
            const options = {
                method: 'GET',
                url: 'https://video.bunnycdn.com/library/' + this.library + '/videos?page=1&itemsPerPage=100&orderBy=date',
                headers: {
                    accept: 'application/json',
                    AccessKey: this.api
                }
            };

            axios
            .request(options)
            .then((response) => {
                this.videos = response.data;
                this.loading = false;
            })
            .catch(function (error) {
                console.error(error);
            });
        },
        confirmDeletion(videoId, videoTitle) {
            this.triggerDeletion = true;
            this.videoToDelete = videoId;
            this.videoTitleToDelete = videoTitle;
        },
        deleteVideo() {
            this.loading = true;

            const options = {
                method: 'DELETE',
                url: 'https://video.bunnycdn.com/library/' + this.library + '/videos/' + this.videoToDelete,
                headers: {
                    accept: 'application/json',
                    AccessKey: this.api
                }
            };

            axios
            .request(options)
            .then((response) => {
                this.cancelDeletion();
                this.loading = false;
                this.$toast.success('Video erfolgreich gelöscht.');
                this.getVideos();
            })
            .catch(function (error) {
                console.error(error);
            });
        },
        cancelDeletion() {
            this.videoToDelete = null;
            this.videoTitleToDelete = null;
            this.triggerDeletion = false;
        },
        openUpload() {
            emitter.emit('upload');
        }
    }
}
</script>

<style>
.animate-spin {
    animation: spin 1s linear infinite;
}

@keyframes spin {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}
</style>