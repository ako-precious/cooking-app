<script setup>
import { Link } from '@inertiajs/vue3';

import { useDark, useToggle } from "@vueuse/core";
const isDark = useDark();
const toggleDarkMode = useToggle(isDark);
</script>

<template>
    <Link :href="'/meals'">
       
       <img src="/images/logo2.png" class="rounded-full w-10 h-10" alt="">
         </Link>
</template>
