<script setup>
defineProps({
    value: String,
});
</script>

<template>
    <label class="block font-medium text-sm text-oynx  group-active:text-polynesian group-hover:text-polynesian dark:text-snow dark:group-active:text-lighred dark:group-hover:text-lighred ">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
