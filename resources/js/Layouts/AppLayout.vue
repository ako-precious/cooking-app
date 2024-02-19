<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import TextInput from '@/Components/TextInput.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

// ? import Footer from "@/Layouts/FooterLayout.vue";
import SideBarLink from "@/Components/Sidebar/SideBarLink.vue";
import SideBarSpan from "@/Components/Sidebar/SidebarSpan.vue";
import SideBarIcon from "@/Components/Sidebar/SideBarIcon.vue";
import SideBarHeader from "@/Components/Sidebar/SideBarHeader.vue";
// import FullCalendar from '@/Pages/FullCalendar.vue';
// Correct import statement
import SideBarCollapse from '@/Components/Sidebar/SidebarCollapse.vue';

import NavBar from "@/Layouts/NavBar.vue";
import SubNavBar from "@/Components/Navbar/SubNavBar.vue";
import NavSideBar from "@/Components/Navbar/NavSideBar.vue";
import SideNav from "@/Layouts/SideNav.vue";
import Toggles from "@/Layouts/Toggles.vue";

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

         
    <!-- sidenav  -->

    <SideNav @mouseover="hoverSidebar()" @mouseout="hoverOutSidebar() " class=" disable-scrollbars shadow-reverse " 
        :class=" sidebarReduced, {
            'bg-slate-850': isClassWhite,
            'translate-x-0':isClassTranslated,
            
        }"
    >
  
        
        <SideBarHeader class="">
             <!-- Logo -->
             <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                    <ApplicationMark class="block h-9 w-auto" />
                                </Link>
                            </div>

            <span :class="{ 'opacity-0': isLinkHidden }"
                class="ml-2 font-bold transition-all duration-200 ease-in-out text-2xl uppercase"
            >
                FoodMart
            </span>
        </SideBarHeader>
        
       
           <SideBarCollapse>
               <li class="mt-0.5 w-full group">
                   <Link :href="`/`">
                       <SideBarLink :class="{ 'activesidelink': isDashboard }"  >
                           <SideBarIcon class="group-hover:animate-bounce">
                               <font-awesome-icon
                                   icon="fa-solid fa-house"
                                   style="color: #2a744a"
                           /></SideBarIcon>
                           <SideBarSpan :class="{ 'opacity-0': isLinkHidden }"> Dashboard </SideBarSpan>
                       </SideBarLink>
                   </Link>
               </li>
      
             
                
               <li class="mt-0.5 w-full group">
                   <Link :href="`/meal-schedule`">
                   <SideBarLink :class="getRouteClass('meal-schedule')"  class="  transition-all duration-200 delay-75">
                       <SideBarIcon class="group-hover:text-polynesian dark:group-hover:text-lighred">
                          
                           <font-awesome-icon icon="calendar" class="text-oynx dark:text-snow" />
                       </SideBarIcon>
                       <SideBarSpan :class="{ 'opacity-0': isLinkHidden }" class="group-hover:text-polynesian dark:group-hover:text-lighred"> Meal schedule </SideBarSpan>
                   </SideBarLink>
               </Link>
               </li>
                
              
               <li class="mt-0.5 w-full group">
                   <Link :href="`/meal-schedule`">
                   <SideBarLink :class="getRouteClass('teams')"  class="  transition-all duration-200 delay-75">
                       <SideBarIcon class="group-hover:text-polynesian dark:group-hover:text-lighred">
                          
                           <font-awesome-icon icon="calendar" class="text-oynx dark:text-snow" />
                       </SideBarIcon>
                       <SideBarSpan :class="{ 'opacity-0': isLinkHidden }" class="group-hover:text-polynesian dark:group-hover:text-lighred"> Meal schedule </SideBarSpan>
                   </SideBarLink>
               </Link>
               </li>
              
           </SideBarCollapse>
    
        
    </SideNav>
    <!-- sidenav  -->

    <main :class="marginReduced"
        class="relative h-full max-h-screen transition-all duration-200 ease-in-out  rounded-xl"
    >
        <!-- Navbar -->
        <NavBar :class="classChanged">
            <div class="flex items-center ">
                <nav>
                    
                    <h6 class="mb-0 lex flex pt-1 mr-12 bg-transparent rounded-lg sm:mr-16 font-bold text-persian capitalize text-xl"> <div id="resultDiv">{{ resultText }}</div> </h6>
                </nav>
                <SubNavBar @click="minSidebar()" class="group">
                    <i  :class="{ 'translate-x-[5px]': isClassTranslated2 }"
                        class="ease mb-0.75 relative block h-0.5 rounded-sm bg-persian group-hover:bg-polynesian dark:group-hover:bg-lighred  transition-all " 
                    ></i>
                    <i
                        class="ease mb-0.75 relative block h-0.5 rounded-sm bg-persian group-hover:bg-polynesian dark:group-hover:bg-lighred transition-all"
                    ></i>
                    <i  :class="{ 'translate-x-[5px]': isClassTranslated2 }"
                        class="ease relative block h-0.5 rounded-sm bg-persian group-hover:bg-polynesian dark:group-hover:bg-lighred transition-all "
                    ></i>
                </SubNavBar>

            </div>

            <div class="hidden md:block w-4/12  ">
                <div class="flex items-center w-full">
                        <div
                            class="relative flex w-full transition-all rounded-lg ease group ">
                           
                            <TextInput class="w-full relative pl-8" />
                           
                            <font-awesome-icon icon="magnifying-glass" class=" group-focus:text-polynesian dark:group-focus:text-lighred group-hover:text-polynesian dark:group-hover:text-lighred group-active:text-polynesian dark:group-active:text-lighred absolute top-1/4 ml-2 text-persian" />

                            
                        </div>
                    </div>

            </div>
                <div class="flex">

                    <div class="max- mx-auto px-4 sm:px-6 lg:px-8">
                           <div class="flex justify-between h-16">
                               
                               <div class="flex sm:items-center sm:ms-6">
                                   <!-- Teams Dropdown -->
                              
                                   <!-- Settings Dropdown -->
                                   <div  class="ml-2  lg:mr-4 relative text-oynx active:text-persian hover:text-polynesian dark:text-snow dark:active:text-persian dark:hover:text-lighred rounded-full p-1 bg-gradient-to-br from-[#e3dedf] to-[#ffffff] shadow-snow-md hover:shadow-snow-sm focus:shadow-none active:shadow-none hover:border-polynesian dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37]  dark:shadow-oynx-md hover:dark:shadow-oynx-sm active:dark:shadow-none z-20 transition-all duration-250 ease-in">
    <Dropdown align="right" width="48">
                                           <template #trigger>
                                               <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                   <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                                               </button>
        
                                               <span v-else class="inline-flex rounded-md">
                                                   <button type="button" class="inline-flex items-center px-3 py-3 border border-transparent text-sm leading-4 font-medium rounded-full  transition ease-in-out duration-150">
                                                       {{truncatedIng($page.props.auth.user.name)  }} 
                                                     
        
                                                       <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                           <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                       </svg>
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
                       </div>
                    <NavSideBar>
                        
                        <div class="w-4.5 overflow-hidden group" @click="openSidebar()" >
        
                            <i
                                class="ease mb-0.75 relative block h-0.5 rounded-sm bg-persian group-hover:bg-polynesian dark:group-hover:bg-lighred  transition-all"
                                :class="{ 'translate-x-[5px]': isClassTranslated }"
                            ></i>
                            <i
                                class="ease mb-0.75 relative block h-0.5 rounded-sm bg-persian group-hover:bg-polynesian dark:group-hover:bg-lighred transition-all"
                            ></i>
                            <i
                                class="ease relative block h-0.5 rounded-sm bg-persian group-hover:bg-polynesian dark:group-hover:bg-lighred  transition-all"
                                :class="{ 'translate-x-[5px]': isClassTranslated }"
                            ></i>
                        </div>
                    </NavSideBar>
                </div>
           
                <!-- Responsive Navigation Menu -->
              
        </NavBar>
        <!-- end Navbar -->

        <!-- cards -->
        <div class="w-full px-6 py-6 mx-auto">
            <slot>Default</slot>
 <!-- <FullCalendar></FullCalendar> -->
            <!-- footer -->
            <!-- <Footer /> -->
            <!-- end footer -->
        </div>
        <!-- end cards -->
    </main>

        
    </div>
