<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import TextInput from '@/Components/TextInput.vue';

import SettingsDropdown from "@/Components/SettingsDropdown.vue";
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
  
        
        <SideBarHeader class="flex items-center">
             <!-- Logo -->
             <Link :href="route('welcome')">
             <div class="w-full flex items-center">
                    <ApplicationMark class="block h-9 w-auto" />
                </div>
            </Link>
                
                <Link :href="route('welcome')">
                    <span :class="{ 'opacity-0': isLinkHidden }"
                    class="ml-2 font-bold transition-all duration-200 ease-in-out text-2xl uppercase"
                    >
                    Ounjemi
                </span>
            </Link>
        </SideBarHeader>
        
       
           <SideBarCollapse>
               <li class="mt-0.5 w-full group">
                   <Link :href="`/meal-schedule`">
                       <SideBarLink :class="getRouteClass('meal-schedule')"    >
                           <SideBarIcon class="group-hover:animate-bounce">
                            <font-awesome-icon
                                    icon="door-open"
                                    class="ml-2 "  
                           /></SideBarIcon>
                           <SideBarSpan :class="{ 'opacity-0': isLinkHidden }"> Meal Schedule </SideBarSpan>
                       </SideBarLink>
                   </Link>
               </li>
      
             
                
               <li class="mt-0.5 w-full group">
                   <Link :href="`/calendar`">
                   <SideBarLink :class="getRouteClass('calendar')"  class="  transition-all duration-200 delay-75">
                       <SideBarIcon class="group-hover:text-polynesian dark:group-hover:text-lighred">
                          
                           <font-awesome-icon icon="calendar" class="text-oynx dark:text-snow" />
                       </SideBarIcon>
                       <SideBarSpan :class="{ 'opacity-0': isLinkHidden }" class="group-hover:text-polynesian dark:group-hover:text-lighred"> Calendar </SideBarSpan>
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
                           <div class="flex justify-between ">
                               
                               <div class="flex sm:items-center sm:ms-6">
                                   
                              
                                   <!-- Settings Dropdown -->
                                 
              <SettingsDropdown></SettingsDropdown>

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
            resultText: 'Meal schedule', 
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
        

            if (filePath.includes("meal-schedule")) {
                this.resultText = "Meal schedule";
            } else if (filePath.includes("Calendar")) {
                this.resultText = "Calendar";
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