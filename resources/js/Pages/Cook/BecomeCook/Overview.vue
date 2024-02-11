<script setup>
import { Head, Link } from "@inertiajs/vue3";

import BecomeCook from "./BecomeCook.vue";
</script>

<template>
    <BecomeCook>
        <template #info>
            <div class="container relative mx-auto overflow-hidden w-screen">
                <div
                    class="m-auto flex flex-col items-center h-full px-6 lg:p-8"
                >
                    <div class="lg:w-3/4 text-center py-5">
                        <h1
                            class="font-semibold text-3xl lg:text-4xl tracking-wide text-oynx dark:text-snow"
                        >
                            Experience Simplicity with Foodmart
                        </h1>
                        <h1
                            class="pt-1 lg:text-lg tracking-wide text-oynx dark:text-snow"
                        >
                            The perfect is the enemy of the creativity. You can
                            alway change thing you don't like
                        </h1>
                    </div>
                    <div class="lg:w-4/5">
                        <div
                            class="grid sm:grid-cols-2 py-5 md:grid-cols-3 gap-3 lg:gap-6"
                        >
                            <div class="w-full">
                                <div class="flex flex-col">
                                    <h1
                                        class="font-bold pt-1 text-xl lg:text-2xl tracking-wide text-oynx dark:text-snow"
                                    >
                                        Let's know about your meal
                                    </h1>
                                    <p
                                        class="pt-3 lg:text-lg text-oynx dark:text-snow"
                                    >
                                        Share some basic info, like who you food
                                        is made for and how many people you can
                                        cook for.
                                    </p>
                                </div>
                                <!-- <div class="w-1/3 lg:h-[180px] ml-8 p-3">
                                    <img
                                        class=""
                                        src="/images/whattocook.jpg"
                                        alt=""
                                    />
                                </div> -->
                            </div>

                            <div class="w-full">
                                <div class="flex flex-col">
                                    <h1
                                        class="font-bold pt-1 text-xl lg:text-2xl tracking-wide text-oynx dark:text-snow"
                                    >
                                        Let's take the spot light
                                    </h1>
                                    <p
                                        class="pt-3 lg:text-lg text-oynx dark:text-snow"
                                    >
                                        Bring your meal to life! Upload 5+
                                        photos, tell your story with a title and
                                        description. We'll lend a hand.
                                    </p>
                                </div>
                                <!-- <div class="w-1/3 lg:h-[180px] ml-8 p-3">
                                    <img
                                        src="/images/takepicturesofmeal.jpg"
                                        alt=""
                                    />
                                </div> -->
                            </div>
                            <div class="w-full">
                                <div class="flex flex-col">
                                    <h1
                                        class="font-bold pt-1 text-xl lg:text-2xl tracking-wide lg:h-[60px] text-oynx dark:text-snow"
                                    >
                                        Let's get the meal out there!
                                    </h1>
                                    <p
                                        class="pt-3 lg:text-lg text-oynx dark:text-snow"
                                    >
                                        Pick your available time, set the price,
                                        and share your culinary creation.
                                    </p>
                                </div>
                                <!-- <div class="w-1/3 lg:h-[180px] ml-8 p-3">
                                    <img src="/images/getitout.jpg" alt="" />
                                </div> -->
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
                    style="width: 0%"
                ></div>
            </div>
        </template>
        <template #backbtn> </template>
        <template #mainbtn>
                       
                <button @click="createNewMeal" class="btn2span group">
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
            newMeal: {
                user_id: this.$page.props.auth.user.id,
            },
            MealId: this.Meal.id,
        };
    },

    methods: {
        createNewMeal() {
            // Check if the current route is "/become-a-cook/overview"
            if (this.MealId) {
                // If newMealId is already defined, visit the specified URL
                this.$inertia.visit(
                    `/become-a-cook/${this.MealId}/about-your-meal`
                );
            } else {
                // Otherwise, proceed to create a new meal
                axios
                    .post("/meal", this.newMeal)
                    .then((response) => {
                        // Handle the response and extract the ID of the newly created row
                        const newMealId = response.data.id;

                        // Update newMealId in the component's data
                        this.newMealId = newMealId;

                        // Redirect to the specified URL with the newMealI
                        this.$inertia.visit(
                            `/become-a-cook/${this.newMealId}/about-your-meal`
                        );
                    })
                    .catch((error) => {
                        console.error("Error creating new meal:", error);
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
