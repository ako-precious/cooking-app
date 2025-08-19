

import './bootstrap.js';
import '../css/app.css';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/index.js';
/* Import vue3-datepicker */
import Datepicker from 'vue3-datepicker';
/* Import fontawesome icons */
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { 
    faArrowRight, faImages, faBackward, faCalendar, faCaretDown, faCirclePlus, 
    faClose, faDoorOpen, faEarth, faEarthAfrica, faEarthAmerica, faEarthAmericas, 
    faEarthAsia, faEarthEurope, faEarthOceania, faForward, faGear, faGlobe, faHouse, 
    faMagnifyingGlass, faPlus, faRightToBracket, faShare, faStar, faUser, faUserPlus, 
    faDollarSign, faCaretUp, faToggleOff, faToggleOn, faImage, faPepperHot, faNewspaper, 
    faBell, faRightFromBracket, faHeart, faChevronDown, faFilter, faEye, faPenToSquare,
    faExclamationCircle, faTrash, faPhone, faEnvelope,
    faCircleInfo
} from "@fortawesome/free-solid-svg-icons";
import { faGoogle } from '@fortawesome/free-brands-svg-icons';

/* Add icons to the library */
library.add( 
    faUser, faGlobe, faArrowRight, faUserPlus, faRightToBracket, faDoorOpen,  faTrash,
    faCirclePlus, faHeart, faShare, faStar, faGoogle, faCalendar, faGear, faClose, faHouse, 
    faMagnifyingGlass, faForward, faBackward, faPlus, faEarthAfrica, faEarthAmerica,  faEnvelope,
    faEarthAmericas, faEarthAsia, faEarthEurope, faEarthOceania, faEarth, faImages, faPhone,
    faDollarSign, faCaretDown, faCaretUp, faToggleOff, faToggleOn, faImage, faPepperHot, 
    faNewspaper, faBell, faRightFromBracket, faChevronDown, faFilter, faEye, faPenToSquare, faExclamationCircle, faCircleInfo
);

const appName = import.meta.env.VITE_APP_NAME || 'ounjemi';



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
            .component('Datepicker', Datepicker)
            .mount(el);
    },
    progress: {
        color: '#1B998B',
    },
});
});

// INSERT INTO ratings (meal_id, user_id, presentation, taste, value, nutrition, portion_size, freshness, total, comment, created_at, updated_at) 
// VALUES 
// (FLOOR(RAND() * 16) + 32, FLOOR(RAND() * 31) + 70, FLOOR(RAND() * 2) + 4, FLOOR(RAND() * 2) + 4, FLOOR(RAND() * 2) + 4, FLOOR(RAND() * 2) + 4, FLOOR(RAND() * 2) + 4, FLOOR(RAND() * 2) + 4, FLOOR(RAND() * 2) + 4, CONCAT("Nice meal"), CURDATE(), CURDATE()),

// (FLOOR(RAND() * 16) + 32, FLOOR(RAND() * 31) + 70, FLOOR(RAND() * 2) + 4, FLOOR(RAND() * 2) + 4, FLOOR(RAND() * 2) + 4, FLOOR(RAND() * 2) + 4, FLOOR(RAND() * 2) + 4, FLOOR(RAND() * 2) + 4, FLOOR(RAND() * 2) + 4, CONCAT("Nice meal"), CURDATE(), CURDATE()),

// (FLOOR(RAND() * 16) + 32, FLOOR(RAND() * 31) + 70, FLOOR(RAND() * 2) + 4, FLOOR(RAND() * 2) + 4, FLOOR(RAND() * 2) + 4, FLOOR(RAND() * 2) + 4, FLOOR(RAND() * 2) + 4, FLOOR(RAND() * 2) + 4, FLOOR(RAND() * 2) + 4, CONCAT("I'm so impressed "), CURDATE(), CURDATE());