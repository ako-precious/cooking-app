<script setup>
import { Head, Link } from "@inertiajs/vue3";

import DropdownLink from "@/Components/DropdownLink.vue";
import Dropdown from "@/Components/Dropdown.vue";
const logout = () => {
    router.post(route("logout"));
};
</script>

<template>
    <div class="md:px-5">

        <header class="py-5  bg-snow dark:bg-oynx z-990 transition-all duration-300 delay-75 ease-in animate-fade-in">
            <div
                :class="{ 'fix align-bottom shadow-sm' : isHeaderFixed }"
                class="flex justify-between items-center w-full bg-snow dark:bg-oynx"
            >
                <div class="">LOGO</div>
    
                <div
                    class="bg-transparent  w-4/12 sm:w-4/12 capitalize font-bold text-sm mr-4 flex justify-around  transition-all duration-300 delay-75 ease-in"
                    name=""
                    id=""
                >
                    <Link :href="`/cook/order`" class="py-2 px-3 navbar-link" >
                        <p>Orders</p>
                    </Link>
                    <Link class="py-2 px-3 navbar-link" href="">
                        <p>Calendar</p>
                    </Link>
                    <Link :href="`/cook/menu`" class="py-2 px-3 navbar-link" >
                        <p>Menu</p>
                    </Link>
                    <!-- <Link class="py-2 px-3 navbar-link flex items-center" href="" >
                        <p>More  </p> <font-awesome-icon
                                            icon="caret-down"
                                            class="h-3 lg:h-4 ml-2 svg-inline--fa fa-user fa-w-14 fa-9x"></font-awesome-icon>
                                            Type of cuisine:

Italian
French
Mexican
Thai
Indian
Mediterranean
Japanese
Vegetarian
Vegan
Dietary preference:

Low-carb
Gluten-free
Dairy-free
Spicy
Light
Hearty
General terms:

Surprise me! (Shows trust in the chef's expertise)
Seasonal (Focuses on using fresh, in-season ingredients)
Chef's choice (Similar to "surprise me!")
Recommendation (Asks for the chef's suggestion based on your preferences)
Signature dish (Requests the chef's most well-known creation)
                                       
                    </Link> -->
                </div>
                <div class="flex sm:items-center sm:ms-6">
                    <!-- Settings Dropdown -->
                    
                    <div  class="ml-2  lg:mr-4 relative text-oynx active:text-persian hover:text-polynesian dark:text-snow dark:active:text-persian dark:hover:text-lighred rounded-full  bg-gradient-to-br from-[#e3dedf] to-[#ffffff] shadow-snow-md hover:shadow-snow-sm focus:shadow-none active:shadow-none hover:border-polynesian dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37]  dark:shadow-oynx-md hover:dark:shadow-oynx-sm active:dark:shadow-none z-20 transition-all duration-250 ease-in">
                                        <Dropdown align="right" width="48">
                                           <template #trigger>
                                               <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                   <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                                               </button>
        
                                               <span v-else class="inline-flex rounded-md">
                                                   <button type="button" class="inline-flex items-center px-3 py-3 border border-transparent text-sm leading-4 font-medium rounded-full  transition ease-in-out duration-150">
                                                       {{truncatedIng($page.props.auth.user.name)  }} 
                                                       <font-awesome-icon
                                        icon="caret-down"
                                        class="h-3 lg:h-4 ml-2 svg-inline--fa fa-user fa-w-14 fa-9x"
                                    />
                                                   </button>
                                               </span>
                                           </template>
        
                                           <template #content class=" bg-snow dark:bg-oynx">
                                            <div class="origin-top-right absolute right-0 mt-2 w-48 delay-75 rounded-md border-snow  ring-1 bg-gradient-to-br from-[#e3dedf] to-[#ffffff] -shadow-snow-sm hover:shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37]  dark:-shadow-oynx-sm hover:dark:shadow-oynx-sm z-20 transition-all duration-250 ease-in dark:border-oynx"
             >
                                                <!-- Account Management -->
                                                <div class="block px-4 py-2 text-xs text-gray-600">
                                                    Manage Account
                                                </div>
         
                                                <DropdownLink :href="route('profile.show')">
                                                    Profile
                                                </DropdownLink>
         
                                                <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                                                    API Tokens
                                                </DropdownLink>
         
                                                <div class="border-t border-gray-200 dark:border-gray-600" />
         
                                                <!-- Authentication -->
                                                <form @submit.prevent="logout">
                                                    <DropdownLink as="button">
                                                        Log Out
                                                    </DropdownLink>
                                                </form>
                                                     <!-- Add the toggle bo ttuns later -->
                                            </div>
                                           </template>
                                       </Dropdown>
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
    width: 100%;
    padding: 1.5rem 3rem;
    z-index: 1000; /* Adjust z-index as needed */
}
</style>
