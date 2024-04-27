<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Card from "./Card.vue";

import Header from "./Navbar.vue";
</script>

<template>
    <Head title="Become A Cook" />
    <div class="md:px-5">
        <Header> </Header>
    </div>
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-snow dark:bg-oynx selection:bg-red-500 selection:text-snow"
    >
        <div
            class="container relative mx-auto flex items-center overflow-hidden min-h-screen"
        >
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
                            class="text-sm md:text-base mt-4 font-semibold leading-relaxed text-oynx dark:text-snow"
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
                                expertise to those seeking homemade delights.
                                Join us and let your cooking skills shine!
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
                <h2
                    class="text-3xl font-bold leading-tight text-black sm:text-4xl lg:text-5xl"
                >
                    Frequently Asked Questions
                </h2>
            </div>
            <div class="max-w-3xl mx-auto mt-8 space-y-4 md:mt-16">
                <div
                    class="transition-all duration-200 bg-snow border border-gray-200 shadow-lg cursor-pointer hover:bg-gray-50 dark:bg-oynx dark:text-snow dark:border-gray-800 dark:hover:bg-gray-850"
                >
                    <button
                        type="button"
                        id="question1"
                        data-state="closed"
                        class="flex items-center justify-between w-full px-4 py-5 sm:p-6"
                    >
                        <span class="flex text-lg font-semibold text-black"
                            >What are the fees associated with listing
                            meals?</span
                        >
                        <font-awesome-icon icon="fa-solid fa-chevron-down" />
                    </button>
                    <div
                        id="answer1"
                        style="display: none"
                        class="px-4 pb-5 sm:px-6 sm:pb-6"
                    >
                        <p>
                            List your meal on our website at no additional cost!
                            That's right, there are no fees or charges
                            associated with listing your meal on our platform.
                            This means you can share your culinary creations
                            with the world without worrying about extra
                            expenses. Simply create a listing for your meal, and
                            we'll take care of the rest.
                        </p>
                    </div>
                </div>
                <div
                    class="transition-all duration-200 bg-snow border border-gray-200 shadow-lg cursor-pointer hover:bg-gray-50 dark:bg-oynx dark:text-snow dark:border-gray-800 dark:hover:bg-gray-850"
                >
                    <button
                        type="button"
                        id="question2"
                        data-state="closed"
                        class="flex items-center justify-between w-full px-4 py-5 sm:p-6"
                    >
                        <span class="flex text-lg font-semibold text-black"
                            >How do I get paid for my meals?</span
                        >
                        <font-awesome-icon icon="fa-solid fa-chevron-down" />
                    </button>
                    <div
                        id="answer2"
                        style="display: none"
                        class="px-4 pb-5 sm:px-6 sm:pb-6"
                    >
                        <p>
                            Here's how it works: When customers places an order
                            for your food, you receive the order and prepare it
                            on the date scheduled my the customers. When the
                            meal is ready, you deliver it to the customer's
                            doorstep. After the meal as been delivered, the
                            customers confirms that they've received it. Once
                            the customer confirms the delivery, you get payment
                            . <br />
                            <br />
                            This means you can increase your earnings by
                            preparing multiple meals simultaneously, as long as
                            you can make them for the customers on the day they
                            scheduled it. <br />
                            <br />
                            Overall, being a food delivery partner offers a
                            flexible and lucrative way to earn a living, with
                            the potential to increase your earnings by preparing
                            multiple meals for multiple people at the same
                            time."
                        </p>
                    </div>
                </div>
                <div
                    class="transition-all duration-200 bg-snow border border-gray-200 shadow-lg cursor-pointer hover:bg-gray-50 dark:bg-oynx dark:text-snow dark:border-gray-800 dark:hover:bg-gray-850"
                >
                    <button
                        type="button"
                        id="question3"
                        data-state="closed"
                        class="flex items-center justify-between w-full px-4 py-5 sm:p-6"
                    >
                        <span class="flex text-lg font-semibold text-black"
                            >How do I know if a customer has allergies or
                            dietary restrictions?</span
                        >
                        <font-awesome-icon icon="fa-solid fa-chevron-down" />
                    </button>
                    <div
                        id="answer3"
                        style="display: none"
                        class="px-4 pb-5 sm:px-6 sm:pb-6"
                    >
                        <p>
                            You are required to provide detailed ingredient
                            lists for each meal you offer. This means listing
                            every single ingredient used to prepare the meal,
                            from the smallest component to the largest. This is
                            an important step in ensuring that customers with
                            dietary restrictions or preferences can make
                            informed decisions about the meals they order. <br> <br> For
                            example, if a customer has a severe allergy to nuts,
                            they can quickly scan the ingredient list to ensure
                            that the meal does not contain any nuts. Providing
                            detailed ingredient lists also helps customers with
                            specific dietary restrictions, such as gluten-free,
                            vegan, or halal, to make informed choices about the
                            meals they order. 
                        </p>
                    </div>
                </div>
                <div
                    class="transition-all duration-200 bg-snow border border-gray-200 shadow-lg cursor-pointer hover:bg-gray-50 dark:bg-oynx dark:text-snow dark:border-gray-800 dark:hover:bg-gray-850"
                >
                    <button
                        type="button"
                        id="question4"
                        data-state="closed"
                        class="flex items-center justify-between w-full px-4 py-5 sm:p-6"
                    >
                        <span class="flex text-lg font-semibold text-black"
                            >Do I have to cook all the time?</span
                        >
                        <font-awesome-icon icon="fa-solid fa-chevron-down" />
                    </button>
                    <div
                        id="answer4"
                        style="display: none"
                        class="px-4 pb-5 sm:px-6 sm:pb-6"
                    >
                        <p>
                            Yes, you can cancel your subscription at any time
                            without any hidden fees. We believe in providing a
                            hassle-free experience for our users.
                        </p>
                    </div>
                </div>
            </div>
            <p class="text-center text-gray-600 textbase mt-9">
                Still have questions?
                <span
                    class="cursor-pointer font-medium text-tertiary transition-all duration-200 hover:text-tertiary focus:text-tertiary hover-underline"
                    >Contact our support
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
        document
            .querySelectorAll('[id^="question"]')
            .forEach(function (button, index) {
                button.addEventListener("click", function () {
                    var answer = document.getElementById(
                        "answer" + (index + 1)
                    );
                    var arrow = document.getElementById("arrow" + (index + 1));

                    if (
                        answer.style.display === "none" ||
                        answer.style.display === ""
                    ) {
                        answer.style.display = "block";
                        arrow.style.transform = "rotate(0deg)";
                    } else {
                        answer.style.display = "none";
                        arrow.style.transform = "rotate(-180deg)";
                    }
                });
            });
    },
    methods: {
        addUserToCook() {
            if (this.$page.props.auth.user) {
                this.newCook.user_id = this.$page.props.auth.user.id;
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
