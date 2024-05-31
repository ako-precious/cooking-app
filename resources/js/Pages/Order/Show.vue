<script setup>
import Navbar from "@/Pages/Cook/Navbar.vue";
import ChartCard from './ChartCard.vue'
import { Head, Link } from "@inertiajs/vue3";
import ChangeStatus from "@/Pages/Cook/Order/ChangeStatus.vue";
</script>
<template>
    <Head title="Order Info" />
    <div>
        <Navbar></Navbar>
        <div class="flex justify-center items-center min-h-screen">
            <div
                class="relative flex w-[23rem] flex-col rounded-xl shadow-reverse text-oynx dark:text-snow"
            >
                <div v-if="order.status === 'processed' || order.status === 'ready' || order.status === 'in transit' || order.status === 'delivered'"
                    class="relative mx-4 -mt-10 h-20 flex justify-around items-center overflow-hidden rounded-xl bg-blue-gray-500 bg-clip-border shadow-lg shadow-blue-gray-500/40 bg-gradient-to-r"
                >
                    <h5
                        @click="selectedDiv('info')"
                        :class="{
                            ' text-persian': selected === 'info',
                        }"
                        class="mb-2 capitalize block font-sans font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased cursor-pointer"
                    >
                        Order Info
                    </h5>
                    <h5
                        @click="selectedDiv('messages')"
                        :class="{
                            ' text-persian': selected === 'messages',
                        }"
                        class="mb-2 capitalize block font-sans font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased cursor-pointer"
                    >
                        Messages
                    </h5>
                </div>
                <div v-else
                    class="relative mx-4 -mt-10 h-20 flex justify-center items-center overflow-hidden rounded-xl bg-blue-gray-500 bg-clip-border shadow-lg shadow-blue-gray-500/40 bg-gradient-to-r"
                >
                    <h5
                        
                        class="mb-2 capitalize block text-xl font-sans font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased cursor-pointer"
                    >
                        Order Info
                    </h5>
                </div>
                <div
                    class="relative"
                >
                    <div
                        class="p-6 transition-all duration-200 delay-100"
                        :class="{
                            ' opacity-0 -right-100 hidden': selected !== 'info',
                        }"
                    >
                    <div class="h-[23rem] disable-scrollbars overflow-y-scroll">

                        <div class="flex justify-between">
                            <h5
                                class="mb-2 capitalize block font-sans text-base leading-snug tracking-normal text-blue-gray-900 antialiased"
                            >
                                Order ID:
                            </h5>
                            <h5
                                class="mb-2 capitalize block font-sans text-base font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased"
                            >
                                {{ order.id }}
                            </h5>
                        </div>
                        <div class="flex justify-between">
                            <h5
                                class="mb-2 capitalize block font-sans text-base leading-snug tracking-normal text-blue-gray-900 antialiased"
                            >
                                Meal:
                            </h5>
                            <h5
                                class="mb-2 capitalize block font-sans text-base font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased"
                            >
                                {{ order.meal.name }}
                            </h5>
                        </div>
                        <div class="flex justify-between">
                            <h5
                                class="mb-2 capitalize block font-sans text-base leading-snug tracking-normal text-blue-gray-900 antialiased"
                            >
                                Cook:
                            </h5>
                            <h5
                                class="mb-2 capitalize block font-sans text-base font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased"
                            >
                                {{ getCook(order.meal.id) }}
                            </h5>
                        </div>
                        <div class="flex justify-between">
                            <h5
                                class="mb-2 capitalize block font-sans text-base leading-snug tracking-normal text-blue-gray-900 antialiased"
                            >
                                Customer:
                            </h5>
                            <h5
                                class="mb-2 capitalize block font-sans text-base font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased"
                            >
                                {{ order.user.name }}
                            </h5>
                        </div>
                        <div class="flex justify-between">
                            <h5
                                class="mb-2 capitalize block font-sans text-base leading-snug tracking-normal text-blue-gray-900 antialiased"
                            >
                                Delivery Date:
                            </h5>
                            <h5
                                class="mb-2 capitalize block font-sans text-base font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased"
                            >
                                {{ order.start_date }}
                            </h5>
                        </div>
                        <div class="flex justify-between">
                            <h5
                                class="mb-2 capitalize block font-sans text-base leading-snug tracking-normal text-blue-gray-900 antialiased"
                            >
                                Meal Time:
                            </h5>
                            <h5
                                class="mb-2 capitalize block font-sans text-base font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased"
                            >
                                {{ order.meal_time }}
                            </h5>
                        </div>
                        <div class="flex justify-between">
                            <h5
                                class="mb-2 capitalize block font-sans text-base leading-snug tracking-normal text-blue-gray-900 antialiased"
                            >
                                Date Ordered:
                            </h5>
                            <h5
                                class="mb-2 capitalize block font-sans text-base font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased"
                            >
                                {{ formatDate(order.created_at) }}
                            </h5>
                        </div>
                        <div class="flex justify-between">
                            <h5
                                class="mb-2 capitalize block font-sans text-base leading-snug tracking-normal text-blue-gray-900 antialiased"
                            >
                                Meal Status:
                            </h5>
                            <h5
                                class="mb-2 capitalize block font-sans text-base font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased"
                            >
                                {{ order.status }}
                            </h5>
                        </div>

                        <div class="flex justify-between items-center">
                            <h5
                                class="mb-2 capitalize block font-sans text-base leading-snug tracking-normal text-blue-gray-900 antialiased"
                            >
                                Change Status:
                            </h5>
                            <div v-if="order.meal.id == $page.props.auth.user.id">
                            </div>
                            <ChangeStatus :order="order" @status-update="updateStatus"></ChangeStatus>
                        </div>
                        <div class="flex my-1 flex-col">
                            <p
                                class="block font-semibold font-sans text-base leading-relaxed text-inherit antialiased"
                            >
                                Payment Attempt
                            </p>
                            <div class="">
                                <div class="flex justify-between">
                                    <p
                                        class="block font-sans leading-relaxed text-inherit antialiased"
                                    >
                                        Payment ID
                                    </p>
                                    <p
                                        class="block font-sans leading-relaxed text-inherit antialiased"
                                    >
                                        Status
                                    </p>
                                </div>
                                <div
                                    v-for="payment in payments"
                                    class="flex justify-between mb-1"
                                >
                                    <p
                                        class="block font-sans text-sm font-light leading-relaxed text-inherit antialiased"
                                    >
                                        {{ payment.session_id }}
                                    </p>
                                    <p
                                        class="block font-sans text-sm font-light leading-relaxed text-inherit antialiased"
                                    >
                                        {{ payment.status }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div
                        :class="{
                            'opacity-0 -right-100 hidden':
                                selected !== 'messages',
                        }">
                        <div>

                            <ChartCard :order="order" ></ChartCard>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    inheritAttrs: false,
    props: {
        order: Object,
        payments: Object,
    },
    data() {
        return {
            meal_photo: "",
            user_name: "",
            selected: "info",
        };
    },
    methods: {
        updateStatus(newOrders) {
            this.meal.status =  newOrders;
        },
        selectedDiv(status) {
            this.selected = status;
        },
        
        formatDate(value) {
            if (value) {
                return new Date(value).toISOString().substring(0, 10);
            }
            return "";
        },
        FormattedDate(timestamp) {
            const date = new Date(timestamp);
            const formattedDate = `${date.getFullYear()}-${(date.getMonth() + 1)
                .toString()
                .padStart(2, "0")}-${date
                .getDate()
                .toString()
                .padStart(2, "0")}`;
            return formattedDate;
        },
        truncatedIng(description) {
            // Check if description exists and has more than 30 characters
            if (description && description.length > 1) {
                // Truncate description to 30 characters and add ellipsis
                return description.slice(0, 1) + "...";
            } else {
                // Return full description if it's less than or equal to 30 characters
                return description;
            }
        },
        getCook(id) {
            axios
                .get("/meal/" + id)
                .then((response) => {
                    // console.log("Data sent successfully:", response.data.meal);
                    this.user_name = response.data.meal.user.name;
                })
                .catch((error) => {
                    console.error("Error sending data:", error);
                });
            return this.user_name;
        },
    },
};
</script>

