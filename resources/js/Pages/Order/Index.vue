<script setup>
import { Head, Link } from "@inertiajs/vue3";
import TableHeadVue from "@/Components/Table/TableHead.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import TableRow from "./TableRow.vue";
import Pagination from "@/Components/Pagination.vue";
import SocialLogin from "@/Pages/Auth/SocialLogin.vue";
import CaretDown from "@/Components/CaretDown.vue";
import CaretUp from "@/Components/CaretUp.vue";
import Filters from "./Filter.vue";
</script>

<template>
    <AppLayout title="Meal Schedule">
        <div
            class="relative sm:flex sm:justify-center sm:items-center bg-center selection:bg-lighred selection:text-white"
        >
            <div
                class="container py-6 relative mx-auto text-oynx dark:text-snow"
            >
                <div class="py-3">
                    <div
                        class="sticky flex flex-col min-w-full break-words w-full top-1/100 dark:bg-oynx rounded-2xl bg-clip-border"
                    >
                        <div class="py-5 x-4">
                            <h1
                                class="font-semibold text-3xl lg:text-5xl text-oynx dark:text-snow"
                            >
                                Great to see you,
                                <span class="capitalize">
                                    {{ firstWord }}
                                    <!-- {{ firstWord($page.props.auth.user.name ) }} -->
                                </span>
                            </h1>
                        </div>
                        <div class="w-full flex justify-end">
                            
                        </div>
                        <div class="my-6 w-24 relative" @click="openModal()">
                            <SocialLogin class="group">
                                <template #logo>
                                    <font-awesome-icon
                                        icon="filter"
                                        class="text-xl px-2 group-hover:-ml-3 group-action-text"
                                    />
                                </template>
                                <template #name> Filters </template>
                            </SocialLogin>
                        </div>

                        <div
                            class="m-auto flex flex-col justify-center h-full lg:pb-10 w-full py-6 shadow-reverse rounded-lg my-2 z-0"
                        >
                            <div class="lg:w-full">
                                <div class="flex flex-col w-full">
                                    <div class=" ">
                                        <div class="w-full py-2">
                                            <div
                                                class="overflow-x-scroll disable-scrollbars"
                                            >
                                                <table
                                                    class="w-full text-left text-sm font-light relative"
                                                >
                                                    <thead
                                                        class="align-bottom shadow-sm translate-x-0 sticky top-0 z-10 border-b"
                                                    >
                                                        <tr>
                                                            <TableHeadVue>
                                                                <template
                                                                    #title
                                                                >
                                                                    #Order ID
                                                                </template>
                                                                <template
                                                                    #symbols
                                                                >
                                                                    <CaretUp
                                                                        @click="
                                                                            Sorting(
                                                                                'asc',
                                                                                'name'
                                                                            )
                                                                        "
                                                                    />
                                                                    <CaretDown
                                                                        @click="
                                                                            Sorting(
                                                                                'desc',
                                                                                'name'
                                                                            )
                                                                        "
                                                                    />
                                                                </template>
                                                            </TableHeadVue>
                                                            <TableHeadVue>
                                                                <template
                                                                    #title
                                                                >
                                                                    Meal Title
                                                                </template>
                                                                <template
                                                                    #symbols
                                                                >
                                                                    <CaretUp
                                                                        @click="
                                                                            Sorting(
                                                                                'asc',
                                                                                'name'
                                                                            )
                                                                        "
                                                                    />
                                                                    <CaretDown
                                                                        @click="
                                                                            Sorting(
                                                                                'desc',
                                                                                'name'
                                                                            )
                                                                        "
                                                                    />
                                                                </template>
                                                            </TableHeadVue>

                                                            <TableHeadVue>
                                                                <template
                                                                    #title
                                                                >
                                                                    Meal Time
                                                                </template>
                                                                <template
                                                                    #symbols
                                                                >
                                                                    <CaretUp
                                                                        @click="
                                                                            Sorting(
                                                                                'asc',
                                                                                'meal_time'
                                                                            )
                                                                        "
                                                                    />
                                                                    <CaretDown
                                                                        @click="
                                                                            Sorting(
                                                                                'desc',
                                                                                'meal_time'
                                                                            )
                                                                        "
                                                                    />
                                                                </template>
                                                            </TableHeadVue>
                                                            <TableHeadVue>
                                                                <template
                                                                    #title
                                                                >
                                                                    Meal
                                                                    Delivery
                                                                    Date
                                                                </template>
                                                                <template
                                                                    #symbols
                                                                >
                                                                    <CaretUp
                                                                        @click="
                                                                            Sorting(
                                                                                'asc',
                                                                                'start_date'
                                                                            )
                                                                        "
                                                                    />
                                                                    <CaretDown
                                                                        @click="
                                                                            Sorting(
                                                                                'desc',
                                                                                'start_date'
                                                                            )
                                                                        "
                                                                    />
                                                                </template>
                                                            </TableHeadVue>
                                                            <TableHeadVue>
                                                                <template
                                                                    #title
                                                                >
                                                                    Date Ordered
                                                                </template>
                                                                <template
                                                                    #symbols
                                                                >
                                                                    <CaretUp
                                                                        @click="
                                                                            Sorting(
                                                                                'asc',
                                                                                'start_date'
                                                                            )
                                                                        "
                                                                    />
                                                                    <CaretDown
                                                                        @click="
                                                                            Sorting(
                                                                                'desc',
                                                                                'start_date'
                                                                            )
                                                                        "
                                                                    />
                                                                </template>
                                                            </TableHeadVue>
                                                            <TableHeadVue>
                                                                <template
                                                                    #title
                                                                >
                                                                    status
                                                                </template>
                                                                <template
                                                                    #symbols
                                                                >
                                                                    <CaretUp
                                                                        @click="
                                                                            Sorting(
                                                                                'asc',
                                                                                'status'
                                                                            )
                                                                        "
                                                                    />
                                                                    <CaretDown
                                                                        @click="
                                                                            Sorting(
                                                                                'desc',
                                                                                'status'
                                                                            )
                                                                        "
                                                                    />
                                                                </template>
                                                            </TableHeadVue>
                                                            <TableHeadVue>
                                                                <template
                                                                    #title
                                                                >
                                                                </template>
                                                                <template
                                                                    #symbols
                                                                >
                                                                </template>
                                                            </TableHeadVue>
                                                            <TableHeadVue>
                                                                <template
                                                                    #title
                                                                >
                                                                </template>
                                                                <template
                                                                    #symbols
                                                                >
                                                                </template>
                                                            </TableHeadVue>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr
                                                            v-if="
                                                                orders.data
                                                                    .length > 0
                                                            "
                                                            v-for="order in orders.data"
                                                            :key="order.id"
                                                            class="animate-fade-in border-b py-4 capitalize text-oynx active:text-persian hover:text-polynesian dark:text-snow dark:active:text-persian dark:hover:text-lighred"
                                                        >
                                                            <TableRow
                                                                :order="order"
                                                            >
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
                                                                    You have
                                                                    nothing here
                                                                    yet. click
                                                                    <Link
                                                                        :href="`/`"
                                                                        class="font-semibold"
                                                                        >here
                                                                    </Link>
                                                                    to add
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <!-- {{ orders.data }} -->
                                                </table>
                                                <div
                                                    v-if="orders.data.length"
                                                    class="w-full flex justify-center mt-6"
                                                >
                                                    <Pagination
                                                        :links="orders.links"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>

                        <div
                            class="modal disable-scrollbars overflow-y-auto overflow-x-hidden fixed top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 z-[100] flex justify-center items-center backdrop-blur-md w-full h-full"
                            v-show="newEventModalVisible"
                        >
                            <div
                                class="relative p-4 w-full max-w-xl max-h-full transition-all duration-300 ease-in delay-200"
                            >
                                <div class="relative shadow-reverse rounded-lg">
                                    <button
                                        @click="closeModal"
                                        type="button"
                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="popup-modal"
                                    >
                                        <font-awesome-icon
                                            icon="fa-solid fa-close"
                                            class="text-lighred text-lg"
                                        />
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="">
                                        <div class="p-6 mt-1">
                                            <Filters
                                                :filters="filters"
                                                @filter-update="updateOrders"
                                                @close-modal="closeModal"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import axios from "axios";

