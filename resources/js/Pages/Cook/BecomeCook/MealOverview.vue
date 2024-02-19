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
                    class="m-auto flex flex-col  items-center h-full px-6 lg:p-8"
                >
                    <div class=" py-5 lg:px-5">
                        <h1
                            class="font-semibold text-3xl lg:text-4xl tracking-wide text-oynx dark:text-snow"
                        >
                        Thrilled to finally share...
                        </h1>
                        <h1 class="pt-5 text-lg text-oynx dark:text-snow">
                            One last look before your meal wows everyone: Review details to ensure accuracy.
                        </h1>
                    </div>
                    <div class="w-full ">
                        <div class="flex flex-col lg:flex-row w-full">
                            <div class="flex lg:p-5">
                                <FoodCard :meal="Meal"></FoodCard>
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
                <!-- <Link
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
                </Link> -->
            </div>
        </template>
        <template #mainbtn>
            <Link
                    :href="`/cook/menu`"
                    class="font-semibold "
                >
                <button @click="saveData" class="btn2span group">
                    <span class="next-span">Unveil</span>
                    <span class="with-span">We are done</span>
                </button>
            </Link>
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
            // count: this.Meal.price,
        };
    },
    methods: {
        saveData() {
           
            
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
