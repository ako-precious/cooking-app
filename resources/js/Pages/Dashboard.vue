<!-- <script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script> -->

<!-- <template>
    <AppLayout title="Dashboard">
   <-- sidenav  --
    </AppLayout>
</template> -->

<template>
    <div
        class="absolute h-screen w-full bg-[linear-gradient(to_right_bottom,rgba(5,150,105,1),rgba(74,223,128,0.8))] dark:hidden min-h-75"
    ></div>
    <!-- sidenav  -->

    <SideNav @mouseover="hoverSidebar()" @mouseout="hoverOutSidebar()"
        :class=" sidebarReduced, {
            'bg-slate-850': isClassWhite,
            'translate-x-0':isClassTranslated,
            
        }"
    >
        <SideBarHeader>
            <span :class="{ 'opacity-0': isLinkHidden }"
                class="ml-2 font-bold transition-all duration-200 ease-in-out text-2xl uppercase"
            >
                Cricket
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
                <SideBarLink :class="getRouteClass('teams')">
                    <SideBarIcon class="group-hover:animate-pulse">
                        <font-awesome-icon icon="fa-solid fa-people-group" style="color: #2a744a"/>
                       
                    </SideBarIcon>
                    <SideBarSpan :class="{ 'opacity-0': isLinkHidden }"> Teams </SideBarSpan>
                </SideBarLink>
            </Link>
            </li>
            <li class="mt-0.5 w-full group">
                <Link :href="`/players`">
                <SideBarLink :class="getRouteClass('players')">
                    <SideBarIcon class="group-hover:animate-bounce">
   
   <div class="`"></div>                     <font-awesome-icon icon="fa-solid fa-person"  style="color: #2a744a"/> 
                            
                    </SideBarIcon>
                    <SideBarSpan :class="{ 'opacity-0': isLinkHidden }"> Players </SideBarSpan>
                </SideBarLink>
            </Link>
            </li>
            
            <li class="mt-0.5 w-full group">
                <Link :href="`/battings`">
                <SideBarLink :class="getRouteClass('batting')">
                    <SideBarIcon class="group-hover:animate-pulse">
                        <font-awesome-icon
                            icon="fas-solid fa-baseball-bat-ball"
                            style="color: #2a744a"
                        />
                    </SideBarIcon>
                    <SideBarSpan :class="{ 'opacity-0': isLinkHidden }"> Batting Stats </SideBarSpan>
                </SideBarLink>
            </Link>
            </li>
            <li class="mt-0.5 w-full group">
                <Link :href="`/bowlings`">
                <SideBarLink :class="getRouteClass('bowlings')">
                    <SideBarIcon class="group-hover:animate-spin">
                        <font-awesome-icon
                            icon="fa-solid fa-baseball"
                            style="color: #2a744a"
                        />
                    </SideBarIcon>
                    <SideBarSpan :class="{ 'opacity-0': isLinkHidden }"> Bowling Stats </SideBarSpan>
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
            <nav>
                <ol
                    class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16"
                >
                    <li class="text-sm leading-normal">
                        <a class="text-white opacity-50" href="javascript:;"
                            >Pages</a
                        >
                    </li>
                    <li id="resultDiv"
                        class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']"
                        aria-current="page"
                    >
                    {{ resultText }}
                    </li>
                </ol>
                <h6 class="mb-0 font-bold text-white capitalize"> <div id="resultDiv">{{ resultText }}</div> </h6>
            </nav>

            <SubNavBar @click="minSidebar()">
                <i  :class="{ 'translate-x-[5px]': isClassTranslated2 }"
                    class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all " 
                ></i>
                <i
                    class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"
                ></i>
                <i  :class="{ 'translate-x-[5px]': isClassTranslated2 }"
                    class="ease relative block h-0.5 rounded-sm bg-white transition-all "
                ></i>
            </SubNavBar>

            <NavSideBar>
                
                <div class="w-4.5 overflow-hidden" @click="openSidebar()">

                    <i
                        class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"
                        :class="{ 'translate-x-[5px]': isClassTranslated }"
                    ></i>
                    <i
                        class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"
                    ></i>
                    <i
                        class="ease relative block h-0.5 rounded-sm bg-white transition-all"
                        :class="{ 'translate-x-[5px]': isClassTranslated }"
                    ></i>
                </div>
            </NavSideBar>
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
        <hr
            class="h-px mx-0 my-1 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
        />

        <!-- Sidenav Type -->
        <div class="mt-4">
            <h6 class="mb-0 dark:text-white">Sidenav Type</h6>
            <p class="text-sm leading-normal dark:text-white dark:opacity-80">
                Choose between 2 different sidenav types.
            </p>
        </div>
        <div class="flex">
            <WhiteBgBtn class="whitebtn" @click="changeBgWhite()"
                >Light</WhiteBgBtn
            >
            <WhiteBgBtn class="blackbtn" @click="changeBgBlack()"
                >Dark</WhiteBgBtn
            >
        </div>
    </FixLayout>
    <!-- end fixed plugin  -->
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
// import Footer from "@/Layouts/FooterLayout.vue";
import SideBarLink from "@/Components/Sidebar/SideBarLink.vue";
import SideBarSpan from "@/Components/Sidebar/SideBarSpan.vue";
import SideBarIcon from "@/Components/Sidebar/SideBarIcon.vue";
import SideBarHeader from "@/Components/Sidebar/SideBarHeader.vue";
import SideBarCollapse from "@/Components/Sidebar/SideBarCollapse.vue";
import NavBar from "@/Layouts/NavBar.vue";
import SubNavBar from "@/Components/Navbar/NavBar.vue";
import NavSideBar from "@/Components/Navbar/NavSideBar.vue";
import SideNav from "@/Layouts/SideNav.vue";
import FixLayout from "@/Layouts/FixLayout.vue";
// defineProps(["message"]);
</script>
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
                    ? "fixeddiv"
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

