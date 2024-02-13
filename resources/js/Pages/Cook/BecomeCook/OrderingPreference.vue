<script setup>
import { Head, Link } from "@inertiajs/vue3";

import BecomeCook from "./BecomeCook.vue";
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
                            class="font-semibold text-2xl text-center lg:text-4xl text-oynx dark:text-snow"
                        >
                            What Continent is more likely familiar to your meal?
                        </h1>
                    </div>
                    <div class="lg:w-full">
                        <div class="flex flex-col w-full">
                            <div
                                class="grid grid-cols-1 gap-5 lg:gap-10 lg:px-10"
                            >
                                <div class="col-span-1 w-full max-w-full">
                                    <div
                                        :class="{
                                            'border-persian border-2 ':
                                                selectedDiv === 'automatic',
                                        }"
                                        class="flex min-w-0 break-words w-full py-4 shadow-reverse group rounded-2xl bg-clip-border cursor-pointer"
                                        @click="
                                            [
                                                sendData('automatic'),
                                                selectDiv('automatic'),
                                            ]
                                        "
                                    >
                                        <div
                                            class="flex  justify-between  w-full p-4 mb-0 list-none rounded-xl"
                                        >
                                        <div class=" w-full">
                                            <p
                                                class="font-semibold px-4 py-2 transition-colors ease-in-out rounded-lg group-action-text"
                                            >
                                                <span
                                                    class="lg:text-xl leading-normal"
                                                    >Ordering instantly</span
                                                >
                                            </p>
                                            <p
                                                class="px-4 transition-colors ease-in-out rounded-lg group-action-text"
                                            >
                                                <span
                                                    class="text-sm lg:text-lg leading-normal"
                                                    >The order is accepted automatically and instantly </span
                                                >
                                            </p>
                                        </div>
                                            <div></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-1 w-full max-w-full ">
                                    <div
                                        :class="{
                                            'border-persian border-2 ':
                                                selectedDiv === 'manual',
                                        }"
                                        @click="
                                            [
                                                sendData('manual'),
                                                selectDiv('manual'),
                                            ]
                                        "
                                        class="flex min-w-0 break-words w-full py-4 shadow-reverse group rounded-2xl bg-clip-border cursor-pointer"
                                    >
                                    
                                    <div
                                            class="flex  justify-between  w-full p-4 mb-0 list-none rounded-xl"
                                        >
                                        <div class=" w-full">
                                            <p
                                                class="font-semibold px-4 py-2 transition-colors ease-in-out rounded-lg group-action-text"
                                            >
                                                <span
                                                    class="lg:text-xl leading-normal"
                                                    >Accept or Reject Order</span
                                                >
                                            </p>
                                            <p
                                                class="px-4  transition-colors ease-in-out rounded-lg group-action-text"
                                            >
                                                <span
                                                    class="text-sm lg:text-lg leading-normal"
                                                    >You have to accept or reject every order before it can be processed </span
                                                >
                                            </p>
                                        </div>
                                            <div></div>
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
                    :href="`/become-a-cook/${Meal.id}/about-your-meal`"
                    class="font-semibold"
                >
                    <button class="relative group">
                        <span
                            class="hover-underline-animation"
                        >Back</span>
                    </button>
                    
                </Link>
            </div>
        </template>
        <template #mainbtn>
            
            <Link :href="`/become-a-cook/${Meal.id}/cook-limit`" class="">
                <button class="btn2span group">
                    <span class="next-span">
                        Next Step
                    </span>
                    <span class="with-span">
            We're with you
        </span>
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
            selectedDiv: this.Meal.region,
        };
    },
   
    methods: {
        sendData(preference) {
            // Perform an HTTP request to send the data to the server
            console.log(preference);
            axios
                .put("/meal/preference/" + this.Meal.id, { preference })
                .then((response) => {
                    console.log("Data sent successfully:", response.data);
                })
                .catch((error) => {
                    console.error("Error sending data:", error);
                });
        },
        selectDiv(divId) {
            this.selectedDiv = divId;
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
