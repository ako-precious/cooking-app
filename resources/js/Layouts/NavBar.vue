<template>
    <!-- Navbar -->
    
    <!-- class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start sticky top-[1%] backdrop-saturate-200 backdrop-blur-2xl dark:bg-slate-850/80 dark:shadow-dark-blur bg-[hsla(0,0%,100%,0.8)] shadow-blur z-110" -->
   
    <nav class="notfixeddiv " navbar-main navbar-scroll="false">
        <div
            class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit"
        >
           <slot>Default</slot>

          
           
        </div>
    </nav>

    <!-- end Navbar -->
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
defineProps(["message"]);
</script>
<script></script>
