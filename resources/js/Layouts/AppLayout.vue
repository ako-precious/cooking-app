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
import SideBarSpan from "@/Components/Sidebar/SideBarSpan.vue";
import SideBarIcon from "@/Components/Sidebar/SideBarIcon.vue";
import SideBarHeader from "@/Components/Sidebar/SideBarHeader.vue";
import SideBarCollapse from "@/Components/Sidebar/SideBarCollapse.vue";
import NavBar from "@/Layouts/NavBar.vue";
import SubNavBar from "@/Components/Navbar/SubNavBar.vue";
import NavSideBar from "@/Components/Navbar/NavSideBar.vue";
import SideNav from "@/Layouts/SideNav.vue";
import FixLayout from "@/Layouts/FixLayout.vue";

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

    <SideNav @mouseover="hoverSidebar()" @mouseout="hoverOutSidebar() " class=" scroll-m-0 scroll card dark:card" 
        :class=" sidebarReduced, {
            'bg-slate-850': isClassWhite,
            'translate-x-0':isClassTranslated,
            
        }"
    >
        <SideBarHeader>
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
                <Link :href="`/teams`">
                <SideBarLink :class="getRouteClass('teams')"  class="  transition-all duration-200 delay-75">
                    <SideBarIcon class="group-hover:text-polynesian dark:group-hover:text-lighred">
                       
                        <font-awesome-icon icon="calendar" />
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
                            class="relative flex w-full transition-all rounded-lg ease group "
                        >
                           
                            <TextInput class="w-full relative pl-8" />
                           
                            <font-awesome-icon icon="magnifying-glass" class=" group-focus:text-polynesian dark:group-focus:text-lighred group-hover:text-polynesian dark:group-hover:text-lighred group-active:text-polynesian dark:group-active:text-lighred absolute top-1/4 ml-2 text-persian" />

                            
                        </div>
                    </div>

            </div>
                <div class="flex">

                    <div class="max- mx-auto px-4 sm:px-6 lg:px-8">
                           <div class="flex justify-between h-16">
                               
                               <div class="flex sm:items-center sm:ms-6">
                                   <div class="ms-3 relative">
                                       <!-- Teams Dropdown -->
                                       <Dropdown v-if="$page.props.jetstream.hasTeamFeatures" align="right" width="60">
                                           <template #trigger>
                                               <span class="inline-flex rounded-md">
                                                   <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                                       {{ $page.props.auth.user.current_team.name }}
        
                                                       <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                           <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                                       </svg>
                                                   </button>
                                               </span>
                                           </template>
        
                                           <template #content>
                                               <div class="w-60">
                                                   <!-- Team Management -->
                                                   <div class="block px-4 py-2 text-xs text-gray-400">
                                                       Manage Team
                                                   </div>
        
                                                   <!-- Team Settings -->
                                                   <DropdownLink :href="route('teams.show', $page.props.auth.user.current_team)">
                                                       Team Settings
                                                   </DropdownLink>
        
                                                   <DropdownLink v-if="$page.props.jetstream.canCreateTeams" :href="route('teams.create')">
                                                       Create New Team
                                                   </DropdownLink>
        
                                                   <!-- Team Switcher -->
                                                   <template v-if="$page.props.auth.user.all_teams.length > 1">
                                                       <div class="border-t border-gray-200 dark:border-gray-600" />
        
                                                       <div class="block px-4 py-2 text-xs text-gray-400">
                                                           Switch Teams
                                                       </div>
        
                                                       <template v-for="team in $page.props.auth.user.all_teams" :key="team.id">
                                                           <form @submit.prevent="switchToTeam(team)">
                                                               <DropdownLink as="button">
                                                                   <div class="flex items-center">
                                                                       <svg v-if="team.id == $page.props.auth.user.current_team_id" class="me-2 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                           <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                       </svg>
        
                                                                       <div>{{ team.name }}</div>
                                                                   </div>
                                                               </DropdownLink>
                                                           </form>
                                                       </template>
                                                   </template>
                                               </div>
                                           </template>
                                       </Dropdown>
                                   </div>
        
                                   <!-- Settings Dropdown -->
                                   <div  class="ml-2 relative text-persian active:text-polynesian hover:text-polynesian  dark:active:text-lighred dark:hover:text-lighred bg-oynx rounded-full p-1 dropdown dark:dropdown z-20 transition-all duration-200 ease-in-out">
                                       <Dropdown align="right" width="48">
                                           <template #trigger>
                                               <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                   <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                                               </button>
        
                                               <span v-else class="inline-flex rounded-md">
                                                   <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md  transition ease-in-out duration-150">
                                                       {{ $page.props.auth.user.name }}
        
                                                       <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                           <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                       </svg>
                                                   </button>
                                               </span>
                                           </template>
        
                                           <template #content>
                                               <!-- Account Management -->
                                               <div class="block px-4 py-2 text-xs text-gray-400">
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

            <!-- footer -->
            <!-- <Footer /> -->
            <!-- end footer -->
        </div>
        <!-- end cards -->
    </main>
    <!-- fixed plugin  -->
    <FixLayout @click="toggleNavClass()">
        <div>
            <h6 class="mb-0 dark:text-white">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)">
            <div class="my-2 text-left" sidenav-colors>
                <span
                    class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-blue-500 to-violet-500 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-slate-700 text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                    active-color
                    data-color="blue"
                    onclick="sidebarColor(this)"
                ></span>
                <span
                    class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                    data-color="gray"
                    onclick="sidebarColor(this)"
                ></span>
                <span
                    class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-blue-700 to-cyan-500 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                    data-color="cyan"
                    onclick="sidebarColor(this)"
                ></span>
                <span
                    class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-emerald-500 to-teal-400 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                    data-color="emerald"
                    onclick="sidebarColor(this)"
                ></span>
                <span
                    class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-orange-500 to-yellow-500 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                    data-color="orange"
                    onclick="sidebarColor(this)"
                ></span>
                <span
                    class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-red-600 to-orange-600 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                    data-color="red"
                    onclick="sidebarColor(this)"
                ></span>
            </div>
        </a>

        <!-- Sidenav Type -->
        <div class="mt-4">
            <h6 class="mb-0 dark:text-white">Sidenav Type</h6>
            <p class="text-sm leading-normal dark:text-white dark:opacity-80 py-2">
                Choose between 2 different sidenav types.
            </p>
        </div>
        <div class="flex">
            <button
                    class="whitebtn"
                    @click="changeBgWhite()"
                    transparent-style-btn
                    data-class="bg-transparent"
                    active-style
                > Light
                </button>
                <button
                    class="blackbtn" @click="changeBgBlack()"
                    transparent-style-btn
                    data-class="bg-transparent"
                    active-style
                > Dark                    
                </button>
        </div>
    </FixLayout>
        
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
        this.updateTextBasedOnFilePath(window.location.pathname);
    },
    methods: {
        toggleNavClass() {
            // Toggle the value when the button is clicked

            this.classChanged =
                this.classChanged === "notfixeddiv"
                    ?  " card " + "dark:card"
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
.dropdown {
    background: linear-gradient(145deg, #e3dedf, #ffffff);
    box-shadow: 15px 15px 30px #d6d2d3, -15px -15px 30px #ffffff;
}

.card {
    background: linear-gradient(145deg, #e3dedf, #ffffff);
    box-shadow: 10px 10px 15px #cac6c6, -10px -10px 15px #ffffff;
}
.card:hover {
    background: linear-gradient(145deg, #e3dedf, #ffffff);
    box-shadow: -10px -10px 15px #a19e9f, 10px 10px 15px #ffffff;
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
    .dark\:dropdown {
        background: #303633;
        box-shadow: 15px 15px 30px #292e2b, -15px -15px 30px #373e3b;
    }
}
</style>