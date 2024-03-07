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
                                            class="flex  flex-col-reverse ">
                                            <div
                                                class="relative sm:w-full p-2"
                                                v-for="(item, index) in ingredients"
                                                :key="index">
                                                <TextInput required
                                                    class="block w-full h-full text-sm p-3"
                                                    v-model="ingredients[index]"/>
                                                <p
                                                    class="absolute bottom-2 top-1 right-2 bg-snow/20  cursor-pointer p-2"
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
                    style="width: 40%"
                ></div>
            </div>
        </template>
        <template #backbtn>
            <div class="float-left ml-8 h-full flex items-center">
                <Link
                    :href="`/become-a-cook/${Meal.id}/spotlight`"
                    class="font-semibold"
                ><button class="relative group">
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
        // console.log(this.Meal); // Log the meal data to console
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
                       
                        const MealId = response.data.meal.id;
                        this.$inertia.visit(
                            `/become-a-cook/${MealId}/meal-title`
                        );
                        
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
