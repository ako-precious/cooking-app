<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Card from "./Card.vue";

import Header from './Navbar.vue';
</script>

<template>
    <Head title="Become A Cook" />
    <div class="md:px-5">

<Header >   
</Header>
</div>
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-snow dark:bg-oynx selection:bg-red-500 selection:text-snow"
    >
    
        <div class="container relative mx-auto flex items-center overflow-hidden min-h-screen ">
            <!-- <iframe
                src="https://my.spline.design/untitled-22ece4253c983291af7e559585416b64/"
                frameborder="0"
                class=" absolute w-full h-full z-0"
            ></iframe> -->
            <div
                class="absolute w-[150px] h-[60px] z-0 right-0 bottom-0 bg-snow dark:bg-oynx"
            ></div>

            <div
                class="m-auto flex items-center h-full px-6 lg:p-8 max-w-screen-md lg:max-w-screen-lg"
            >
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    <div class="z-10">
                        <p
                            class=" text-sm md:text-base  mt-4 font-semibold leading-relaxed text-oynx dark:text-snow"
                        >
                            Discover your culinary talents and share your
                            masterpieces with the world! Whether you're a
                            seasoned chef or a passionate home cook, we provide
                            the perfect stage for showcasing your delicious
                            creations.
                            <br />
                            <br />
                            <span class="">

                                Connect with 
                                <span class=""> food enthusiasts </span> eager
                                to taste your dishes and offer your culinary
                                expertise to those seeking homemade delights. Join
                                us and let your cooking skills shine!
                            </span>
                        </p>
                        <Link :href="`/become-a-cook/overview`">
                            <button
                                @click="addUserToCook"
                                class="btn2span group float-left w-[170px]"
                            >
                                <span class="next-span"> Start Cooking </span>
                                <span class="with-span">
                                    Monetize Your Passion
                                </span>
                            </button>
                          
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container relative mx-auto my-8">
        <Card></Card>
      
    </div>
    <section class="py-10 bg-gray-50 sm:py-16 lg:py-24">
    <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="text-3xl font-bold leading-tight text-black sm:text-4xl lg:text-5xl">
                Explore Common Questions
            </h2>
        </div>
        <div class="max-w-3xl mx-auto mt-8 space-y-4 md:mt-16">
            <div
                class="transition-all duration-200 bg-snow border border-gray-200 shadow-lg cursor-pointer hover:bg-gray-50  dark:bg-oynx dark:text-snow dark:border-gray-800 dark:hover:bg-gray-850">
                <button type="button" id="question1" data-state="closed" class="flex items-center justify-between w-full px-4 py-5 sm:p-6">
                    <span class="flex text-lg font-semibold text-black">How can I get started?</span>
                    <svg id="arrow1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-6 h-6 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="answer1" style="display:none" class="px-4 pb-5 sm:px-6 sm:pb-6">
                    <p>Getting started is easy! Sign up for an account, and you'll have access to our platform's
                        features. No credit card required for the initial signup.</p>
                </div>
            </div>
            <div
                class="transition-all duration-200 bg-snow border border-gray-200 shadow-lg cursor-pointer hover:bg-gray-50  dark:bg-oynx dark:text-snow dark:border-gray-800 dark:hover:bg-gray-850 ">
                <button type="button" id="question2" data-state="closed" class="flex items-center justify-between w-full px-4 py-5 sm:p-6">
                    <span class="flex text-lg font-semibold text-black">What is the pricing structure?</span>
                    <svg id="arrow2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-6 h-6 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="answer2" style="display:none" class="px-4 pb-5 sm:px-6 sm:pb-6">
                    <p>Our pricing structure is flexible. We offer both free and paid plans. You can choose the one
                        that
                        suits your needs and budget.</p>
                </div>
            </div>
            <div
                class="transition-all duration-200 bg-snow border border-gray-200 shadow-lg cursor-pointer hover:bg-gray-50  dark:bg-oynx dark:text-snow dark:border-gray-800 dark:hover:bg-gray-850">
                <button type="button" id="question3" data-state="closed" class="flex items-center justify-between w-full px-4 py-5 sm:p-6">
                    <span class="flex text-lg font-semibold text-black">What kind of support do you provide?</span>
                    <svg id="arrow3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-6 h-6 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="answer3" style="display:none" class="px-4 pb-5 sm:px-6 sm:pb-6">
                    <p>We offer comprehensive customer support. You can reach out to our support team through
                        various
                        channels, including email, chat, and a knowledge base.</p>
                </div>
            </div>
            <div
                class="transition-all duration-200 bg-snow border border-gray-200 shadow-lg cursor-pointer hover:bg-gray-50  dark:bg-oynx dark:text-snow dark:border-gray-800 dark:hover:bg-gray-850">
                <button type="button" id="question4" data-state="closed" class="flex items-center justify-between w-full px-4 py-5 sm:p-6">
                    <span class="flex text-lg font-semibold text-black">Can I cancel my subscription anytime?</span>
                    <svg id="arrow4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-6 h-6 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="answer4" style="display:none" class="px-4 pb-5 sm:px-6 sm:pb-6">
                    <p>Yes, you can cancel your subscription at any time without any hidden fees. We believe in
                        providing a hassle-free experience for our users.</p>
                </div>
            </div>
        </div>
        <p class="text-center text-gray-600 textbase mt-9">
            Still have questions?
            <span class="cursor-pointer font-medium text-tertiary transition-all duration-200 hover:text-tertiary focus:text-tertiary hover-underline">Contact
                our support
            </span>
        </p>
    </div>
    
</section>
</template>
<script>
import axios from "axios";
export default {
    data() {
        return {
            newCook: {
                user_id: null,
                certificate: null,
                means_of_id: null,
                other_info: null,
                status: "pending",
            },
        };
    },
    mounted() {
        document.querySelectorAll('[id^="question"]').forEach(function(button, index) {
            button.addEventListener('click', function() {
                var answer = document.getElementById('answer' + (index + 1));
                var arrow = document.getElementById('arrow' + (index + 1));

                if (answer.style.display === 'none' || answer.style.display === '') {
                    answer.style.display = 'block';
                    arrow.style.transform = 'rotate(0deg)';
                } else {
                    answer.style.display = 'none';
                    arrow.style.transform = 'rotate(-180deg)';
                }
            });
        });
    },
    methods: {
        addUserToCook() {
            if(this.$page.props.auth.user){
              this.newCook.user_id = this.$page.props.auth.user.id
                axios
                    .post("/cook/menu", this.newCook)
                    .then((response) => {
                        // Handle the response and extract the ID of the newly created row
                        console.log(response.data.id);
    
                        // Redirect to the new route with the ID included
                        // this.$router.push(`/become-a-cook/${newMealId}/about-your-meal`);
                    })
                    .catch((error) => {
                        console.error("Error creating new row:", error);
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
</style>
