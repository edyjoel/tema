import './bootstrap';
import '@mdi/font/css/materialdesignicons.css'


import { createApp, h } from 'vue';
import {createInertiaApp, Head, Link} from "@inertiajs/vue3";
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
    components,
    directives,
    icons: {
        defaultSet: 'mdi',
    },
    theme: {
        themes: {
            light: {
                colors: {
                    primary: '#6875f5',
                },
            },
        },
    },
})

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(vuetify)
            .component("Head", Head)
            .component("Link", Link)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
        includeCSS: true,
        showSpinner: true
    }
});
