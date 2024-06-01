<template>
    <AppLayout title="Meal Schedules">
      
        <FullCalendar ></FullCalendar>
   </AppLayout>
</template>

<script setup>
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
// import { Inertia } from '@inertiajs/inertia';
import FullCalendar from "@/Pages/FullCalendar.vue";

// const InitialEvent = ref(InitialEvent);
// const props =
 defineProps({
  InitialEvent: {
    type: Array,
    required: true
  }
});

// console.log(InitialEvent);
</script>


