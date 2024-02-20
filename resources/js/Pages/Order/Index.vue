<script setup>
import { Head, Link } from "@inertiajs/vue3";
import TableHeadVue from "../../../Components/Table/TableHead.vue";
import TableRow from "./TableRow.vue";
</script>

<template>
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-snow dark:bg-oynx selection:bg-red-500 selection:text-white"
    >
        <div class="container relative mx-auto overflow-hidden">
            <div
                class="m-auto flex flex-col  justify-center h-full px-6 lg:pb-20 w-full"
            >
                <div class="py-5 lg:pb-12">
                    <h1
                        class="font-semibold text-2xl text-center lg:text-4xl text-oynx dark:text-snow">
                        Continue to create your menu
                    </h1>
                </div>
                <div class="lg:w-full">
                    <div class="flex flex-col w-full">
                        <div class="sm:-mx-6 lg:-mx-8">
                            <div
                                class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                <div class="overflow-x-auto">
                                    <table
                                        class=" min-w-full text-left text-sm font-light relative">
                                        <thead
                                            class="align-bottom shadow-sm translate-x-0 sticky top-1 ">
                                            <tr>
                                                <TableHeadVue>
                                                    <template #title>
                                                        Title
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
                                                        Price
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
                                                        Quick Order
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <tr v-for="meal in menu"
                                                :key="meal.id"
                                                class="animate-fade-in border-b py-4" >

                                                <!-- <TableRow :meal="meal">
                                                </TableRow> -->
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
        menu: Object,
    },
  
};
</script>

<style scoped>
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
