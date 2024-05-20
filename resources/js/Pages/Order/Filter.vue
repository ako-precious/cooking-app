<template>
    <form @submit.prevent="filter">
        <div class="mb-8 mt-4 flex flex-wrap gap-2 justify-center">
            <div class="flex flex-nowrap items-center">
                <div class="flex items-center border-2 py-1 px-1.5 rounded-lg">
                    <input v-model="filterForm.name"
                        class="pl-1.5 outline-none border-none bg-transparent text-white text-sm"
                        type="text"
                        name=""
                        id=""
                        placeholder="Name"
                    />
                </div>
            </div>

            <div class="flex flex-nowrap items-center">
                <div
                    class="flex items-center border-2 py-1 px-1.5 rounded-lg w-28 mr-1"
                >
                    <select v-model="filterForm.status"
                        class="outline-none border-none bg-transparent text-white text-sm capitalize"
                    >
                       <option class="bg-green-400 p-2 dark:bg-slate-850" :value="null">
                            Status
                        </option>
                        <!-- <option class="bg-green-400 p-2 dark:bg-slate-850" :value="null">
                            Match Format
                        </option> -->
                        <option class="bg-green-400 p-2 dark:bg-slate-850" value="pending">
                            Pending
                        </option>
                        <option class="bg-green-400 p-2 dark:bg-slate-850" value="rejected">
                           Rejected
                        </option>
                        <option class="bg-green-400 p-2 dark:bg-slate-850" value="accepted">
                            accepted
                        </option>
                        <option class="bg-green-400 p-2 dark:bg-slate-850" value="Processed">
                            Processed
                        </option>
                        <option class="bg-green-400 p-2 dark:bg-slate-850" value="ready">
                            ready
                        </option>
                        <option class="bg-green-400 p-2 dark:bg-slate-850" value="in transit">
                            in transit
                        </option>
                        <option class="bg-green-400 p-2 dark:bg-slate-850" value="delivered">
                            delivered
                        </option>
                        <option class="bg-green-400 p-2 dark:bg-slate-850" value="Confirmed">
                            Confirmed
                        </option>
                    </select>
                </div>
                <div
                    class="flex items-center border-2 py-1 px-1.5 rounded-lg w-28"
                >
                    <select v-model="filterForm.meal_time"
                        class="outline-none border-none bg-transparent text-white text-sm w-full capitalize"
                    >
                        <option class="bg-green-400 p-2 dark:bg-slate-850" :value="null">
                             Meal_time
                        </option>
                        <option class="bg-green-400 p-2 dark:bg-slate-850" value="breakfast">breakfast</option>
                        <option class="bg-green-400 p-2 dark:bg-slate-850" value="lunch">lunch</option>
                        <option class="bg-green-400 p-2 dark:bg-slate-850" value="dinner">dinner</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-nowrap items-center">
              <div class="flex items-center border-2 py-1 px-1.5 rounded-lg w-28 mr-1">
                    <input v-model.number="filterForm.delivery_date_from"
                        class="pl-1.5 outline-none border-none bg-transparent text-white text-sm"
                        type="text"
                        name=""
                        id=""
                        placeholder="Wickets From"
                    />
                </div>
                <div class="flex items-center border-2 py-1 px-1.5 rounded-lg w-28">
                    <input v-model.number="filterForm.delivery_date_to"
                        class="pl-1.5 outline-none border-none bg-transparent text-white text-sm"
                        type="text"
                        name=""
                        id=""
                        placeholder="Wickets To"
                    />
                </div>
            </div>

            <button type="submit" class="btn-normal text-sm dark:bg-slate-800 dark:hover:bg-slate-850 shadow-md">Filter</button>
            <button type="reset" class="text-sm text-white" @click="clear">Clear</button>
        </div>
    </form>
</template>
 <script setup>
import { useForm } from '@inertiajs/vue3';


const props = defineProps({filters: Object})



const filterForm = useForm({
  name: props.filters.name ?? null,
  status:  props.filters.status ?? null,
  meal_time:  props.filters.meal_time ?? null,
  delivery_date_from:  props.filters.delivery_date_from ?? null,
  delivery_date_to:  props.filters.delivery_date_to ?? null,
})

const filter = () => {
  filterForm.get('/Order', {
    preserveScroll: true,
    preserveState: true,
  });
}

const clear = () => {
  
  filterForm.name = null
  filterForm.status = null
  filterForm.meal_time = null
  filterForm.delivery_date_from = null
  filterForm.delivery_date_to = null
  filter()
}
</script>
<style>
select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
</style>
