<script setup>
import { Head, Link } from "@inertiajs/vue3";

import BecomeCook from "./BecomeCook.vue";
</script>

<template>
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-snow dark:bg-oynx selection:bg-red-500 selection:text-white"
    >
        <div class="container relative mx-auto overflow-hidden">
            <div
                class="m-auto flex flex-col max-w-[1000px] justify-center h-full px-6 lg:pb-20 w-full"
            >
                <div class="py-5 lg:pb-12">
                    <h1
                        class="font-semibold text-2xl text-center lg:text-4xl text-oynx dark:text-snow"
                    >
                        Continue to create your menu
                    </h1>
                </div>
                <div class="lg:w-full">
                    <div class="flex flex-col w-full">
                        <div class="grid grid-cols-1 gap-5 lg:gap-8 lg:px-10">
                            <div
                                v-for="(item, index) in pending"
                                :key="index"
                                class="col-span-1 w-full max-w-full"
                            >
                                <div
                                    class="flex min-w-0 break-words w-full items-center justify-between shadow-reverse group rounded-2xl bg-clip-border cursor-pointer"
                                >
                                    <Link class="w4"
                                        :href="`/become-a-cook/${item.id}/overview`"
                                    >
                                        <div
                                            class="relative flex items-center justify-between w-full p-4 mb-0 list-none rounded-xl"
                                        >
                                            <font-awesome-icon
                                                class="lg:text-2xl leading-normal"
                                                icon="bowl-rice"
                                            />
                                            <div class="w-full">
                                                <p
                                                    class="font-semibold px-4 py-2 transition-colors ease-in-out rounded-lg group-action-text"
                                                >
                                                    <span
                                                        v-if="item.name"
                                                        class="lg:text-xl leading-normal"
                                                    >
                                                        {{ item.name }}</span
                                                    >
                                                    <span
                                                        v-else
                                                        class="lg:text-xl leading-normal"
                                                        >Food created on{{FormattedDate(item.created_at)}}
                                                    </span>
                                                </p>
                                            </div>
                                            <div></div>
                                        </div>
                                    </Link>
                                    <p
                                        class="bottom-1  w-12 top-1 right-1 bg-snow/20 cursor-pointer p-2"
                                        @click="removePending(item.id)"
                                    >
                                        <font-awesome-icon
                                            icon="fa-solid fa-close"
                                            class="text-lighred text-"
                                        />
                                    </p>
                                    </div>
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
    props: {
        pending: Object,
    },
    created() {
        this.FormattedDate();
    },
    methods: {
        removePending(id) {
            // Assuming you have an endpoint to delete the photo from the database
            axios
                .delete(`/meal/${id}`)
                .then((response) => {
                    console.log(response);
                    // Handle success if needed
                })
                .catch((error) => {
                    console.error("Error deleting meal photo:", error);
                });
        },

        FormattedDate(timestamp) {
            const date = new Date(timestamp);
            const formattedDate = `${date.getFullYear()}-${(date.getMonth() + 1)
                .toString()
                .padStart(2, "0")}-${date
                .getDate()
                .toString()
                .padStart(2, "0")} at ${date.getHours()}:${date
                .getMinutes()
                .toString()
                .padStart(2, "0")}`;
            return formattedDate;
        },
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
    animation: fade-in 0.7s ease-in;
}
</style>
