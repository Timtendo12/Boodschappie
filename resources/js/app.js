import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import Vue3Toasity from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('../vue/pages/**/*.vue', { eager: true })
        return pages[`../vue/pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(Vue3Toasity)
            .mount(el)
    },
})
