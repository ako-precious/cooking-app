import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';


/* import the fontawesome core */
import { library } from "@fortawesome/fontawesome-svg-core";

/* import font awesome icon component */
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

/* import specific icons */
import { faArrowRight, faCaretDown, faCirclePlus, faDoorOpen, faGlobe, faRightToBracket, faShare, faStar, faUser, faUserPlus, } from "@fortawesome/free-solid-svg-icons";
import { faHeart } from '@fortawesome/free-regular-svg-icons';

/* add icons to the library */
library.add( faUser, faGlobe, faArrowRight, faCaretDown, faUserPlus, faRightToBracket, faDoorOpen, faCirclePlus, faHeart, faShare, faStar  );

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component("font-awesome-icon", FontAwesomeIcon)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
