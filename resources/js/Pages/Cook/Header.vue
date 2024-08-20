<script setup>
import { Head, Link } from "@inertiajs/vue3";

import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import SettingsDropdown from "@/Components/SettingsDropdown.vue";

</script>

<template>
    <div class="md:px-5">
        <header
            class="py-2 container bg-snow dark:bg-oynx z-990 transition-all duration-300 delay-75 ease-in animate-fade-in"
        >
            <div
                :class="{ 'fix align-bottom shadow-sm': isHeaderFixed }"
                class="flex justify-between items-center w-full bg-snow dark:bg-oynx"
            >
                <Link :href="route('welcome')">
                    <div class="w-full flex items-center">
                        <ApplicationMark class="block w-auto" />
                        <span
                            class="hidden md:block ml-2 font-bold transition-all duration-200 ease-in-out text-2xl uppercase text-oynx dark:text-snow"
                        >
                            Ounjemi
                        </span>
                    </div>
                </Link>

                <div
                    class=" hidden  bg-transparent w-4/12 sm:w-4/12 capitalize font-bold text-sm mr-4 sm:flex justify-around transition-all duration-300 delay-75 ease-in"
                    name=""
                    id=""
                >
                    <Link :href="`/cook/order`" class="py-2 px-3 navbar-link">
                        <p>Orders</p>
                    </Link>
                    <Link
                        class="py-2 md:px-3 navbar-link"
                        :href="`/cook/calendar`"
                    >
                        <p>Calendar</p>
                    </Link>
                    <Link :href="`/cook/menu`" class="py-2 px-3 navbar-link">
                        <p>Menu</p>
                    </Link>
                    <Link :href="`/cook/menu`" class="py-2 px-3 navbar-link">
                        <p>More  <font-awesome-icon class="ml-2"
                                                        icon="caret-down"
                                                /></p>
                    </Link>
                   
                </div>
                <div class="flex">

                    <div class="flex sm:items-center sm:ms-6">
                        <!-- Settings Dropdown -->
                        <SettingsDropdown></SettingsDropdown>
                    </div>
                    <div class=" ml-6 sm:hidden flex items-center">
                        <a
                            mini-sidenav-burger=""
                            href="javascript:;"
                            class="sm:marker:hidden p-0 text-sm text-white transition-all ease-nav-brand block"
                            aria-expanded="false"
                        >
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <div class="w-4.5 overflow-hidden">
                                        <i
                                            class="ease mb-0.75 relative block h-0.5 rounded-sm bg-persian group-hover:bg-polynesian dark:group-hover:bg-lighred transition-all"
                                        ></i>
                                        <i
                                            class="ease mb-0.75 relative block h-0.5 rounded-sm bg-persian group-hover:bg-polynesian dark:group-hover:bg-lighred transition-all"
                                        ></i>
                                        <i
                                            class="ease relative block h-0.5 rounded-sm bg-persian group-hover:bg-polynesian dark:group-hover:bg-lighred transition-all"
                                        ></i>
                                    </div>
                                </template>
    
                                <template #content class="bg-snow dark:bg-oynx">
                                    <div
                                        class="origin-top-right absolute right-0 mt-2 w-48 delay-75 rounded-md border-snow ring-1 bg-gradient-to-br from-[#e3dedf] to-[#ffffff] -shadow-snow-sm hover:shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] dark:-shadow-oynx-sm hover:dark:shadow-oynx-sm z-20 transition-all duration-250 ease-in dark:border-oynx"
                                    >
                                        <DropdownLink
                                        :href="`/cook/order`" 
                                            class="flex w-full items-center rounded-md px-4 py-2 text-sm text-oynx hover:text-polynesian dark:text-snow dark:hover:text-lighred cursor-pointer transition-all duration-200 ease-in-out"
                                        ><p>Orders</p>
                                        </DropdownLink>
                                        <DropdownLink
                                            :href="`/cook/calendar`"
                                            class="relative flex items-center rounded-md px-4 py-2 text-sm text-oynx hover:text-polynesian dark:text-snow dark:hover:text-lighred cursor-pointer transition-all duration-200 ease-in-out"
                                        >
                                        <p>Calendar</p>
                                        </DropdownLink>
                                        <DropdownLink
                                        :href="`/cook/menu`" 
                                            class="relative flex items-center rounded-md px-4 py-2 text-sm text-oynx hover:text-polynesian dark:text-snow dark:hover:text-lighred cursor-pointer transition-all duration-200 ease-in-out"
                                        >
                                        <p>Menu</p>
                                        </DropdownLink>
                                    </div>
                                </template>
                            </Dropdown>
                        </a>
                    </div>
                </div>
            </div>
        </header>
    </div>
</template>

<script>
export default {
    inheritAttrs: false,
    data() {
        return {
            isHeaderFixed: false,
        };
    },
    mounted() {
        window.addEventListener("scroll", this.handleScroll);
    },
    beforeDestroy() {
        window.removeEventListener("scroll", this.handleScroll);
    },

    methods: {
        handleScroll() {
            // Adjust the scroll threshold as needed
            const scrollThreshold = 20;
            this.isHeaderFixed = window.scrollY > scrollThreshold;
        },
        truncatedIng(description) {
            // Check if description exists and has more than 30 characters
            if (description && description.length > 3) {
                // Truncate description to 30 characters and add ellipsis
                return description.slice(0, 3) + "...";
            } else {
                // Return full description if it's less than or equal to 30 characters
                return description;
            }
        },
    },
};
</script>

<!-- Saving for later -->
<!-- "Indulge your taste buds and unlock a world of culinary delights with our platform, where passionate home chefs transform ordinary ingredients into extraordinary experiences. From tantalizing dishes to mouthwatering desserts, our community of food artisans invites you to savor their creations and bring the flavors of the world into your home. Whether you're seeking a gourmet feast for a special occasion or craving everyday comfort food made with love, discover your perfect match among our talented cooks who are ready to turn your cravings into unforgettable culinary adventures." -->

<style scoped>
.fix {
    position: fixed;
    top: 0;
    right: 0;
    width: 100vw;
    padding: 1rem 3rem;
    z-index: 1000; /* Adjust z-index as needed */
}
</style>
