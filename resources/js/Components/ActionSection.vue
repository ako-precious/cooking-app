<script setup>
import SectionTitle from './SectionTitle.vue';
</script>

<template>
    <div class="mt-5 md:mt-0 md:col-span-2 shadow-reverse text-oynx dark:text-snow rounded-xl">
        <SectionTitle>
            <template #title>
                    <h2 class="text-2xl px-4 pt-6 sm:px-6 text-oynx dark:text-snow"> <slot name="title" /> </h2>  
                </template>
                <template #description>
                  <p class="px-4 sm:px-6 text-oynx dark:text-snow"> <slot name="description" /> </p>  
                </template>
        </SectionTitle>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="px-4 py-5 sm:p-6">
                <slot name="content" />
            </div>
        </div>
    </div>
</template>
