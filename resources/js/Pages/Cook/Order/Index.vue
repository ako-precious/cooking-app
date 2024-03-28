<script setup>
import { Head, Link } from "@inertiajs/vue3";
import TableHeadVue from "@/Components/Table/TableHead.vue";
import TableRow from "./TableRow.vue";
import HeaderVue from "../Header.vue";
import CaretDown from "@/Components/CaretDown.vue";
import CaretUp from "@/Components/CaretUp.vue";
</script>

<template>
    <Head title="Orders" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center bg-center bg-snow dark:bg-oynx selection:bg-red-500 selection:text-white"
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
                            class="overflow-x-scroll disable-scrollbars flex w-full p-4 mb-0 list-none rounded-xl"
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
                                        class="text-center w-full py-2 text-sm tracking-wider capitalize z-20 transition-all duration-300 ease-in-out"
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
                                        class="text-center w-full py-2 text-sm tracking-wider capitalize z-20 transition-all duration-300 ease-in-out"
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
                                        class="text-center w-full py-2 text-sm tracking-wider capitalize z-20 transition-all duration-300 ease-in-out"
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
                                        class="text-center w-full py-2 text-sm tracking-wider capitalize z-20 transition-all duration-300 ease-in-out"
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
                                        class="text-center w-full py-2 text-sm tracking-wider capitalize z-20 transition-all duration-300 ease-in-out"
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
                                            chooseStatus(ready),
                                            selectedDiv('ready'),
                                        ]
                                    "
                                    :class="{
                                        'bg-persian text-snow':
                                            selected === 'ready',
                                    }"
                                    class="relative w-32 font-bold flex items-center justify-center rounded-lg text-oynx dark:text-snow overflow-hidden cursor-pointer border border-persian"
                                >
                                    <span
                                        class="text-center w-full py-2 text-sm tracking-wider capitalize z-20 transition-all duration-300 ease-in-out"
                                        >ready [{{ ready.flat().length }}]</span
                                    >
                                </button>
                            </li>
                            <li class="px-2">
                                <button
                                    @click="
                                        [
                                            chooseStatus(transit),
                                            selectedDiv('transit'),
                                        ]
                                    "
                                    :class="{
                                        'bg-persian text-snow':
                                            selected === 'transit',
                                    }"
                                    class="relative w-32 font-bold flex items-center justify-center rounded-lg text-oynx dark:text-snow overflow-hidden cursor-pointer border border-persian"
                                >
                                    <span
                                        class="text-center w-full py-2 text-sm tracking-wider capitalize z-20 transition-all duration-300 ease-in-out"
                                        >In transit [{{
                                            transit.flat().length
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
                                        class="text-center w-full py-2 text-sm tracking-wider capitalize z-20 transition-all duration-300 ease-in-out"
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
                                        class="text-center w-full py-2 text-sm tracking-wider capitalize z-20 transition-all duration-300 ease-in-out"
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
                                                <TableHeadVue
                                                    @click="sort('meal_title')"
                                                    :active="
                                                        selected ===
                                                        'meal_title'
                                                    "
                                                >
                                                    <template #title>
                                                        Meal Title
                                                    </template>
                                                    <template #symbols>
                                                        <CaretUp
                                                            @click="
                                                                sort(
                                                                    'meal_title',
                                                                    true
                                                                )
                                                            "
                                                        />
                                                        <CaretDown
                                                            @click="
                                                                sort(
                                                                    'meal_title',
                                                                    false
                                                                )
                                                            "
                                                        />
                                                    </template>
                                                </TableHeadVue>
                                                 <TableHeadVue @click="sort('customer_name')" :active="selected === 'customer_name'">
      <template #title>
        Customer's Name
      </template>
      <template #symbols>
        <CaretUp @click="sort('customer_name', true)" />
        <CaretDown @click="sort('customer_name', false)" />
      </template>
    </TableHeadVue>
    <TableHeadVue @click="sort('meal_time')" :active="selected === 'meal_time'">
      <template #title>
        Meal Time
      </template>
      <template #symbols>
        <CaretUp @click="sort('meal_time', true)" />
        <CaretDown @click="sort('meal_time', false)" />
      </template>
    </TableHeadVue>
                                                <TableHeadVue>
                                                    <template #title>
                                                        Meal Delivery Date
                                                    </template>
                                                    <template #symbols>
                                                        <CaretUp />
                                                        <CaretDown />
                                                    </template>
                                                </TableHeadVue>
                                                <TableHeadVue>
                                                    <template #title>
                                                        status
                                                    </template>
                                                    <template #symbols>
                                                        <CaretUp />
                                                        <CaretDown />
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
                                                v-if="orders.flat().length > 0"
                                                v-for="order in sortedOrders.flat() "
                                                :key="order.id"
                                                class="animate-fade-in border-b py-4  text-oynx active:text-persian hover:text-polynesian dark:text-snow dark:active:text-persian dark:hover:text-lighred"
                                            >
                                                <TableRow :order="order">
                                                </TableRow>
                                            </tr>
                                            <tr
                                                v-else
                                                class="animate-fade-in border-b py-4 mx-auto"
                                            >
                                                <td colspan="6">
                                                    <div
                                                        class="py-6 italic text-lg text-center text-oynx dark:text-snow max-w-xl mx-auto"
                                                    >
                                                        You have nothing here.
                                                    </div>
                                                </td>
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
        transit: Object,
        delivered: Object,
        confirmed: Object,
    },
    data() {
        return {
            orders: this.meal_orders,
            selected: "meal_orders",
            sortOrder: "asc", // Default sort order
            sortBy: "name", // Default sort by name
        };
    },
    computed: {
  sortedOrders() {
    return this.orders.flat().sort((a, b) => {
      if (this.selected === "meal_title") {
        return (a.meal_title || '').localeCompare(b.meal_title || '');
      } else if (this.selected === "customer_name") {
        return (a.customer_name || '').localeCompare(b.customer_name || '');
      } else if (this.selected === "meal_time") {
        const timeA = new Date(a.meal_time);
        const timeB = new Date(b.meal_time);
        if (!isNaN(timeA) && !isNaN(timeB)) {
          return timeA - timeB;
        }
        // Handle cases where one or both meal_time values are not valid dates
        // You can adjust the handling according to your requirements
      }
      // Handle cases where this.selected is not recognized
      return 0;
    });
  },
},

    methods: {
        chooseStatus(status) {
            this.orders = status;
        },
        selectedDiv(status) {
            this.selected = status;
        },
        sort(key, ascending) {
            this.selected = key;
            if (!ascending) {
                this.orders = this.orders.map((order) => order.reverse());
            }
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
