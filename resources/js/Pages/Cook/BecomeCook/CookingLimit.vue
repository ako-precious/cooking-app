<script setup>
import { Head, Link } from "@inertiajs/vue3";

import BecomeCook from "./BecomeCook.vue";
import TextInput from "@/Components/TextInput.vue";
</script>

<template>
    <BecomeCook>
        <template #info>
            <div
                class="container relative mx-auto overflow-hidden w-screen"
            >
                <div
                    class="m-auto flex flex-col  lg:flex-row items-center h-full lg:p-8"
                >
                    <div class="lg:w-1/2 py-10 sm:py-5 lg:px-5">
                        <h1
                            class="font-semibold text-3xl lg:text-4xl tracking-wide text-oynx dark:text-snow"
                        >
                            How many people can you cook for
                        </h1>
                        <h1 class="pt-6 text-lg text-oynx dark:text-snow">
                            Your commitment to delivering the best experience
                            for each person is admirable. To help you prioritize
                            quality, could you share your preferred number for
                            preparing an exceptional meal at a time?
                        </h1>
                    </div>
                    <div class="w-full lg:w-1/2">
                        <div class="flex flex-col w-full">
                            <div class="flex lg:p-5">
                                <div
                                    class="w-full lg:w-2/3 p-3 lg:p-10 lg:ml-8"
                                >
                                    <input
                                        placeholder="Limit"
                                        class="-shadow-snow-sm w-full dark:-shadow-oynx-sm focus:shadow-snow-inner focus:dark:shadow-oynx-inner bg-transparent border-none sm:w-[15rem] md:w-[20rem] lg:w-[25rem] 2xl:max-w-2xl text-oynx dark:text-white rounded-full py-3 px-5 outline-none dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred transition-all ease-in duration-250 delay-75"
                                        v-model="cooking_limit"
                                        type="number"
                                        min="1"
                                        max="20"
                                    />

                                    <h1
                                        class="w-full pt-5 text-lg text-oynx dark:text-snow"
                                    >
                                        
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template #progressbar>
            <div class="h-1 w-full bg-neutral-400 dark:bg-neutral-600">
                <div
                    class="h-1 bg-persian transition-all duration-250 delay-75"
                    style="width: 20%"
                ></div>
            </div>
        </template>
        <template #backbtn>
            <div class="float-left ml-8 h-full flex items-center">
                <Link
                    :href="`/become-a-cook/${Meal.id}/region`"
                    class="font-semibold"
                >
                <button class="relative group">
                        <span
                            class="hover-underline-animation"
                        >
                            Back
                        </span>
                    </button>
                </Link>
            </div>
        </template>
        <template #mainbtn>
           
                    <button @click="saveData" class="btn2span group">
                    <span class="next-span">Next Step</span>
                    <span class="with-span">We're with you</span>
                </button>
            </template>
    </BecomeCook>
</template>

<script>
import axios from "axios";
export default {
    props: {
        Meal: Object,
    },
    data() {
        return {
            cooking_limit: this.Meal.cooking_limit,
        };
    },
    mounted() {
        // console.log(this.Meal); // Log the meal data to console
    },
    methods: {
        saveData() {
            // Send an HTTP request to your backend API to save the data
            const limit = this.cooking_limit;
            if (limit < 21) {
                axios
                    .put("/meal/limit/" + this.Meal.id, { limit })
                    .then((response) => {
                        // Handle successful response
                        const MealId = response.data.meal.id;
                        this.$inertia.visit(
                            `/become-a-cook/${MealId}/spotlight`
                        );
                    })
                    .catch((error) => {
                        // Handle error
                        // console.error("Error saving data:", error);
                    });
            }
        },
    },
};
</script>

<style scoped>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
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
    animation: fade-in 0.7s ease-in;
}
</style>
