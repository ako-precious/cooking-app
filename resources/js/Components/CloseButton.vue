<template> <div    @click="$emit('close')"
    class="relative border-2 cursor-pointer border-oynx rounded-full dark:border-snow group hover:border-persian dark:hover:border-persian w-10 h-10 duration-500 overflow-hidden"
    type="button"
>
    <p
        class="font-Manrope text-3xl h-full w-full flex items-center justify-center text-oynx dark:text-snow duration-500 relative z-10 group-hover:scale-0"
    >
        ×
    </p>
    <span
        class="absolute w-full h-full bg-persian rotate-45 group-hover:top-8 duration-500 top-12 left-0"
    ></span>
    <span
        class="absolute w-full h-full bg-persian rotate-45 top-0 group-hover:left-8 duration-500 left-12"
    ></span>
    <span
        class="absolute w-full h-full bg-persian rotate-45 top-0 group-hover:right-8 duration-500 right-12"
    ></span>
    <span
        class="absolute w-full h-full bg-persian rotate-45 group-hover:bottom-8 duration-500 bottom-12 right-0"
    ></span>
</div></template>