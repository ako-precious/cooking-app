<!-- <script setup>
    import Welcome from '@/Components/Welcome.vue';
</script> -->

<template>
    <AppLayout title="Dashboard">
        
    </AppLayout>
</template>


<script setup>
import { Link } from "@inertiajs/vue3";
import AppLayout from '@/Layouts/AppLayout.vue';

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
