<template>
    <div>
        <div class="">
            <!-- Navbar Fixed -->
            <hr
                class="h-px my-6 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
            />
            <DropdownLink>
                <div class="flex ">
                    <h6 class="mb-0 dark:text-white">Navbar Fixed</h6>
                    <div class="block pl-0 ml-auto">
                        <input
                            v-bind="$attrs"
                            navbarFixed
                            class="rounded-10 duration-250 ease-in-out after:rounded-circle after:shadow-2xl after:duration-250 checked:after:translate-x-5.3 h-5 relative float-left mt-1 ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:bg-none checked:bg-right"
                            type="checkbox"
                        />
                    </div>
                </div>
            </DropdownLink>
            <DropdownLink>                
                <div class="flex mt-2 ">
                    <h6 class="mb-0 dark:text-white">Light / Dark</h6>
                    <div class="block pl-0 ml-auto ">
                        <input
                            @click="toggleDarkMode()"
                            dark-toggle
                            class="rounded-10 duration-250 ease-in-out after:rounded-circle after:shadow-2xl after:duration-250 checked:after:translate-x-5.3 h-5 relative float-left mt-1 ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:bg-none checked:bg-right"
                            type="checkbox"
                        />
                    </div>
                </div>
            </DropdownLink>
        </div>

        <!-- </div> -->
    </div>
</template>
<script setup>
// import { Link } from "@inertiajs/vue3";
import { useAttrs } from "vue";
import fixedPluginCard from "@/Layouts/FixedPluginCard.vue";

import DropdownLink from "@/Components/DropdownLink.vue";
import TextInput from "@/Components/TextInput.vue";
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
