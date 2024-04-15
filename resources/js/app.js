

import '../css/app.css';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

/* Import fontawesome icons */
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { 
    faArrowRight, faImages, faBackward, faCalendar, faCaretDown, faCirclePlus, 
    faClose, faDoorOpen, faEarth, faEarthAfrica, faEarthAmerica, faEarthAmericas, 
    faEarthAsia, faEarthEurope, faEarthOceania, faForward, faGear, faGlobe, faHouse, 
    faMagnifyingGlass, faPlus, faRightToBracket, faShare, faStar, faUser, faUserPlus, 
    faDollarSign, faCaretUp, faToggleOff, faToggleOn, faImage, faPepperHot, faNewspaper, 
    faBell, faRightFromBracket 
} from "@fortawesome/free-solid-svg-icons";
import { faHeart } from '@fortawesome/free-regular-svg-icons';
import { faGoogle } from '@fortawesome/free-brands-svg-icons';

/* Add icons to the library */
library.add( 
    faUser, faGlobe, faArrowRight, faCaretDown, faUserPlus, faRightToBracket, faDoorOpen, 
    faCirclePlus, faHeart, faShare, faStar, faGoogle, faCalendar, faGear, faClose, faHouse, 
    faMagnifyingGlass, faForward, faBackward, faPlus, faEarthAfrica, faEarthAmerica, 
    faEarthAmericas, faEarthAsia, faEarthEurope, faEarthOceania, faEarth, faImages, 
    faDollarSign, faCaretDown, faCaretUp, faToggleOff, faToggleOn, faImage, faPepperHot, 
    faNewspaper, faBell, faRightFromBracket 
);

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

document.addEventListener("DOMContentLoaded", () => {
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    // resolve: async (name) => {
    //     const pages = import.meta.glob('./Pages/**/*.vue');
        
    //     return (await pages[`./Pages/${name}.vue`]()).default;
    // },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) }, { mode: 'production' })
            .use(plugin)
            .use(ZiggyVue)
            .component("font-awesome-icon", FontAwesomeIcon)
            .mount(el);
    },
    progress: {
        color: '#1B998B',
    },
});
});

    // app.config.devtools = false;
    // app.config.debug = false;
    // app.config.silent = true;
// }


// const appName = import.meta.env.VITE_APP_NAME || 'Laravel';


// /* import the fontawesome core */
// import { library } from "@fortawesome/fontawesome-svg-core";

// /* import font awesome icon component */
// import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

// /* import specific icons */
// import { faArrowRight, faImages, faBackward, faCalendar, faCaretDown, faCirclePlus, faClose, faDoorOpen, faEarth, faEarthAfrica, faEarthAmerica, faEarthAmericas, faEarthAsia, faEarthEurope, faEarthOceania, faForward, faGear, faGlobe, faHouse, faMagnifyingGlass, faPlus, faRightToBracket, faShare, faStar, faUser, faUserPlus, faDollarSign, faCaretUp, faToggleOff, faToggleOn, faImage, faPepperHot, faNewspaper, faBell, faRightFromBracket, } from "@fortawesome/free-solid-svg-icons";
// import {  faHeart } from '@fortawesome/free-regular-svg-icons';
// import { faGoogle } from '@fortawesome/free-brands-svg-icons';

// /* add icons to the library */
// library.add( faUser, faGlobe, faArrowRight, faCaretDown, faUserPlus, faRightToBracket, faDoorOpen, faCirclePlus, faHeart, faShare, faStar, faGoogle, faCalendar, faGear, faClose, faHouse, faMagnifyingGlass, faForward, faBackward, faPlus, faEarthAfrica, faEarthAmerica, faEarthAmericas, faEarthAsia, faEarthEurope, faEarthOceania, faEarth, faImages, faDollarSign, faCaretDown, faCaretUp, faToggleOff, faToggleOn, faImage, faPepperHot, faNewspaper, faBell, faRightFromBracket   );



// createInertiaApp({
//     title: (title) => `${title} - ${appName}`,
//     resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
//     setup({ el, App, props, plugin }) {
//         return createApp({ render: () => h(App, props) })
//             .use(plugin)
//             .use(ZiggyVue)
//             .component("font-awesome-icon", FontAwesomeIcon)
//             .mount(el);
//     },
//     progress: {
//         color: '#1B998B',
//     },
// });

// if (process.env.MIX_ENV_MODE === "production") {
//     Vue.config.devtools = false;
//     Vue.config.debug = false;
//     Vue.config.silent = true;
// }