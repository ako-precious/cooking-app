<script setup>
import { Head, Link } from "@inertiajs/vue3";

import FoodCard from "@/Layouts/FoodCard.vue";
import BecomeCook from "./BecomeCook.vue";
</script>

<template>
    <BecomeCook>
        <template #info>
            <div
                class="container relative mx-auto overflow-hidden pb-10 lg:p-0 w-screen"
            >
                <div
                    class="m-auto flex flex-col items-center h-full px-6 lg:p-8"
                >
                    <div class="py-5 lg:px-5">
                        <h1
                            class="font-semibold text-3xl lg:text-4xl tracking-wide text-oynx dark:text-snow"
                        >
                            Thrilled to finally share...
                        </h1>
                        <h1 class="pt-5 text-lg text-oynx dark:text-snow">
                            One last look before your meal wows everyone: Review
                            details to ensure accuracy.
                        </h1>
                    </div>
                    <div class="max-w-[1000px] pb-20">
                        <div class="flex flex-col lg:flex-row w-full">
                            <div class="relative flex lg:p-5 lg:w-1/2">
                                <div class="relative">

                                    <div
                                        class="absolute top-0 right-0 z-10 bg-transparent w-full h-full cursor-pointer"
                                    >
                                </div>
                                        <p
                                            class="absolute text-xs m-1 bg-lavender z-20 rounded-lg p-2"
                                        >
                                            Show preview
                                        </p>
                                        <FoodCard
                                            :meal="meal.data"
                                            class="w-full h-full"
                                        ></FoodCard>
                                </div>
                            </div>
                            <div class="relative flex flex-col lg:pr-10 lg:w-1/2">
                                <div class="w-full py-5 ">
                                    <div class="flex flex-col">
                                        <h1
                                            class="font-bold pt-1 text-xl lg:text-2xl tracking-wide text-oynx dark:text-snow"
                                        >
                                            What to do next?
                                        </h1>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <div class="flex flex-col">
                                        <h1
                                            class="font-bold pt-1 text-lg lg:text-xl tracking-wide text-oynx dark:text-snow"
                                        >
                                            Let's know about your meal
                                        </h1>
                                        <p
                                            class="pt-3 text-sm  text-oynx dark:text-snow"
                                        >
                                            Share some basic info, like who you
                                            food is made for and how many people
                                            you can cook for.
                                        </p>
                                    </div>
                                </div>

                                <div class="w-full py-2">
                                    <div class="flex flex-col">
                                        <h1
                                            class="font-bold pt-1 text-lg lg:text-xl  tracking-wide text-oynx dark:text-snow"
                                        >
                                            Let's take the spot light
                                        </h1>
                                        <p
                                            class="pt-3 text-sm  text-oynx dark:text-snow"
                                        >
                                            Bring your meal to life! Upload 5+
                                            photos, tell your story with a title
                                            and description. We'll lend a hand.
                                        </p>
                                    </div>
                                </div>
                                <div class="w-full py-2">
                                    <div class="flex flex-col">
                                        <h1
                                            class="font-bold pt-1 text-lg lg:text-xl  tracking-wide text-oynx dark:text-snow"
                                        >
                                            Let's take the spot light
                                        </h1>
                                        <p
                                            class="pt-3 text-sm  text-oynx dark:text-snow"
                                        >
                                            Bring your meal to life! Upload 5+
                                            photos, tell your story with a title
                                            and description. We'll lend a hand.
                                        </p>
                                    </div>
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
                    style="width: 95%"
                ></div>
            </div>
        </template>
        <template #backbtn>
            <div class="float-left ml-8 h-full flex items-center">
                <Link
                    :href="`/become-a-cook/${meal.data.id}/price`"
                    class="font-semibold"
                >
                    <button class="relative group">
                        <span class="hover-underline-animation"> Back </span>
                    </button>
                </Link>
            </div>
        </template>
        <template #mainbtn>
            <!-- <Link :href="`/cook/menu`" class="font-semibold"> -->
                <button @click="saveData" class="btn2span group">
                    <span class="next-span">Unveil</span>
                    <span class="with-span">We are done</span>
                </button>
            <!-- </Link> -->
        </template>
    </BecomeCook>
</template>

<script>
import axios from "axios";
export default {
    props: {
        meal: Object,
    },
    data() {
        return {
            // count: this.Meal.price,
        };
    },
    methods: {
        saveData() {
            const status = 'unavailable'
            axios
                .put("/meal/status/" + this.meal.data.id, { status })
                .then((response) => {
                    console.log("Data sent successfully:", response.data);
                    this.$inertia.visit(`/cook/menu`);
                })
                .catch((error) => {
                    console.error("Error sending data:", error);
                });
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
