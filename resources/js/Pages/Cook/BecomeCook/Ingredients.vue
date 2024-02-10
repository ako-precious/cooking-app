<script setup>
import { Head, Link } from "@inertiajs/vue3";

import axios from "axios";
import TextInput from "@/Components/TextInput.vue";
import BecomeCook from "./BecomeCook.vue";
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
                            Let's list the magic ingredients used for the meal.
                        </h1>
                    </div>
                    <div class="lg:w-full">
                        <div class="flex flex-col w-full">
                            <div
                                class="grid grid-cols-2 md:grid-cols-3 gap-5 lg:gap-10 lg:px-10"
                            >
                                <div class="col-span-6 sm:col-span-6">
                                    <div
                                        class="flex items-center "
                                    >
                                    <p
                                    class="bg-snow/50 cursor-pointer pb-4  lg:text-lg text-oynx dark:text-snow active:text-persian "
                                    @click="addItem"
                                    title="add Dietary Restriction and Allergies "
                                    >
                                    Click to  Add Ingredients
                                            <font-awesome-icon
                                                icon="plus"/>
                                        </p>
                                    </div>

                                    <div class="mt-1">
                                        <div
                                            class="flex flex-wrap-reverse flex-row-reverse">
                                            <div
                                                class="relative sm:w-1/3 p-1"
                                                v-for="(item, index) in ingredients"
                                                :key="index">
                                                <TextInput required
                                                    class="block w-full h-full text-sm"
                                                    v-model="ingredients[index]"/>
                                                <p
                                                    class="absolute bottom-1 top-1 right-1 bg-snow/20 cursor-pointer p-2"
                                                    @click="removeItem(index)"
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
                <Link
                    :href="`/become-a-cook/${Meal.id}/spotlight`"
                    class="font-semibold"
                >
                    <button class="cta" @click="saveData">
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
            <Link :href="`/become-a-cook/${Meal.id}/meal-title`" class="float-right mr-8">
                <button @click="saveData" 
                    class="bg-gradient-to-br from-[#e3dedf] to-[#ffffff] shadow-snow-sm dark:shadow-oynx-sm mt-5 button type1 text-xs"
                ></button> </Link
        ></template>
    </BecomeCook>
</template>

<script>

export default {
    props: {
        Meal: Object,
    },
    data() {
        return {
            ingredients: this.Meal.ingredients || [],
        };
    },
    mounted() {
        console.log(this.Meal); // Log the meal data to console
    },
    methods: {
        removeItem(index) {
            this.ingredients.splice(index, 1);
        },
        addItem() {
            this.ingredients.push("");
        },
        saveData() {
            // Send an HTTP request to your backend API to save the data
            const ingredients = this.ingredients;
            // console.log(ingredients.length);
            if (ingredients.length > 0) {
                axios
                    .put("/meal/ingredients/" + this.Meal.id, { ingredients })
                    .then((response) => {
                        // Handle successful response
                        console.log("Data saved successfully:", response.data);
                        
                    })
                    .catch((error) => {
                        // Handle error
                        console.error("Error saving data:", error);
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
