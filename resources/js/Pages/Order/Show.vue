<script setup>
import Navbar from "@/Pages/Cook/Navbar.vue";

import TextInput from "@/Components/TextInput.vue";
</script>
<template>
    <div>
        <Navbar></Navbar>
        <div class="flex justify-center items-center min-h-screen">
            <div
                class="relative flex w-[23rem] flex-col rounded-xl shadow-small text-oynx dark:text-snow"
            >
                <div
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
                <div
                    class="h-[23rem] disable-scrollbars overflow-y-scroll relative"
                >
                    <div
                        class="p-6 transition-all duration-200 delay-100"
                        :class="{
                            ' opacity-0 -right-100 hidden': selected !== 'info',
                        }"
                    >
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
                        <div class="flex my-1 flex-col">
                            <p
                                class="block font-semibold font-sans text-base leading-relaxed text-inherit antialiased"
                            >
                                info Attempt
                            </p>
                            <div class="">
                                <div class="flex justify-between">
                                    <p
                                        class="block font-sans leading-relaxed text-inherit antialiased"
                                    >
                                        info ID
                                    </p>
                                    <p
                                        class="block font-sans leading-relaxed text-inherit antialiased"
                                    >
                                        Status
                                    </p>
                                </div>
                                <div
                                    v-for="info in infos"
                                    class="flex justify-between mb-1"
                                >
                                    <p
                                        class="block font-sans text-sm font-light leading-relaxed text-inherit antialiased"
                                    >
                                        {{ info.session_id }}
                                    </p>
                                    <p
                                        class="block font-sans text-sm font-light leading-relaxed text-inherit antialiased"
                                    >
                                        {{ info.status }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        :class="{
                            'opacity-0 -right-100 hidden':
                                selected !== 'messages',
                        }"
                        class="flex py-6 flex-col flex-auto flex-shrink-0 rounded-2xl h-full"
                    >
                        <div
                            class="flex flex-col h-full overflow-x-auto simple"
                        >
                            <div class="flex flex-col h-full">
                                <div class="grid grid-cols-12 gap-y-2">
                                    

                                    <div
                                        class="col-start-4 col-end-13 p-3 rounded-lg"
                                    >
                                        <div
                                            class="flex items-center justify-start flex-row-reverse"
                                        >
                                            <div
                                                class="relative mr-3 text-sm bg-persian py-2 px-4 shadow rounded-t-[2rem] rounded-l-[2rem]"
                                            >
                                                <div>
                                                    Lorem ipsum dolor sit, amet
                                                    consectetur adipisicing. ?
                                                </div>
                                                <div
                                                    class="absolute text-xs bottom-0 right-0 -mb-5 mr-2 text-gray-500"
                                                >
                                                    Seen
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="col-start-1 col-end-9 p-3 rounded-lg"
                                    >
                                        <div class="flex flex-row items-center">
                                            <div
                                                class="relative ml-3 text-sm text-oynx dark:text-snow bg-snow/40 dark:bg-oynx/40 py-2 px-4 shadow rounded-t-[2rem] rounded-r-[2rem]"
                                            >
                                                <div>
                                                    Lorem ipsum dolor sit amet
                                                    consectetur adipisicing
                                                    elit. Perspiciatis, in.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex flex-row items-center h-16 rounded-b-xl bg-transparent w-full p-3"
                        >
                            <div class="flex-grow ml-4">
                                <div class="relative w-full">
                                    <!-- <input
                                        type="text"
                                        class="flex w-full border rounded-xl focus:outline-none focus:border-indigo-300 pl-4 h-10"
                                    /> -->
                                    <TextInput class="w-full relative" />
                                </div>
                            </div>
                            <div class="ml-4">
                                <button
                                    class="flex items-center justify-center rounded-xl text-white flex-shrink-0"
                                >
                                    <span class="">
                                        <svg
                                            class="w-6 h-6 transform rotate-90 text-polynesian dark:text-lighred hover:rotate-45 hover:text-persian"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                                            ></path>
                                        </svg>
                                    </span>
                                </button>
                            </div>
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
        infos: Object,
    },
    data() {
        return {
            meal_photo: "",
            user_name: "",
            selected: "info",
        };
    },
    methods: {
        selectedDiv(status) {
            this.selected = status;
        },
        isToday(dateString) {
            const date = new Date(dateString);
            const today = new Date();
            return date.toDateString() < today.toDateString();
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

<style scoped>
.simple::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}
.simple::-webkit-scrollbar-track {
    border-radius: 10px;
    background: rgba(0, 0, 0, 0.1);
}
.simple::-webkit-scrollbar-thumb {
    border-radius: 10px;
    background: rgba(0, 0, 0, 0.2);
}
.simple::-webkit-scrollbar-thumb:hover {
    background: rgba(0, 0, 0, 0.4);
}
.simple::-webkit-scrollbar-thumb:active {
    background: rgba(0, 0, 0, 0.8);
}
</style>
