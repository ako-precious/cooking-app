<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2  bg-polynesian dark:bg-lighred border  border-polynesian dark:border-lighred rounded-md font-semibold text-xs text-oynx dark:text-snow uppercase tracking-widest shadow-lg hover:bg-persian  focus:outline-none focus:ring-2 focus:ring-persian focus:ring-offset-2 disabled:opacity-25 transition ease-in duration-250">
        <slot />
    </button>
</template>

