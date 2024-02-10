<script setup>
import { Head, Link } from "@inertiajs/vue3";

import BecomeCook from "./BecomeCook.vue";

import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
</script>

<template>
    <BecomeCook>
        <template #info>
            <div class="container relative mx-auto overflow-hidden">
                <div
                    class="m-auto flex flex-col max-w-[1000px] justify-center h-full px-6 lg:pb-20 w-full"
                >
                    <div class="py-5 lg:pb-12">
                        <h1
                            class="font-semibold text-2xl lg:text-4xl text-oynx dark:text-snow"
                        >
                            Let's crown your culinary creation with a unique
                            title and Share what makes your meal special
                        </h1>
                    </div>
                    <div class="lg:w-full">
                        <div class="flex flex-col w-full">
                            <div
                                class="flex justify-center item-center lg:gap-10 lg:px-10"
                            >
                                <div class="w-full max-w-full py-2">
                                    <div
                                        class="relative flex min-w-0 break-words w-full py-4 shadow-reverse group rounded-2xl bg-clip-border"
                                    >
                                        <div
                                            class="m-auto flex lg:flex-col justify-center flex-wrap w-full p-4 mb-0 list-none rounded-xl"
                                        >
                                            <div class="col-span-6">
                                                <InputLabel
                                                    for="name"
                                                    value="Meal Title (Limit 50 char)"
                                                />
                                                <TextInput
                                                    id="name"
                                                    v-model="meal.name"
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    required
                                                    autocomplete="name"
                                                />
                                                <!-- <InputError
                                                    :message="form.errors.name"
                                                    class="mt-2"
                                                /> -->
                                            </div>
                                            <div class="py-3">
                                                <InputLabel
                                                    for="name"
                                                    value="Meal Description (Limit 600 char)"
                                                />
                                               
                                                <textarea
                                                    autocomplete="other_info"
                                                    id="other_info"
                                                    v-model="meal.description"
                                                    class="mt-1 block w-full disable-scrollbars border-oynx bg-gradient-to-br from-[#e3dedf] to-[#ffffff] shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] focus:shadow-none dark:focus:shadow-none dark:shadow-oynx-sm dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred rounded-md text-oynx dark:text-snow"
                                                    rows="5"
                                                    cols="50"
                                                ></textarea>
                                            </div>
                                        </div>
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
                    style="width: 10%"
                ></div>
            </div>
        </template>
        <template #backbtn>
            <div class="float-left ml-8 h-full flex items-center">
                <Link :href="`/become-a-cook/${Meal.id}/ingredients`" class="font-semibold">
                    <button class="cta">
                        <span
                            class="hover-underline-animation relative tracking-wide text-oynx dark:text-snow pb-1 after:bg-oynx after:dark:bg-snow"
                        >
                            Back
                        </span>
                    </button>
                </Link>
            </div>
        </template>
        <template #mainbtn>
            <!-- <Link :href="`/become-a-cook/${Meal.id}/photos`" class=""> -->
                <button @click="saveData"
                    class="float-right mr-8 bg-gradient-to-br from-[#e3dedf] to-[#ffffff] shadow-snow-sm dark:shadow-oynx-sm mt-5 button type1 text-xs"
                ></button> 
                <!-- </Link> -->
    </template>
    </BecomeCook>
</template>

<script>
import axios from 'axios';
export default {
    props: {
        Meal: Object,
    },
    data() {
        return {
           meal:{
           name: this.Meal.name,
           description: this.Meal.description,
           } 
        };
    },
    methods: {
        
        saveData() {
 // Log the meal data to console
            // Send an HTTP request to your backend API to save the data            
            const meal = this.meal;
            console.log({meal});            
                axios
                    .put("/meal/title/" + this.Meal.id, meal )
                    .then((response) => {
                        // Handle successful response
                        console.log("Data saved successfully:", response.data.meal);
                        const MealId = response.data.meal.id;
                        this.$inertia.visit(
                            `/become-a-cook/${MealId}/photos`
                        );
                    })
                    .catch((error) => {
                        // Handle error
                        console.error("Error saving data:", error);
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

.hover-underline-animation:after {
    content: "";
    position: absolute;
    width: 100%;
    transform: scaleX(0);
    height: 2px;
    bottom: 0;
    left: 0;
    transform-origin: bottom right;
    transition: transform 0.25s ease-out;
}

.cta:hover .hover-underline-animation:after {
    transform: scaleX(1);
    transform-origin: bottom left;
}

/* the design for the next button */
.button {
    height: 50px;
    width: 165px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition: all 0.5s ease-in-out;
}

.button:hover {
    box-shadow: 0.5px 0.5px 150px #252525;
}

.type1::after {
    content: "We're with you";
    height: 50px;
    width: 165px;
    background-color: #004e98;
    color: #fff;
    position: absolute;
    top: 0%;
    left: 0%;
    transform: translateY(50px);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.5s ease-in-out;
}

.type1::before {
    content: "Next Step";
    height: 50px;
    width: 165px;
    /* background-color: #fff; */
    color: #004e98;
    position: absolute;
    top: 0%;
    left: 0%;
    transform: translateY(0px) scale(1.2);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.5s ease-in-out;
}

.type1:hover::after {
    transform: translateY(0) scale(1.2);
}

.type1:hover::before {
    transform: translateY(-50px) scale(0) rotate(120deg);
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
