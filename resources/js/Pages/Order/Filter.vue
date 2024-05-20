<template>
    <form @submit.prevent="filter">
        <div class="mb-8 mt-4 flex flex-col gap-2 justify-center overflow-x-scroll disable-scrollbars max-w-xl m-auto">
            <div class="flex flex-wrap items-center">
                <div class="flex items-center border-2 py-1 px-1.5 rounded-lg w-full">
                    <input v-model="filterForm.name"
                        class="pl-1.5 outline-transparent border-none  bg-transparent text-white text-sm w-full"
                        type="text"
                        name=""
                        id=""
                        placeholder="Name"
                    />
                </div>
            </div>
            <div class="flex flex-nowrap items-center">
                <div class="flex items-center border-2 py-1 px-1.5 rounded-lg  mr-1 w-1/2">
                    <select v-model="filterForm.status"
                        class="outline-none border-none bg-transparent text-white text-sm capitalize w-full"
                    >
                       <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow  p-2 " :value="null">Status</option>
                       <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow  p-2 " value="pending">Pending</option>
                       <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow  p-2 " value="rejected">Rejected</option>
                       <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow  p-2 " value="accepted">Accepted</option>
                       <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow  p-2 " value="processed">Processed</option>
                       <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow  p-2 " value="ready">Ready</option>
                       <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow  p-2 " value="in transit">In Transit</option>
                       <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow  p-2 " value="delivered">Delivered</option>
                       <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow  p-2 " value="confirmed">Confirmed</option>
                    </select>
                </div>
                <div class="flex items-center border-2 py-1 px-1.5 rounded-lg w-1/2">
                    <select v-model="filterForm.meal_time"
                        class="outline-none border-none bg-transparent text-white text-sm w-full capitalize"
                    >
                        <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow  p-2 " :value="null">Meal Time</option>
                        <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow  p-2 " value="breakfast">Breakfast</option>
                        <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow  p-2 " value="lunch">Lunch</option>
                        <option class="bg-snow dark:bg-oynx text-oynx dark:text-snow  p-2 " value="dinner">Dinner</option>
                    </select>
                </div>
            </div>
            <div class="flex flex-nowrap items-center">
              <div class="flex items-center border-2 py-1 px-1.5 rounded-lg mr-1 w-1/2">
                    <input v-model.number="filterForm.delivery_date_from"
                        class="pl-1.5 outline-none border-none bg-transparent text-white text-sm w-full"
                        type="text"
                        placeholder="Delivery Date From"
                    />
                </div>
                <div class="flex items-center border-2 py-1 px-1.5 rounded-lg w-1/2">
                    <input v-model.number="filterForm.delivery_date_to"
                        class="pl-1.5 outline-none border-none bg-transparent text-white text-sm w-full"
                        type="text"
                        placeholder="Delivery Date To"
                    />
                </div>
            </div>
            <div>

                <button type="submit" class="btn-normal text-sm dark:bg-slate-800 dark:hover:bg-slate-850 shadow-md w-28">Filter</button>
                <button type="reset" class="text-sm text-white" @click="clear">Clear</button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

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
  });
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
