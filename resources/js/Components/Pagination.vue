<template>
    <div class="flex justify-center px-6 w-full">
      <Link
        v-for="(link, index) in links" 
        :key="index" class="py-2 px-4 rounded-md text-sm dark:text-snow text-oynx" 
        :href="link.url" 
        :class="{'bg-persian dark:text-snow text-oynx': link.active}"
        v-html="link.label"
      />
    </div>
  </template>
  
  <script setup>
  import {Link} from '@inertiajs/vue3'
  defineProps({links: Array})
  </script>