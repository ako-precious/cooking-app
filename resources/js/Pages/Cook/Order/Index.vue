<script setup>
import { Head, Link } from "@inertiajs/vue3";
import TableHeadVue from "@/Components/Table/TableHead.vue";
import TableRow from "./TableRow.vue";
import HeaderVue from "../Header.vue";
import  CaretDown  from "@/Components/CaretDown.vue";
import  CaretUp  from "@/Components/CaretUp.vue";
</script>

<template>
    <Head>Orders</Head>

    <div
        class="relative sm:flex sm:justify-center sm:items-center  bg-center bg-snow dark:bg-oynx selection:bg-red-500 selection:text-white"
    >
        <div class="container relative mx-auto">
            <div>
                <HeaderVue> </HeaderVue>
            </div>
            <div
                class="m-auto flex flex-col justify-center h-full lg:pb-12 w-full"
            >
                <div class="col-span-1 w-full max-w-full py-6">
                      <div
                        class="sticky flex flex-col min-w-full break-words w-full top-1/100 dark:bg-oynx rounded-2xl bg-clip-border"
                    >
                        <ul
                            class=" overflow-x-scroll disable-scrollbars flex  w-full p-4 mb-0 list-none rounded-xl"
                        >
                            <li class="px-2">
                                <button
                                    @click="
                                        [
                                            chooseStatus(meal_orders),
                                            selectedDiv('meal_orders'),
                                        ]
                                    "
                                    :class="{
                                        'bg-persian text-snow':
                                            selected === 'meal_orders',
                                    }"
                                    class="relative w-32 font-bold flex items-center justify-center rounded-lg text-oynx dark:text-snow overflow-hidden cursor-pointer border border-persian"
                                >
                                    <span
                                        class="text-center w-full py-2 text-sm tracking-wider z-20 transition-all duration-300 ease-in-out"
                                        >ALL [{{
                                            meal_orders.flat().length
                                        }}]</span
                                    >
                                </button>
                            </li>
                            <li class="px-2">
                                <button
                                    @click="
                                        [
                                            chooseStatus(pending),
                                            selectedDiv('pending'),
                                        ]
                                    "
                                    :class="{
                                        'bg-persian text-snow':
                                            selected === 'pending',
                                    }"
                                    class="relative w-32 font-bold flex items-center justify-center rounded-lg text-oynx dark:text-snow overflow-hidden cursor-pointer border border-persian"
                                >
                                    <span
                                        class="text-center w-full py-2 text-sm tracking-wider z-20 transition-all duration-300 ease-in-out"
                                        >Pending [{{
                                            pending.flat().length
                                        }}]</span
                                    >
                                </button>
                            </li>
                            <li class="px-2">
                                <button
                                    @click="
                                        [
                                            chooseStatus(reject),
                                            selectedDiv('reject'),
                                        ]
                                    "
                                    :class="{
                                        'bg-persian text-snow':
                                            selected === 'reject',
                                    }"
                                    class="relative w-32 font-bold flex items-center justify-center rounded-lg text-oynx dark:text-snow overflow-hidden cursor-pointer border border-persian"
                                >
                                    <span
                                        class="text-center w-full py-2 text-sm tracking-wider z-20 transition-all duration-300 ease-in-out"
                                        >Rejected [{{
                                            reject.flat().length
                                        }}]</span
                                    >
                                </button>
                            </li>
                            <li class="px-2">
                                <button
                                    @click="
                                        [
                                            chooseStatus(accept),
                                            selectedDiv('accept'),
                                        ]
                                    "
                                    :class="{
                                        'bg-persian text-snow':
                                            selected === 'accept',
                                    }"
                                    class="relative w-32 font-bold flex items-center justify-center rounded-lg text-oynx dark:text-snow overflow-hidden cursor-pointer border border-persian"
                                >
                                    <span
                                        class="text-center w-full py-2 text-sm tracking-wider z-20 transition-all duration-300 ease-in-out"
                                        >Accepted [{{
                                            accept.flat().length
                                        }}]</span
                                    >
                                </button>
                            </li>
                            <li class="px-2">
                                <button
                                    @click="
                                        [
                                            chooseStatus(processed),
                                            selectedDiv('processed'),
                                        ]
                                    "
                                    :class="{
                                        'bg-persian text-snow':
                                            selected === 'processed',
                                    }"
                                    class="relative w-32 font-bold flex items-center justify-center rounded-lg text-oynx dark:text-snow overflow-hidden cursor-pointer border border-persian"
                                >
                                    <span
                                        class="text-center w-full py-2 text-sm tracking-wider z-20 transition-all duration-300 ease-in-out"
                                        >Processed [{{
                                            processed.flat().length
                                        }}]</span
                                    >
                                </button>
                            </li>
                            <li class="px-2">
                                <button
                                    @click="
                                        [
                                            chooseStatus(delivered),
                                            selectedDiv('delivered'),
                                        ]
                                    "
                                    :class="{
                                        'bg-persian text-snow':
                                            selected === 'delivered',
                                    }"
                                    class="relative w-32 font-bold flex items-center justify-center rounded-lg text-oynx dark:text-snow overflow-hidden cursor-pointer border border-persian"
                                >
                                    <span
                                        class="text-center w-full py-2 text-sm tracking-wider z-20 transition-all duration-300 ease-in-out"
                                        >delivered [{{
                                            delivered.flat().length
                                        }}]</span
                                    >
                                </button>
                            </li>
                            <li class="px-2">
                                <button
                                    @click="
                                        [
                                            chooseStatus(confirmed),
                                            selectedDiv('confirmed'),
                                        ]
                                    "
                                    :class="{
                                        'bg-persian text-snow':
                                            selected === 'confirmed',
                                    }"
                                    class="relative w-32 font-bold flex items-center justify-center rounded-lg text-oynx dark:text-snow overflow-hidden cursor-pointer border border-persian"
                                >
                                    <span
                                        class="text-center w-full py-2 text-sm tracking-wider z-20 transition-all duration-300 ease-in-out"
                                        >confirmed [{{
                                            confirmed.flat().length
                                        }}]</span
                                    >
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="lg:w-full">
                    <div class="flex flex-col w-full">
                        <div class="sm:-mx-6 lg:-mx-8">
                            <div
                                class="inline-block w-full py-2 sm:px-6 lg:px-8"
                            >
                                <div
                                    class="overflow-x-scroll disable-scrollbars"
                                >
                                    <table
                                        class="w-full px-4 text-left text-sm font-light relative"
                                    >
                                        <thead
                                            class="align-bottom shadow-sm translate-x-0 sticky top-1"
                                        >
                                            <tr>
                                                <TableHeadVue>
                                                    <template #title>
                                                        Meal Title
                                                    </template>
                                                    <template #symbols>
                                                        <CaretUp />
                                                        <CaretDown/>
                                                    </template>
                                                </TableHeadVue>
                                                <TableHeadVue>
                                                    <template #title>
                                                        Customer's NAme
                                                    </template>
                                                    <template #symbols>
                                                        <CaretUp/>
                                                        <CaretDown/>
                                                    </template>
                                                </TableHeadVue>
                                                <TableHeadVue>
                                                    <template #title>
                                                        Meal Time
                                                    </template>
                                                    <template #symbols>
                                                        <CaretUp/>
                                                        <CaretDown/>
                                                    </template>
                                                </TableHeadVue>
                                                <TableHeadVue>
                                                    <template #title>
                                                        Meal Delivery Date
                                                    </template>
                                                    <template #symbols>
                                                        <CaretUp/>
                                                        <CaretDown/>
                                                    </template>
                                                </TableHeadVue>
                                                <TableHeadVue>
                                                    <template #title>
                                                        status
                                                    </template>
                                                    <template #symbols>
                                                        <CaretUp/>
                                                        <CaretDown/>
                                                    </template>
                                                </TableHeadVue>
                                                <TableHeadVue>
                                                    <template #title>
                                                        Change Status
                                                    </template>
                                                    <template #symbols>
                                                    </template>
                                                </TableHeadVue>
                                            </tr>
                                        </thead>

                                        <tbody class="relative">
                                            <tr
                                                v-for="order in orders.flat()"
                                                :key="order.id"
                                                class="animate-fade-in border-b py-4"
                                            >
                                                <TableRow :order="order">
                                                </TableRow>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: {
        meal_orders: Object,
        pending: Object,
        reject: Object,
        accept: Object,
        processed: Object,
        ready: Object,
        delivered: Object,
        confirmed: Object,
    },
    data() {
        return {
            orders: this.meal_orders,
            selected: "meal_orders",
        };
    },
    mounted() {
        // const allMealSchedules = this.orders.flat();
        // // Extract the id values from all objects
        // const allIds = allMealSchedules.map((mealSchedule) => mealSchedule.meal.name);
        // // Now allIds contains the id values of all objects
        // console.log(allIds);
        // console.log(this.orders);
    },
    methods: {
        chooseStatus(status) {
            this.orders = status;
        },
        selectedDiv(status) {
            this.selected = status;
        },
    },
};
</script>

<style scoped>
button:after {
    content: " ";
    width: 0%;
    height: 100%;
    background: #1b998b;
    position: absolute;
    transition: all 0.4s ease-in-out;
    right: 0;
}

button:hover::after {
    right: auto;
    left: 0;
    width: 100%;
}

button:hover span {
    color: white;
    animation: scaleUp 0.3s ease-in-out;
}

@keyframes scaleUp {
    0% {
        transform: scale(1);
    }

    50% {
        transform: scale(0.95);
    }

    100% {
        transform: scale(1);
    }
}

@keyframes fade-in {
    from {
        opacity: 0;
        bottom: -10rem;
    }
    to {
        opacity: 1;
        bottom: 0;
    }
}

.animate-fade-in {
    animation: fade-in 0.5s ease-in;
}
</style>
