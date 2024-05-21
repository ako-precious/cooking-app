<template>
    <form @submit.prevent="filter">
        <div class="mb-8 mt-4 flex flex-col gap-2 justify-center shadow-reverse p-10 overflow-x-scroll disable-scrollbars max-w-xl m-auto">
            <div class="flex flex-col items-center mt-4 group ">
                <TextInput
                    id="meal" v-model="filterForm.name"
                    type="meal"
                    class="mt-1 block w-full p-3"
                    autofocus
                    autocomplete="Meal name"
                />
            </div>
            <div class="flex flex-nowrap items-center">
                <div class="flex items-center rounded-lg mr-1 w-1/2">
                    <select v-model="filterForm.status"
                        title="Status"
                        class="p-3 border-oynx bg-snow text-oynx dark:bg-oynx dark:text-snow bg-gradient-to-br from-[#e3dedf] to-[#ffffff] w-full shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] focus:shadow-none dark:focus:shadow-none dark:shadow-oynx-sm dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred rounded-md">
                        <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2" :value="null">Status</option>
                        <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2" value="pending">Pending</option>
                        <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2" value="rejected">Rejected</option>
                        <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2" value="accepted">Accepted</option>
                        <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2" value="processed">Processed</option>
                        <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2" value="ready">Ready</option>
                        <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2" value="in transit">In Transit</option>
                        <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2" value="delivered">Delivered</option>
                        <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2" value="confirmed">Confirmed</option>
                    </select>
                </div>
                <div class="flex items-center py-1 px-1.5 rounded-lg w-1/2">
                    <select v-model="filterForm.meal_time"
                        title="Meal Time"
                        placeholder="Choose a meal time"
                        class="p-3 border-oynx bg-snow text-oynx dark:bg-oynx dark:text-snow bg-gradient-to-br from-[#e3dedf] to-[#ffffff] w-full shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] focus:shadow-none dark:focus:shadow-none dark:shadow-oynx-sm dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred rounded-md">
                        <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2" :value="null">Meal Time</option>
                        <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2" value="breakfast">Breakfast</option>
                        <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2" value="lunch">Lunch</option>
                        <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2" value="dinner">Dinner</option>
                    </select>
                </div>
            </div>
            <div class="flex flex-nowrap items-center">
                <div class="flex items-center py-1 px-1.5 rounded-lg mr-1 w-1/2">
                    <TextInput
                        id="meal"
                        v-model="filterForm.delivery_date_from" type="date"
                        class="mt-1 block w-full p-3"
                        placeholder="Delivery Date From"
                    />
                </div>
                <div class="flex items-center py-1 px-1.5 rounded-lg w-1/2">
                    <TextInput
                        v-model="filterForm.delivery_date_to" id="meal"
                        type="date"
                        class="mt-1 block w-full p-3"
                        placeholder="Delivery Date To"
                    />
                </div>
            </div>
            <div class="flex justify-between px-3">
                <PrimaryButton class="w-28" type="submit">Filter</PrimaryButton>
                <button type="reset" class="relative group" @click="clear">
                    <span class="hover-underline-animation ml-5 text-lg capitalize">clear</span>
                </button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
const props = defineProps({
    filters: {
        type: Object,
        default: () => ({}),
    },
});

const filterForm = useForm({
    name: props.filters.name ?? null,
    status: props.filters.status ?? null,
    meal_time: props.filters.meal_time ?? null,
    delivery_date_from: props.filters.delivery_date_from ?? null,
    delivery_date_to: props.filters.delivery_date_to ?? null,
});

const filter = () => {
    filterForm.get('/meal-schedule', {
        preserveScroll: true,
        preserveState: true,
    })
    ;
};

const clear = () => {
    filterForm.name = null;
    filterForm.status = null;
    filterForm.meal_time = null;
    filterForm.delivery_date_from = null;
    filterForm.delivery_date_to = null;
    filter();
};
</script>

<style>
select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
</style>
