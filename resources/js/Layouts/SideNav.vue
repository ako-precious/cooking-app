<template>
    <!-- <div class="absolute w-full bg-emerald-600 dark:hidden min-h-75"></div> -->
    <!-- sidenav  -->
    <!-- <aside
        class="fixed inset-y-0 left-0 flex-wrap items-center justify-between block w-full p-0 my-4 transition-all duration-200 ease-in-out -translate-x-full bg-white border-0 shadow-xl dark:shadow-none xl:ml-6 dark:bg-slate-850 z-990 rounded-2xl xl:translate-x-0 ps ps--active-y max-w-24 overflow-hidden"
       
    > -->
    
    <!-- class="fixed inset-y-0 left-0 flex-wrap items-center justify-between block w-full p-0 my-4 transition-all duration-200 ease-in-out -translate-x-full bg-white border-0 shadow-xl dark:shadow-none xl:ml-6 dark:bg-slate-850 z-990 rounded-2xl xl:translate-x-0 ps ps--active-y max-w-24 overflow-hidden" -->
    
    <!-- class="sidebar" -->
    <!-- class="fixed inset-y-0 left-0 flex-wrap items-center justify-between block w-full p-0 my-4 transition-all duration-200 ease-in-out -translate-x-full bg-white border-0 shadow-xl dark:shadow-none xl:ml-6 dark:bg-slate-850 z-990 rounded-2xl xl:translate-x-0 ps ps--active-y max-w-64 overflow-y-auto" -->
    <aside
    style="backdrop-filter: blur(20px)" class="card dark:card"
       
        mini="false"
    >
        <slot>Default</slot>
    </aside>
    </template>
    <style scoped>
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
        /* border-radius: 15px; */
        background: linear-gradient(145deg, #2b312e, #333a37);
        box-shadow: -10px -10px 15px #262b29, 10px 10px 15px #3a413d;
    }
}
</style>
