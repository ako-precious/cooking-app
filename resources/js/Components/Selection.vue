<script setup>
import { onMounted, ref } from "vue";

defineProps({
    modelValue: String,
});

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <select
        
        class="input dark:input border-persian focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred rounded-md text-oynx dark:text-snow"
    >
        <option selected>Choose a Meal Time</option>
        <option value="breakfast">Breakfast</option>
        <option value="launch">Launch</option>
        <option value="dinner">Dinner</option>
    </select>
</template>

<style>
.input {
    background: linear-gradient(145deg, #e3dedf, #ffffff);
    box-shadow: 7px 7px 10px #656363, -7px -7px 10px #ffffff;
}

@media (prefers-color-scheme: dark) {
    .dark\:input {
        background: linear-gradient(145deg, #2b312e, #333a37);
        box-shadow: 7px 7px 10px #131614, -7px -7px 10px #3b413e;
    }
    /* .dark\:foodcard:hover {
        
        background: linear-gradient(145deg, #2b312e, #333a37);
        box-shadow: -25px -25px 50px #262b29, 25px 25px 50px #3a413d;
    } */
}
</style>
