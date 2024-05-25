<template>
    <div class="flex justify-center items-center min-h-screen">
        <div
            class="relative flex w-[23rem] flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md"
        >
            <div
                class="relative mx-4 -mt-10 h-20 flex justify-center items-center overflow-hidden rounded-xl bg-blue-gray-500 bg-clip-border shadow-lg shadow-blue-gray-500/40 bg-gradient-to-r from-polynesian to-lighred"
            >
                <h5
                    class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased text-snow"
                >
                    Order ID: {{ order.id }}
                </h5>
            </div>
            <div class="p-6">
                <div class="flex justify-between">
                    <h5
                        class="mb-2 block font-sans text-lg font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased"
                    >
                        Meal:
                    </h5>
                    <h5
                        class="mb-2 block font-sans text-lg font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased"
                    >
                        {{ order.meal.name }}
                    </h5>
                </div>
                <div class="flex justify-between">
                    <h5
                        class="mb-2 block font-sans text-lg font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased"
                    >
                        Cook:
                    </h5>
                    <h5
                        class="mb-2 block font-sans text-lg font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased"
                    >
                        {{ getCook(order.meal.id) }}
                    </h5>
                </div>
                <div class="flex justify-between">
                    <h5
                        class="mb-2 block font-sans text-lg font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased"
                    >
                        Costomer:
                    </h5>
                    <h5
                        class="mb-2 block font-sans text-lg font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased"
                    >
                        {{  order.user.name }}
                    </h5>
                </div>
                <p
                    class="block font-sans text-base font-light leading-relaxed text-inherit antialiased"
                ></p>

                <div class="flex flex-col">
                    <p
                        class="block font-semibold font-sans text-base leading-relaxed text-inherit antialiased"
                    >
                        Payment Attempt
                    </p>
                    <div class="">
                        <div class="flex justify-between">
                            <p
                                class="block font-sans text-sm leading-relaxed text-inherit antialiased"
                            >
                                Payment ID
                            </p>
                            <p
                                class="block font-sans text-sm leading-relaxed text-inherit antialiased"
                            >
                                Payment Status
                            </p>
                        </div>
                        <div class="flex justify-between">
                            <p
                                class="block font-sans text-sm font-light leading-relaxed text-inherit antialiased"
                            >
                                {{ order.order.session_id }}
                            </p>
                            <p
                                class="block font-sans text-sm font-light leading-relaxed text-inherit antialiased"
                            >
                                {{ order.order.status }}
                            </p>
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
    },
    data() {
        return {
            meal_photo: "",
            user_name: "",
        };
    },
    methods: {
        isToday(dateString) {
            const date = new Date(dateString);
            const today = new Date();
            return date.toDateString() < today.toDateString();
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
