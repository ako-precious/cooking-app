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
                            class="font-semibold text-2xl lg:text-4xl text-oynx dark:text-snow"
                        >
                            What Continent is more likely familiar to your meal?
                        </h1>
                    </div>
                    <div class="lg:w-full">
                        <div class="flex flex-col w-full">
                            <div
                                class="grid grid-cols-2 md:grid-cols-3 gap-5 lg:gap-10 lg:px-10"
                            >
                                <div class="col-span-1 w-full max-w-full py-2">
                                    <div
                                        :class="{
                                            'border-persian border-2 ':
                                                selectedDiv === 'Africa',
                                        }"
                                        class="flex min-w-0 break-words w-full py-4 shadow-reverse group rounded-2xl bg-clip-border cursor-pointer"
                                        @click="
                                            [
                                                sendData('Africa'),
                                                selectDiv('Africa'),
                                            ]
                                        "
                                    >
                                        <div
                                            class="flex lg:flex-col justify-center flex-wrap w-full p-4 mb-0 list-none rounded-xl"
                                        >
                                            <font-awesome-icon
                                                class="text-4xl group-action-text"
                                                icon="earth-africa"
                                            />
                                            <div></div>
                                            <div class="pt-2 w-full">
                                                <p
                                                    class="font-semibold text-center px-4 py-2 transition-colors ease-in-out rounded-lg group-action-text"
                                                >
                                                    <span
                                                        class="lg:text-xl leading-normal"
                                                        >Africa</span
                                                    >
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-1 w-full max-w-full py-2">
                                    <div
                                        :class="{
                                            'border-persian border-2 ':
                                                selectedDiv === 'Antarctica',
                                        }"
                                        @click="
                                            [
                                                sendData('Antarctica'),
                                                selectDiv('Antarctica'),
                                            ]
                                        "
                                        class="flex min-w-0 break-words w-full py-4 shadow-reverse group rounded-2xl bg-clip-border cursor-pointer"
                                    >
                                        <div
                                            class="flex lg:flex-col justify-center flex-wrap w-full p-4 mb-0 list-none rounded-xl"
                                        >
                                            <font-awesome-icon
                                                class="text-4xl group-action-text"
                                                icon="earth"
                                            />
                                            <div></div>
                                            <div class="pt-2 w-full">
                                                <p
                                                    class="font-semibold text-center px-4 py-2 transition-colors ease-in-out rounded-lg group-action-text"
                                                >
                                                    <span
                                                        class="lg:text-xl leading-normal"
                                                        >Antarctica</span
                                                    >
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-1 w-full max-w-full py-2">
                                    <div
                                        :class="{
                                            'border-persian border-2 ':
                                                selectedDiv === 'Asia',
                                        }"
                                        @click="
                                            [
                                                sendData('Asia'),
                                                selectDiv('Asia'),
                                            ]
                                        "
                                        class="flex min-w-0 break-words w-full py-4 shadow-reverse group rounded-2xl bg-clip-border cursor-pointer"
                                    >
                                        <div
                                            class="flex lg:flex-col justify-center flex-wrap w-full p-4 mb-0 list-none rounded-xl"
                                        >
                                            <font-awesome-icon
                                                class="text-4xl group-action-text"
                                                icon="earth-asia"
                                            />
                                            <div></div>
                                            <div class="pt-2 w-full">
                                                <p
                                                    class="font-semibold text-center px-4 py-2 transition-colors ease-in-out rounded-lg group-action-text"
                                                >
                                                    <span
                                                        class="lg:text-xl leading-normal"
                                                        >Asia</span
                                                    >
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-1 w-full max-w-full py-2">
                                    <div
                                        :class="{
                                            'border-persian border-2 ':
                                                selectedDiv === 'Europe',
                                        }"
                                        @click="
                                            [
                                                sendData('Europe'),
                                                selectDiv('Europe'),
                                            ]
                                        "
                                        class="flex min-w-0 break-words w-full py-4 shadow-reverse group rounded-2xl bg-clip-border cursor-pointer"
                                    >
                                        <div
                                            class="flex lg:flex-col justify-center flex-wrap w-full p-4 mb-0 list-none rounded-xl"
                                        >
                                            <font-awesome-icon
                                                class="text-4xl group-action-text"
                                                icon="earth-europe"
                                            />
                                            <div></div>
                                            <div class="pt-2 w-full">
                                                <p
                                                    class="font-semibold text-center px-4 py-2 transition-colors ease-in-out rounded-lg group-action-text"
                                                >
                                                    <span
                                                        class="lg:text-xl leading-normal"
                                                        >Europe
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-1 w-full max-w-full py-2">
                                    <div
                                        :class="{
                                            'border-persian border-2 ':
                                                selectedDiv === 'North America',
                                        }"
                                        @click="
                                            [
                                                sendData('North America'),
                                                selectDiv('North America'),
                                            ]
                                        "
                                        class="flex min-w-0 break-words w-full py-4 shadow-reverse group rounded-2xl bg-clip-border cursor-pointer"
                                    >
                                        <div
                                            class="flex lg:flex-col justify-center flex-wrap w-full p-4 mb-0 list-none rounded-xl"
                                        >
                                            <font-awesome-icon
                                                class="text-4xl group-action-text"
                                                icon="earth-americas"
                                            />
                                            <div></div>
                                            <div class="pt-2 w-full">
                                                <p
                                                    class="font-semibold text-center px-4 py-2 transition-colors ease-in-out rounded-lg group-action-text"
                                                >
                                                    <span
                                                        class="lg:text-xl leading-normal"
                                                        >North America
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-1 w-full max-w-full py-2">
                                    <div
                                        :class="{
                                            'border-persian border-2 ':
                                                selectedDiv === 'Oceania',
                                        }"
                                        @click="
                                            [
                                                sendData('Oceania'),
                                                selectDiv('Oceania'),
                                            ]
                                        "
                                        class="flex min-w-0 break-words w-full py-4 shadow-reverse group rounded-2xl bg-clip-border cursor-pointer"
                                    >
                                        <div
                                            class="flex lg:flex-col justify-center flex-wrap w-full p-4 mb-0 list-none rounded-xl"
                                        >
                                            <font-awesome-icon
                                                class="text-4xl group-action-text"
                                                icon="earth-oceania"
                                            />
                                            <div></div>
                                            <div class="pt-2 w-full">
                                                <p
                                                    class="font-semibold text-center px-4 py-2 transition-colors ease-in-out rounded-lg group-action-text"
                                                >
                                                    <span
                                                        class="lg:text-xl leading-normal"
                                                        >Oceania</span
                                                    >
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-1 w-full max-w-full py-2">
                                    <div
                                        :class="{
                                            'border-persian border-2 ':
                                                selectedDiv === 'South America',
                                        }"
                                        @click="
                                            [
                                                sendData('South America'),
                                                selectDiv('South America'),
                                            ]
                                        "
                                        class="flex min-w-0 break-words w-full py-4 shadow-reverse group rounded-2xl bg-clip-border cursor-pointer"
                                    >
                                        <div
                                            class="flex lg:flex-col justify-center flex-wrap w-full p-4 mb-0 list-none rounded-xl"
                                        >
                                            <font-awesome-icon
                                                class="text-4xl group-action-text"
                                                icon="earth-americas"
                                            />
                                            <div></div>
                                            <div class="pt-2 w-full">
                                                <p
                                                    class="font-semibold text-center px-4 py-2 transition-colors ease-in-out rounded-lg group-action-text"
                                                >
                                                    <span
                                                        class="lg:text-xl leading-normal"
                                                        >South America</span
                                                    >
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
                    :href="`/become-a-cook/${Meal.id}/about-your-meal`"
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
            
            <Link :href="`/become-a-cook/${Meal.id}/cook-limit`" class="">
                <button
                class=" group float-right mr-8 mt-5 relative overflow-hidden transition-all duration-500 ease-in-out transform bg-gradient-to-br from-[#e3dedf] to-[#ffffff] shadow-snow-sm dark:shadow-oynx-sm rounded-lg h-12 w-40 button type1 text-xs hover:shadow-dark-blur"
                ></button> </Link> 
                <button class="float-left mr-8 mt-5 text-xs relative overflow-hidden transition-all duration-500 ease-in-out transform bg-gradient-to-br from-[#e3dedf] to-[#ffffff] shadow-snow-sm dark:shadow-oynx-sm rounded-lg h-12 w-40">
                    <span class="absolute top-0 left-0 w-full h-full flex items-center justify-center text-white bg-blue-600 hover:bg-blue-700 transition-all duration-500 ease-in-out transform translate-y-full">
            We're with you
        </span>
        <span class="absolute top-0 left-0 w-full h-full flex items-center justify-center text-blue-600 hover:text-white transition-all duration-500 ease-in-out transform translate-y-0 scale-125 group-hover:rotate-[120]">
            Next Step
        </span>
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
            selectedDiv: this.Meal.region,
        };
    },
    mounted() {
        console.log(this.Meal); // Log the meal data to console
    },
    methods: {
        sendData(region) {
            // Perform an HTTP request to send the data to the server
            axios
                .put("/meal/region/" + this.Meal.id, { region })
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

.button::after {
    content: "We're with you";
    height: 50px;
    width: 100%;
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
.button::before {
    content: "Next Step";
    height: 50px;
    width: 100%;
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

.button:hover::after {
    transform: translateY(0) scale(1.2);
}

.button:hover::before {
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
