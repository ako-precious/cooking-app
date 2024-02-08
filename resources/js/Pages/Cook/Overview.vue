<script setup>
import { Head, Link } from "@inertiajs/vue3";

import BecomeCook from "./BecomeCook.vue";
</script>

<template>
    <BecomeCook>

        <div class="container relative mx-auto overflow-hidden w-screen">
            <div class="m-auto flex flex-col lg:flex-row items-center h-full px-6 lg:p-8">
                <div class=" lg:w-1/2 py-5 lg:pr-5">
                    <h1 class="font-semibold text-3xl lg:text-5xl tracking-wide  text-oynx dark:text-snow">
                        Experience simplicity with Foodmart
                    </h1>
                    <!-- <h1 class="font-bold pt-1 lg:text-xl tracking-wide text-oynx dark:text-snow">Get started easily!</h1> -->
                </div>
                <div class="lg:w-1/2">
                    <div class="flex flex-col w-full">
                        <div class="flex pb-5">
                           
                            <div class="w-2/3">
                                <h1 class="font-bold pt-1 text-xl lg:text-2xl tracking-wide text-oynx dark:text-snow">What delicious meal are you planning to cook?</h1>
                                <p class=" pt-3  lg:text-lg text-oynx dark:text-snow">Share some basic info, like what you can cook and how many people you can cook for.</p>
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
    </BecomeCook>
       
</template>

<!-- Saving for later -->
<!-- "Indulge your taste buds and unlock a world of culinary delights with our platform, where passionate home chefs transform ordinary ingredients into extraordinary experiences. From tantalizing dishes to mouthwatering desserts, our community of food artisans invites you to savor their creations and bring the flavors of the world into your home. Whether you're seeking a gourmet feast for a special occasion or craving everyday comfort food made with love, discover your perfect match among our talented cooks who are ready to turn your cravings into unforgettable culinary adventures." -->

