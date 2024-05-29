<script setup>
import { Head, Link } from "@inertiajs/vue3";

import ApplicationMark from '@/Components/ApplicationMark.vue';
import SettingsDropdown from "@/Components/SettingsDropdown.vue";
</script>

<template>
    <div class="md:px-5">

        <header class="py-2  container  bg-snow dark:bg-oynx z-990 transition-all duration-300 delay-75 ease-in animate-fade-in">
            <div
                :class="{ 'fix align-bottom shadow-sm' : isHeaderFixed }"
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
                    class="bg-transparent  w-4/12 sm:w-4/12 capitalize font-bold text-sm mr-4 flex justify-around  transition-all duration-300 delay-75 ease-in"
                    name=""
                    id=""
                >
                    <Link :href="`/cook/order`" class="py-2 px-3 navbar-link" >
                        <p>Orders</p>
                    </Link>
                    <Link class="py-2 md:px-3 navbar-link" :href="`/cook/calendar`">
                        <p>Calendar</p>
                    </Link>
                    <Link :href="`/cook/menu`" class="py-2 px-3 navbar-link" >
                        <p>Menu</p>
                    </Link>
                    <!-- <Link class="py-2 px-3 navbar-link flex items-center" href="" >
                        <p>More  </p> <font-awesome-icon
                                            icon="caret-down"
                                            class="h-3 lg:h-4 ml-2 svg-inline--fa fa-user fa-w-14 fa-9x"></font-awesome-icon>
                                          
                                       
                    </Link> -->
                </div>
                <div class="flex sm:items-center sm:ms-6">
                    <!-- Settings Dropdown -->
              <SettingsDropdown></SettingsDropdown>
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
