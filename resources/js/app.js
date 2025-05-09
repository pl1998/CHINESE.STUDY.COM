import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

// 引入 Font Awesome
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { 
    faEnvelope, 
    faPhoneAlt,
    faCalendarAlt,
    faUser,
    faCreditCard,
    faCheck
} from '@fortawesome/free-solid-svg-icons'
import { 
    faInstagram, 
    faFacebook, 
    faYoutube,
    faTiktok
} from '@fortawesome/free-brands-svg-icons'

// 添加图标到库中
library.add(
    // 实心图标
    faEnvelope,
    faPhoneAlt,
    faCalendarAlt,
    faUser,
    faCreditCard,
    faCheck,
    // 品牌图标
    faInstagram,
    faFacebook,
    faYoutube,
    faTiktok
)

createInertiaApp({
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .component('font-awesome-icon', FontAwesomeIcon)
            .mount(el)
    },
});
