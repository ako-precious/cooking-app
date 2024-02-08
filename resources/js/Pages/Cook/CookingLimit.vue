<script setup>
import { Head, Link } from "@inertiajs/vue3";

import BecomeCook from "./BecomeCook.vue";
import TextInput from "@/Components/TextInput.vue";
</script>

<template>
    <BecomeCook>
        <template #info>
            <div class="container relative mx-auto overflow-hidden w-screen">
                <div
                    class="m-auto flex flex-col lg:flex-row items-center h-full px-6 lg:p-8"
                >
                    <div class="lg:w-1/2 py-5 lg:px-5">
                       
                        <h1
                            class="font-semibold text-3xl lg:text-5xl tracking-wide text-oynx dark:text-snow"
                        >
                            How many people can you cook for
                        </h1>
                        <h1
                            class=" pt-5 text-lg lg:text-xl  text-oynx dark:text-snow"
                        >
                        Your commitment to delivering the best experience for each person is admirable. To help you prioritize quality, could you share your preferred number for preparing an exceptional meal?
                        </h1>
                    </div>
                    <div class="lg:w-1/2">
                        <div class="flex flex-col w-full">
                            <div class="flex lg:p-5">
                                
                                <div class="w-2/3 p-3 lg:p-10 ml-8 ">
                                    <input 
                placeholder="Limit"
                class=" -shadow-snow-sm  dark:-shadow-oynx-sm focus:shadow-snow-inner focus:dark:shadow-oynx-inner bg-transparent border-none sm:w-[15rem] md:w-[20rem] lg:w-[25rem]  2xl:max-w-2xl text-oynx dark:text-white  rounded-full py-3 px-5 outline-none   dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred transition-all ease-in duration-250 delay-75"
                v-model="searchText"
                
                type="number" min="1" max="20" />
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
                <Link :href="`/become-a-cook/region`" class=" font-semibold">
                    <button class="cta ">
                        <span class="hover-underline-animation relative tracking-wide text-oynx dark:text-snow pb-1 after:bg-oynx after:dark:bg-snow">
                          Back  
                        </span>
                    </button>
                </Link>
            </div>
        </template>
        <template #mainbtn>
            <Link
                :href="`/become-a-cook/steal-the-show`"
                class="float-right mr-8"
            >
                <button
                    class="bg-gradient-to-br from-[#e3dedf] to-[#ffffff] shadow-snow-sm dark:shadow-oynx-sm mt-5 button type1 text-xs"
                ></button> </Link
        ></template>
    </BecomeCook>
</template>

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