export default {
    props: {
        meal_orders: Object,
        filters: Object,
    },

    data() {
        return {
            orders: this.meal_orders,
            selected: "meal_orders",
            newEventModalVisible: false,
        };
    },
    computed: {
        firstWord() {
            // Check if $page.props.auth.user.name is defined
            if (
                this.$page.props.auth &&
                this.$page.props.auth.user &&
                this.$page.props.auth.user.name
            ) {
                // Split the name string into an array of words
                const words = this.$page.props.auth.user.name.split(" ");

                // Return the first word
                return words[0];
            } else {
                return ""; // Return an empty string if $page.props.auth.user.name is undefined
            }
        },
    },

    methods: {
        updateOrders(newOrders) {
            this.orders = newOrders;
            // console.log(this.orders);
        },

        chooseStatus(status) {
            this.orders = status;
        },
        Sorting(sort, name) {
            axios
                .get("/api/sort", {
                    params: {
                        ...this.filters,
                        sort: sort,
                        column: name,
                        user: this.$page.props.auth.user,
                    },
                })
                .then((resp) => {
                    // console.log(resp.data.meal_orders);
                    this.orders = resp.data.meal_orders;
                })
                .catch((err) => {
                    console.error(err);
                });
        },

        openModal() {
            this.newEventModalVisible = true;
        },
        closeModal() {
            this.newEventModalVisible = false;
        },
    },
};
</script>
