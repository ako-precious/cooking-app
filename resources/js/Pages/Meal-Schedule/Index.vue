
<template>
    <AppLayout title="Dashboard">
        <!-- <FullCalendar :InitialEvent=" InitialEvent" ></FullCalendar> -->
    </AppLayout>
</template>

<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
// import { Inertia } from '@inertiajs/inertia';
import FullCalendar from '@/Pages/FullCalendar.vue';

defineProps({
    InputEvent: array,
    
});

console.log(InitialEvent);
</script>

<script>

export default {
    
    props: ['InitialEvent'],
    
    data() {
        return {
            InitialEvent: InitialEvent,
        };
    },
    
};
console.log(InitialEvent)
</script> 