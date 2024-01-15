<template>
    <!-- <div class="absolute w-full bg-emerald-600 dark:hidden min-h-75"></div> -->
    <!-- sidenav  -->
    <!-- <aside
        class="fixed inset-y-0 left-0 flex-wrap items-center justify-between block w-full p-0 my-4 transition-all duration-200 ease-in-out -translate-x-full bg-white border-0 shadow-xl dark:shadow-none xl:ml-6 dark:bg-slate-850 z-990 rounded-2xl xl:translate-x-0 ps ps--active-y max-w-24 overflow-hidden"
       
    > -->
    
    <!-- class="fixed inset-y-0 left-0 flex-wrap items-center justify-between block w-full p-0 my-4 transition-all duration-200 ease-in-out -translate-x-full bg-white border-0 shadow-xl dark:shadow-none xl:ml-6 dark:bg-slate-850 z-990 rounded-2xl xl:translate-x-0 ps ps--active-y max-w-24 overflow-hidden" -->
    <!-- class="fixed inset-y-0 left-0 flex-wrap items-center justify-between block w-full p-0 my-4 transition-all duration-200 ease-in-out -translate-x-full bg-white border-0 shadow-xl dark:shadow-none xl:ml-6 dark:bg-slate-850 z-990 rounded-2xl xl:translate-x-0 ps ps--active-y max-w-64 overflow-y-auto" -->
    
    <!-- class="sidebar" -->
    <aside
    style="backdrop-filter: blur(20px)"
       
        mini="false"
    >
        <slot>Default</slot>
    </aside>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
</script>
<script></script>
