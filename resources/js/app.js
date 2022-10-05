require('./bootstrap');

// Import modules...
import Vue from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';
import PortalVue from 'portal-vue';
import vuetify from './vuetify';
import { Model } from 'vue-api-query'
import { TiptapVuetifyPlugin } from 'tiptap-vuetify'

Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
Vue.use(PortalVue);

Vue.use(TiptapVuetifyPlugin, {
    // the next line is important! You need to provide the Vuetify Object to this place.
    vuetify, // same as "vuetify: vuetify"
    // optional, default to 'md' (default vuetify icons before v2.0.0)
    iconsGroup: 'mdi'
})

// inject global axios instance as http client to Model
Model.$http = axios

const app = document.getElementById('app');

new Vue({
    vuetify,
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
