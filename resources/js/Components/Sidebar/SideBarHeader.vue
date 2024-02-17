<template>
   
   <div  class="h-20  sticky  top-0 right-0" >
    <div class="">

        <i
            class=" p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 dark:text-white xl:hidden"
            aria-hidden="true"
            sidenav-close-btn=""
        ></i>
        <a
            class="flex items-center px-8 py-6 m-0 text-sm whitespace-nowrap text-slate-700 dark:text-white"
            href="#"
        >
            <!-- <img
                src="../../../../assets/img/cricket_logo.png"
                class="inline-block h-full max-w-full transition-all duration-200 ease-in-out max-h-8 dark:hidden"
                alt="main_logo"
            />
            <img
                src="../../../../assets/img/cricket_logo.png"
                class="hidden h-full max-w-full transition-all duration-200 ease-in-out max-h-8 dark:inline-block"
                alt="main_logo"
            /> -->
            <slot>Default</slot>
        </a>
    </div>
        </div>
</template>
<script setup></script>
<script></script>
