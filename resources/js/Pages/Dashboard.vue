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
   
    <!-- sidenav  -->

    <SideNav
        @mouseover="hoverSidebar()"
        @mouseout="hoverOutSidebar()"
        :class="
            (sidebarReduced,
            {
                'bg-slate-850': isClassWhite,
                'translate-x-0': isClassTranslated,
            })
        "
    >
        <SideBarHeader>
            <span
                :class="{ 'opacity-0': isLinkHidden }"
                class="ml-2 font-bold transition-all duration-200 ease-in-out text-2xl uppercase"
            >
                Cricket
            </span>
        </SideBarHeader>

        <SideBarCollapse>
            <li class="mt-0.5 w-full group">
                <SideBarLink :class="getRouteClass('default')">
                    <SideBarIcon class="group-hover:animate-bounce">
                        </SideBarIcon>
                    <SideBarSpan :class="{ 'opacity-0': isLinkHidden }">
                        Dashboard
                    </SideBarSpan>
                </SideBarLink>
            </li>
            <li class="mt-0.5 w-full group">
                <SideBarLink :class="getRouteClass('players')">
                    <SideBarIcon class="group-hover:animate-pulse">
                       
                    </SideBarIcon>
                    <SideBarSpan :class="{ 'opacity-0': isLinkHidden }">
                        Players
                    </SideBarSpan>
                </SideBarLink>
            </li>
            <li class="mt-0.5 w-full group">
                <SideBarLink :class="getRouteClass('teams')">
                    <SideBarIcon class="group-hover:animate-spin">
                        
                    </SideBarIcon>
                    <SideBarSpan :class="{ 'opacity-0': isLinkHidden }">
                        Teams
                    </SideBarSpan>
                </SideBarLink>
            </li>
            <li class="mt-0.5 w-full group">
                <SideBarLink :class="getRouteClass('batting')">
                    <SideBarIcon class="group-hover:animate-spin">
                       
                    </SideBarIcon>
                    <SideBarSpan :class="{ 'opacity-0': isLinkHidden }">
                        Batting
                    </SideBarSpan>
                </SideBarLink>
            </li>
            <li class="mt-0.5 w-full group">
                <SideBarLink :class="getRouteClass('bowling')">
                    <SideBarIcon class="group-hover:animate-spin">
                        
                    </SideBarIcon>
                    <SideBarSpan :class="{ 'opacity-0': isLinkHidden }">
                        Bowling
                    </SideBarSpan>
                </SideBarLink>
            </li>
        </SideBarCollapse>
    </SideNav>
    <!-- sidenav  -->

    
    <!-- fixed plugin  -->
    
    <!-- end fixed plugin  -->
</template>
<script setup>
// import { Link } from "@inertiajs/vue3";

import SideBarLink from "@/Components/Sidebar/SideBarLink.vue";
import SideBarSpan from "@/Components/Sidebar/SideBarSpan.vue";
import SideBarIcon from "@/Components/Sidebar/SideBarIcon.vue";
import SideBarHeader from "@/Components/Sidebar/SideBarHeader.vue";
// import SideBarColour from "@/Layout/Component/Sidebar/SideBarColour.vue";
import SideBarCollapse from "@/Components/Sidebar/SideBarCollapse.vue";
import SideNav from "@/Layouts/SideNav.vue";

// defineProps(["message"]);
</script>
<script>
export default {
    computed: {
        currentRoute() {
            return window.location.pathname;
        },
    },
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
        };
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
            this.marginReduced =
                this.marginReduced === "xl:ml-68" ? "xl:ml-30" : "xl:ml-68";
            this.sidebarReduced =
                this.sidebarReduced === "sidebar" ? "minisidebar" : "sidebar";
            this.isClassTranslated2 = !this.isClassTranslated2;
        },
        hoverSidebar() {
            if (this.sidebarReduced === "minisidebar") {
                this.isLinkHidden = !this.isLinkHidden;
                this.marginReduced =
                    this.marginReduced === "xl:ml-68" ? "xl:ml-30" : "xl:ml-68";
                this.sidebarReduced =
                    this.sidebarReduced === "sidebar"
                        ? "minisidebar"
                        : "sidebar";
                this.isClassTranslated2 = !this.isClassTranslated2;
                this.hover = true;
            }
        },
        hoverOutSidebar() {
            if (this.hover === true) {
                this.isLinkHidden = !this.isLinkHidden;
                this.marginReduced =
                    this.marginReduced === "xl:ml-68" ? "xl:ml-30" : "xl:ml-68";
                this.sidebarReduced =
                    this.sidebarReduced === "sidebar"
                        ? "minisidebar"
                        : "sidebar";
                this.isClassTranslated2 = !this.isClassTranslated2;
                this.hover = false;
            }
        },
        // isPlayersRoute() {
        //     // Check if the route name contains the word "players"
        //     return currentRoute.includes("players");
        // },
        getRouteClass() {
            return (routeName) => {
                return {
                    activateclass: this.currentRoute.includes(routeName),
                };
            };
        },
    },
};
</script>
