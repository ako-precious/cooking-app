<script setup>
import { Head, Link } from "@inertiajs/vue3";
import TableHeadVue from "@/Components/Table/TableHead.vue";
import TableRow from "./TableRow.vue";
import HeaderVue from "../Header.vue";
</script>

<template>
 <Head>Orders</Head>

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-snow dark:bg-oynx selection:bg-red-500 selection:text-white"
    >
        <div class="container relative mx-auto">
           <div >
               <HeaderVue> </HeaderVue>  
           </div>
            <div
                class="m-auto flex flex-col justify-center h-full px-6 lg:pb-20 w-full"
            >
                <div class="col-span-1 w-full max-w-full py-6">
                    <div
                        class="sticky flex flex-col min-w-0 break-words w-full top-1/100  dark:bg-slate-850 rounded-2xl bg-clip-border"
                    >
                        <ul
                            class="flex justify-around p-4 mb-0 list-none rounded-xl"
                        >
                            <li class="pt-2">
                                <a
                                    href="#profile"
                                    class="  flex items-center px-4 py-2 transition-colors ease-in-out rounded-xl group text-slate-500 hover:bg-gray-300"
                                >
                                <span
                                class="text-sm leading-normal dark:group-hover:text-oynx dark:text-snow"
                                >All</span>
                                <i
                                    class="ml-2 ni ni-books text-oynx opacity-60 dark:text-snow dark:group-hover:text-oynx"
                                >2</i>
                                </a>
                                <button>
  <span>BUTTON</span>
