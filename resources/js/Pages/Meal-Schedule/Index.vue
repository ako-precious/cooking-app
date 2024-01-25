<template>
    <AppLayout title="Dashboard">
        <FullCalendar :InitialEvent=" InitialEvent" ></FullCalendar>
        <li v-for="event in InitialEvent" :key="event.id">
        {{ event.meal }}
      </li>
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


