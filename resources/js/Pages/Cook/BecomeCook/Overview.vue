<script setup>
import { Head, Link } from "@inertiajs/vue3";

import BecomeCook from "./BecomeCook.vue";
</script>

<template>
    <BecomeCook>
        <template #info >
             <div class="container relative mx-auto overflow-hidden w-screen">
                <div class="m-auto flex flex-col  items-center h-full px-6 lg:p-8">
                    <div class=" lg:w-2/3 py-5 ">
                        <h1 class="font-semibold text-3xl lg:text-4xl tracking-wide  text-oynx dark:text-snow">
                            Experience Simplicity with Foodmart
                        </h1>
                        <h1 class=" pt-1 lg:text-lg tracking-wide text-oynx dark:text-snow">The perfect is the enemy of the creativity. You can alway change thing you don't like </h1>
                    </div>
                    <div class="lg:w-2/3">
                        
                        <div class="flex flex-col w-full">
                            <div class="flex py-5">
                               
                                <div class="w-2/3">
                                    <h1 class="font-bold pt-1 text-xl lg:text-2xl tracking-wide text-oynx dark:text-snow">What delicious meal are you planning to cook?</h1>
                                    <p class=" pt-3  lg:text-lg text-oynx dark:text-snow">Share some basic info, like who you food is made for and how many people you can cook for.</p>
                                </div>
                                <div class="w-1/3 lg:h-[180px] ml-8 p-3">
                                    <img class="" src="/images/whattocook.jpg" alt="">
                                </div>
                         </div>
                            
                        
                            <div class="flex py-5">
                                
                                <div class="w-2/3">
                                    <h1 class="font-bold pt-1 text-xl lg:text-2xl tracking-wide text-oynx dark:text-snow">Steal the show</h1>
                                    <p class=" pt-3 lg:text-lg  text-oynx dark:text-snow">Bring your meal to life! Upload 5+ photos, tell your story with a title and description. We'll lend a hand.</p>
                                </div>
                                <div class="w-1/3 lg:h-[180px] ml-8 p-3">
                                    <img src="/images/takepicturesofmeal.jpg" alt="">
                                </div>
                         </div>
                            <div class="flex py-5">
                            
                                <div class="w-2/3">
                                    <h1 class="font-bold pt-1 text-xl lg:text-2xl tracking-wide text-oynx dark:text-snow">Let's get the meal out there!</h1>
                                    <p class=" pt-3 lg:text-lg  text-oynx dark:text-snow">Pick your available time, set the price, and share your culinary creation.</p>
                                </div>
                                <div class="w-1/3 lg:h-[180px] ml-8 p-3">
                                    <img src="/images/getitout.jpg" alt="">
                                </div>
                         </div>
                        </div>
    
                    </div>
                </div>
            </div>

        </template>

        <template #progressbar >
            <div class="h-1 w-full bg-neutral-400 dark:bg-neutral-600">
                <div class="h-1 bg-persian transition-all duration-250 delay-75 " style="width: 0%"></div>
            </div>
        </template >
        <template #backbtn >

        </template>
        <template #mainbtn >
            <Link :href="`/become-a-cook/${cookId}/about-your-meal`" class="float-right mr-8">
                <button @click="createTableRow"
                    class="bg-gradient-to-br from-[#e3dedf] to-[#ffffff] shadow-snow-sm dark:shadow-oynx-sm mt-5 button type1 text-xs"></button>
            </Link></template>
    </BecomeCook>
       
</template>

<script>

export default {
    methods: {
        createNewRow() {
            axios.post('/meal/store')
                .then(response => {
                    // Handle the response and extract the ID of the newly created row
                    const newMealId = response.data.id;

                    // Redirect to the new route with the ID included
                    this.$router.push(`/become-a-cook/${newMealId}/about-your-meal`);
                })
                .catch(error => {
                    console.error('Error creating new row:', error);
                });
        }
    }
}

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
    content: "Let's Guide You";
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
    content: "Get Started";
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

