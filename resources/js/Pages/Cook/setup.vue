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
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-snow dark:bg-oynx selection:bg-red-500 selection:text-white"
    >
    
        <div class="container relative mx-auto flex items-center overflow-hidden min-h-screen ">
            <iframe
                src="https://my.spline.design/untitled-22ece4253c983291af7e559585416b64/"
                frameborder="0"
                class=" absolute w-full h-full z-0"
            ></iframe>
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

                                Connect with Student
                                <span class="hidden"> food enthusiasts </span> eager
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
</template>
<script>
import axios from "axios";
export default {
    data() {
        return {
            newCook: {
                user_id: this.$page.props.auth.user.id,
                certificate: null,
                means_of_id: null,
                other_info: null,
                status: "pending",
            },
        };
    },
    methods: {
        addUserToCook() {
            axios
                .post("/cook", this.newCook)
                .then((response) => {
                    // Handle the response and extract the ID of the newly created row
                    console.log(response.data.id);

                    // Redirect to the new route with the ID included
                    // this.$router.push(`/become-a-cook/${newMealId}/about-your-meal`);
                })
                .catch((error) => {
                    console.error("Error creating new row:", error);
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
</style>
