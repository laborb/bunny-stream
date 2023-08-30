import Overview from './components/Overview.vue';
import Videobrowser from './components/Videobrowser.vue';
import Fieldtype from './components/fieldtypes/Bunny.vue';

import mitt from 'mitt'

export const emitter = mitt()

import '@uppy/core/dist/style.css';
import '@uppy/dashboard/dist/style.css';
 
Statamic.booting(() => {
    Statamic.$components.register('overview', Overview);
    Statamic.$components.register('videobrowser', Videobrowser);
    Statamic.$components.register('bunny-fieldtype', Fieldtype);
});