</button>

                            </li>
                            <li class="pt-2">
                                <a
                                    href="#profile"
                                    class="shadow-reverse flex items-center px-4 py-2 transition-colors ease-in-out rounded-xl group text-slate-500 hover:bg-gray-300"
                                >
                                <span
                                class="text-sm leading-normal dark:group-hover:text-oynx dark:text-snow"
                                >Pending</span>
                                <i
                                    class="ml-2 ni ni-books text-oynx opacity-60 dark:text-snow dark:group-hover:text-oynx"
                                >2</i>
                                </a>
                            </li>
                            <li class="pt-2">
                                <a
                                    href="#profile"
                                    class="shadow-reverse flex items-center px-4 py-2 transition-colors ease-in-out rounded-lg group text-slate-500 hover:bg-gray-300"
                                >
                                <span
                                class="text-sm leading-normal dark:group-hover:text-oynx dark:text-snow"
                                >Accepted</span>
                                <i
                                    class="ml-2 ni ni-books text-oynx opacity-60 dark:text-snow dark:group-hover:text-oynx"
                                >2</i>
                                </a>
                            </li>
                            <li class="pt-2">
                                <a
                                    href="#profile"
                                    class="shadow-reverse flex items-center px-4 py-2 transition-colors ease-in-out rounded-lg group text-slate-500 hover:bg-gray-300"
                                >
                                <span
                                class="text-sm leading-normal dark:group-hover:text-oynx dark:text-snow"
                                >Rejected</span>
                                <i
                                    class="ml-2 ni ni-books text-oynx opacity-60 dark:text-snow dark:group-hover:text-oynx"
                                >2</i>
                                </a>
                            </li>
                            <li class="pt-2">
                                <a
                                    href="#profile"
                                    class="shadow-reverse flex items-center px-4 py-2 transition-colors ease-in-out rounded-lg group text-slate-500 hover:bg-gray-300"
                                >
                                <span
                                class="text-sm leading-normal dark:group-hover:text-oynx dark:text-snow"
                                >Processed</span>
                                <i
                                    class="ml-2 ni ni-books text-oynx opacity-60 dark:text-snow dark:group-hover:text-oynx"
                                >2</i>
                                </a>
                            </li>
                            <li class="pt-2">
                                <a
                                    href="#profile"
                                    class="shadow-reverse flex items-center px-4 py-2 transition-colors ease-in-out rounded-lg group text-slate-500 hover:bg-gray-300"
                                >
                                <span
                                class="text-sm leading-normal dark:group-hover:text-oynx dark:text-snow"
                                >Ready</span>
                                <i
                                    class="ml-2 ni ni-books text-oynx opacity-60 dark:text-snow dark:group-hover:text-oynx"
                                >2</i>
                                </a>
                            </li>
                            <li class="pt-2">
                                <a
                                    href="#profile"
                                    class="shadow-reverse flex items-center px-4 py-2 transition-colors ease-in-out rounded-lg group text-slate-500 hover:bg-gray-300"
                                >
                                <span
                                class="text-sm leading-normal dark:group-hover:text-oynx dark:text-snow"
                                >delivered</span>
                                <i
                                    class="ml-2 ni ni-books text-oynx opacity-60 dark:text-snow dark:group-hover:text-oynx"
                                >2</i>
                                </a>
                            </li>
                            <li class="pt-2">
                                <a
                                    href="#profile"
                                    class="shadow-reverse flex items-center px-4 py-2 transition-colors ease-in-out rounded-lg group text-slate-500 hover:bg-gray-300"
                                >
                                <span
                                class="text-sm leading-normal dark:group-hover:text-oynx dark:text-snow"
                                >confirmed</span>
                                <i
                                    class="ml-2 ni ni-books text-oynx opacity-60 dark:text-snow dark:group-hover:text-oynx"
                                >2</i>
                                </a>
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
                                                        <font-awesome-icon
                                                            class="text-xs"
                                                            icon="caret-up"
                                                        />
                                                        <font-awesome-icon
                                                            class="text-xs"
                                                            icon="caret-down"
                                                        />
                                                    </template>
                                                </TableHeadVue>
                                                <TableHeadVue>
                                                    <template #title>
                                                        Customer's NAme
                                                    </template>
                                                    <template #symbols>
                                                        <font-awesome-icon
                                                            class="text-xs"
                                                            icon="caret-up"
                                                        />
                                                        <font-awesome-icon
                                                            class="text-xs"
                                                            icon="caret-down"
                                                        />
                                                    </template>
                                                </TableHeadVue>
                                                <TableHeadVue>
                                                    <template #title>
                                                        Meal Time
                                                    </template>
                                                    <template #symbols>
                                                        <font-awesome-icon
                                                            class="text-xs"
                                                            icon="caret-up"
                                                        />
                                                        <font-awesome-icon
                                                            class="text-xs"
                                                            icon="caret-down"
                                                        />
                                                    </template>
                                                </TableHeadVue>
                                                <TableHeadVue>
                                                    <template #title>
                                                        Meal Delivery Date
                                                    </template>
                                                    <template #symbols>
                                                        <font-awesome-icon
                                                            class="text-xs"
                                                            icon="caret-up"
                                                        />
                                                        <font-awesome-icon
                                                            class="text-xs"
                                                            icon="caret-down"
                                                        />
                                                    </template>
                                                </TableHeadVue>
                                                <TableHeadVue>
                                                    <template #title>
                                                        status
                                                    </template>
                                                    <template #symbols>
                                                        <font-awesome-icon
                                                            class="text-xs"
                                                            icon="caret-up"
                                                        />
                                                        <font-awesome-icon
                                                            class="text-xs"
                                                            icon="caret-down"
                                                        />
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
        orders: Object,
    },
    mounted() {
        // const allMealSchedules = this.orders.flat();
        // // Extract the id values from all objects
        // const allIds = allMealSchedules.map((mealSchedule) => mealSchedule.meal.name);
        // // Now allIds contains the id values of all objects
        // console.log(allIds);
        // console.log(this.orders);
    },
};
</script>

<style scoped>
button {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 5px;
  background: #183153;
  font-family: "Montserrat", sans-serif;
  box-shadow: 0px 6px 24px 0px rgba(0, 0, 0, 0.2);
  overflow: hidden;
  cursor: pointer;
  border: none;
}

button:after {
  content: " ";
  width: 0%;
  height: 100%;
  background: ;
  position: absolute;
  transition: all 0.4s ease-in-out;
  right: 0;
}

button:hover::after {
  right: auto;
  left: 0;
  width: 100%;
}

button span {
  text-align: center;
  text-decoration: none;
  width: 100%;
  padding: 18px 25px;
  color: #fff;
  font-size: 1.125em;
  font-weight: 700;
  letter-spacing: 0.3em;
  z-index: 20;
  transition: all 0.3s ease-in-out;
}

button:hover span {
  color: #183153;
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