</template>

<script>

export default {

    data() {
        return {
            classChanged: "notfixeddiv",
            isClassWhite: false,
            isLinkHidden: false,
            hover: false,
            marginReduced: "xl:ml-68",
            sidebarReduced: "sidebar",
            isClassTranslated: false,
            isNavClassTranslated: false,
            isClassTranslated2: true,
            isDashboard: false,
            resultText: 'Dashboard', 
        };
    },
    created() {
        this.updateTextBasedOnFilePath(window.location.pathname); this.truncatedIng()
    },
    methods: {
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
        toggleNavClass() {
            // Toggle the value when the button is clicked

            this.classChanged =
                this.classChanged === "notfixeddiv"
                    ?  " shadow-reverse" + ' sticky top-[1%] z-[1000] right-0 '
                    : "notfixeddiv";
        },
        changeBgBlack() {
            this.isClassWhite = true;
        },
        changeBgWhite() {
            this.isClassWhite = false;
        },
        openSidebar() {
            this.isNavClassTranslated = !this.isNavClassTranslated;
            this.isClassTranslated = !this.isClassTranslated;
        },
        minSidebar() {
            this.isLinkHidden = !this.isLinkHidden;
            this.marginReduced = this.marginReduced === "xl:ml-68" ? "xl:ml-30" : "xl:ml-68";
            this.sidebarReduced = this.sidebarReduced === "sidebar"
                    ? "minisidebar"
                    : "sidebar";
            this.isClassTranslated2 = !this.isClassTranslated2;
        },
        hoverSidebar() {
            if (this.sidebarReduced ===  "minisidebar") {
                
                this.isLinkHidden = !this.isLinkHidden;
                this.marginReduced = this.marginReduced === "xl:ml-68" ? "xl:ml-30" : "xl:ml-68";
                this.sidebarReduced = this.sidebarReduced === "sidebar"
                        ? "minisidebar"
                        : "sidebar";
                this.isClassTranslated2 = !this.isClassTranslated2;
                this.hover = true
            }
        },
        hoverOutSidebar() {
            if ( this.hover === true) {
                
                this.isLinkHidden = !this.isLinkHidden;
                this.marginReduced = this.marginReduced === "xl:ml-68" ? "xl:ml-30" : "xl:ml-68";
                this.sidebarReduced = this.sidebarReduced === "sidebar"
                        ? "minisidebar"
                        : "sidebar";
                this.isClassTranslated2 = !this.isClassTranslated2;
                this.hover = false
            }
        },
        getRouteClass(routeName) {
                var currentRoute =   window.location.pathname;
                if(currentRoute === '/'){
                    
                    return this.isDashboard = true         
                }else{

                    return {
                        activesidelink: currentRoute.includes(routeName),
                    };
                }

            
        },
        


        updateTextBasedOnFilePath( filePath ) {
        

            if (filePath.includes("players")) {
                this.resultText = "Players";
            } else if (filePath.includes("teams")) {
                this.resultText = "Teams";
            } else if (filePath.includes("batting")) {
                this.resultText = "Batting";
            } else if (filePath.includes("bowling")) {
                this.resultText = "Bowling";
            } 
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

</style>