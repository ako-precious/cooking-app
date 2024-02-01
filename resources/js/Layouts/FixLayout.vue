<template>
    <div>
        <a
            @click="toggleClass"
            class="fixed px-4 py-2 text-xl card dark:card cursor-pointer bottom-8 right-8 z-990 rounded-circle group"
        >
            <font-awesome-icon icon="fa-solid fa-gear" class="text-persian group-hover:text-polynesian dark:group-hover:text-lighred " />
        </a>
       
        <fixedPluginCard :class="isClassAdded">
            <div class="px-6 pt-4 pb-0 mb-0 border-b-0 rounded-t-2xl">
                <div class="float-left">
                    <h5 class="mt-4 mb-0 dark:text-white">
                        Dashboard Configurator
                    </h5>
                    <p class="dark:text-white dark:opacity-80 py-2">
                        See dashboard options.
                    </p>
                </div>
                <div class="float-right mt-6">
                    <button
                        @click="toggleClass"
                        fixed-plugin-close-button
                        class="inline-block p-0 mb-4 text-sm font-bold leading-normal text-center uppercase align-middle transition-all ease-in bg-transparent border-0 rounded-lg shadow-none cursor-pointer hover:-translate-y-px tracking-tight-rem bg-150 bg-x-25 active:opacity-85 dark:text-white text-slate-700"
                    >
                        <font-awesome-icon
                            icon="fa-solid fa-close"
                           class=" text-persian text-lg"
                        />
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr
                class="h-px mx-0 my-1 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
            />

            <div class="flex-auto p-6 pt-0 overflow-auto sm:pt-4">
                <!-- jker -->
                <!-- Sidebar Backgrounds -->
                 <slot>Default</slot>
                <p
                    class="block mt-2 text-sm leading-normal dark:text-white dark:opacity-80 xl:hidden"
                >
                    You can change the sidenav type just on desktop view.
                </p>
                <!-- Navbar Fixed -->
                <div class="flex my-4">
                    <h6 class="mb-0 dark:text-white">Navbar Fixed</h6>
                    <div class="block pl-0 ml-auto min-h-6">
                        <input
                            v-bind="$attrs"
                            navbarFixed
                            class="rounded-10 duration-250 ease-in-out after:rounded-circle after:shadow-2xl after:duration-250 checked:after:translate-x-5.3 h-5 relative float-left mt-1 ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:bg-none checked:bg-right"
                            type="checkbox"
                        />
                    </div>
                </div>
                <hr
                    class="h-px my-6 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
                />
                <div class="flex mt-2 mb-12">
                    <h6 class="mb-0 dark:text-white">Light / Dark</h6>
                    <div class="block pl-0 ml-auto min-h-6">
                        <input
                            @click="toggleDarkMode()"
                            dark-toggle
                            class="rounded-10 duration-250 ease-in-out after:rounded-circle after:shadow-2xl after:duration-250 checked:after:translate-x-5.3 h-5 relative float-left mt-1 ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:bg-none checked:bg-right"
                            type="checkbox"
                        />
                    </div>
                </div>
            </div>
           
        </fixedPluginCard>

        <!-- </div> -->
    </div>
</template>
<script setup>

// import { Link } from "@inertiajs/vue3";
import { useAttrs } from "vue";
import fixedPluginCard from "@/Layouts/FixedPluginCard.vue";

import { useDark, useToggle } from "@vueuse/core";

const isDark = useDark();
const toggleDarkMode = useToggle(isDark);
const attrs = useAttrs();
</script>

<script>
export default {
    inheritAttrs: false,
    data() {
        return {
            isClassAdded: "-right-90",
         
        };
    },
    methods: {
        toggleClass() {
            // Toggle the value when the button is clicked

            this.isClassAdded =
                this.isClassAdded === "-right-90" ? "right-0" : "-right-90";
        },
       


    },
};
</script>

<style scoped>

.card {
    background: linear-gradient(145deg, #e3dedf, #ffffff);
    box-shadow: 10px 10px 15px #cac6c6, -10px -10px 15px #ffffff;
}
.card:hover {
    background: linear-gradient(145deg, #e3dedf, #ffffff);
    box-shadow: -10px -10px 15px #a19e9f, 10px 10px 15px #ffffff;
}
.card:active {
    box-shadow: none;
}
@media (prefers-color-scheme: dark) {
    .dark\:card {
        background: linear-gradient(145deg, #2b312e, #333a37);
        box-shadow: 10px 10px 15px #262b29, -10px -10px 15px #3a413d;
    }
    .dark\:card:hover {
        background: linear-gradient(145deg, #2b312e, #333a37);
        box-shadow: -10px -10px 15px #262b29, 10px 10px 15px #3a413d;
    }
    .dark\:card:active {
        background: linear-gradient(145deg, #2b312e, #333a37);
        box-shadow: none;
    }
}
</style>
