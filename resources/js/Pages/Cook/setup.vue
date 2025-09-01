<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Card from "./Card.vue";
import Footer from "@/Layouts/Footer.vue";
import Header from "./Navbar.vue";
</script>

<template>
    <Head title="Become A Cook" />
    <div class="">

        <div
        class="relative sm:flex-col sm:justify-center sm:items-center min-h-screen bg-center bg-snow dark:bg-oynx selection:bg-red-500 selection:text-snow"
        >
         <!-- <svg id="visual" class="absolute top-0 bottom-0 left-0 right-0 " viewBox="0 0 900 600" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"><g fill="#1B998B"><circle r="147" cx="26" cy="438"></circle><circle r="74" cx="825" cy="126"></circle><circle r="107" cx="468" cy="358"></circle><circle r="104" cx="208" cy="126"></circle></g></svg>
        <svg id="visual" class="absolute top-0 bottom-0 left-0 right-0" viewBox="0 0 900 600" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"><g fill="#004E98"><circle r="147" cx="326" cy="574"></circle><circle r="65" cx="802" cy="55"></circle><circle r="76" cx="824" cy="541"></circle></g></svg> -->
        <div class="md:px-5">
            <Header> </Header>
        </div>
            <div
                class="container relative overflow-hidden mx-auto flex items-center  min-h-screen"
            >
              
                <div
                    class="absolute w-[150px] h-[60px] z-0 right-0 bottom-0 bg-snow dark:bg-oynx"
                ></div>
    
                <div
                    class="m-auto flex items-center h-full px-6 lg:p-8 max-w-screen-md lg:max-w-screen-lg"
                >
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                        <div class="z-10">
                            <h2
                    data-replace="Connect with
                                   students eager`
                                    to taste your meal and offer your culinary
                                    expertise to those seeking homemade delights.
                                    Join us and let your cooking skills shine!"
                                    role="heading"
                                class="swap font-serif text-lg hover:font-mono font-bold leading-10 mb-6 md:text-2xl mt-4  text-oynx dark:text-snow transition-all delay-75"
                            > <span>
    
                                Discover your culinary talents and share your
                                masterpieces with the world! Whether you're a
                                seasoned chef or a passionate home cook, we provide
                                the perfect stage for showcasing your delicious
                                creations.
                            </span>
                              
                        </h2>
                       
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
    </div>
    <div class="container relative mx-auto my-8">
        <Card></Card>
    </div>
    <section class="py-10 sm:py-16 lg:py-24">
        <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
            <div class="max-w-2xl mx-auto text-center">
                <h2
                    class="text-3xl font-bold leading-tight text-oynx dark:text-snow sm:text-4xl lg:text-5xl"
                >
                    Frequently Asked Questions
                </h2>
            </div>
            <div class="max-w-3xl mx-auto mt-8 space-y-4 md:mt-16">
                <div
                    class="transition-all duration-200 bg-snow border border-gray-200 shadow-lg cursor-pointer hover:bg-gray-50 dark:bg-oynx dark:text-snow dark:border-gray-500 dark:hover:bg-oynx/50"
                >
                    <button
                        type="button"
                        id="question1"
                        data-state="closed"
                        class="flex items-center justify-between w-full px-4 py-5 sm:p-6"
                    >
                        <span class="flex text-lg font-semibold text-oynx dark:text-snow"
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
                    class="transition-all duration-200 bg-snow border border-gray-200 shadow-lg cursor-pointer hover:bg-gray-50 dark:bg-oynx dark:text-snow dark:border-gray-500 dark:hover:bg-oynx/50"
                >
                    <button
                        type="button"
                        id="question2"
                        data-state="closed"
                        class="flex items-center justify-between w-full px-4 py-5 sm:p-6"
                    >
                        <span class="flex text-lg font-semibold text-oynx dark:text-snow"
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
                    class="transition-all duration-200 bg-snow border border-gray-200 shadow-lg cursor-pointer hover:bg-gray-50 dark:bg-oynx dark:text-snow dark:border-gray-500 dark:hover:bg-oynx/50"
                >
                    <button
                        type="button"
                        id="question3"
                        data-state="closed"
                        class="flex items-center justify-between w-full px-4 py-5 sm:p-6"
                    >
                        <span class="flex text-lg font-semibold text-oynx dark:text-snow"
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
                            informed decisions about the meals they order.
                            <br />
                            <br />
                            For example, if a customer has a severe allergy to
                            nuts, they can quickly scan the ingredient list to
                            ensure that the meal does not contain any nuts.
                            Providing detailed ingredient lists also helps
                            customers with specific dietary restrictions, such
                            as gluten-free, vegan, or halal, to make informed
                            choices about the meals they order.
                        </p>
                    </div>
                </div>
                <div
                    class="transition-all duration-200 bg-snow border border-gray-200 shadow-lg cursor-pointer hover:bg-gray-50 dark:bg-oynx dark:text-snow dark:border-gray-500 dark:hover:bg-oynx/50"
                >
                    <button
                        type="button"
                        id="question4"
                        data-state="closed"
                        class="flex items-center justify-between w-full px-4 py-5 sm:p-6"
                    >
                        <span class="flex text-lg font-semibold text-oynx dark:text-snow"
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
                            If you're not willing to cook a meal, you can simply
                            reject the order and change the meal status to
                            'unavailable' until you're ready to cook again. This
                            means you can take breaks whenever you need to,
                            without feeling pressured to cook meals that you're
                            not prepared to make. You can also adjust your
                            workload to suit your needs, ensuring you're not
                            overwhelmed with too many orders at once. <br> <br> By having
                            control over your schedule, you can maintain a
                            healthy work-life balance, avoid burnout, and focus
                            on delivering high-quality meals to your customers.
                            This flexibility is a key benefit of being a food
                            delivery partner, allowing you to work on your own
                            terms and manage your workload to suit your needs.
                        </p>
                    </div>
                </div>
                <div
                    class="transition-all duration-200 bg-snow border border-gray-200 shadow-lg cursor-pointer hover:bg-gray-50 dark:bg-oynx dark:text-snow dark:border-gray-500 dark:hover:bg-oynx/50"
                >
                    <button
                        type="button"
                        id="question4"
                        data-state="closed"
                        class="flex items-center justify-between w-full px-4 py-5 sm:p-6"
                    >
                        <span class="flex text-lg font-semibold text-oynx dark:text-snow"
                            >What kind of packaging materials do I need to use for delivery?</span
                        >
                        <font-awesome-icon icon="fa-solid fa-chevron-down" />
                    </button>
                    <div
                        id="answer5"
                        style="display: none"
                        class="px-4 pb-5 sm:px-6 sm:pb-6"
                    >
                        <p>You can bring your unique touch to the presentation, making each meal a visual delight for your customers.

When customers receive their meals, hey'll rate your meal based on several factors, including: <br> 
<ol class=" list-disc pl-4"> <li>Presentation: How visually appealing is the meal?</li>
<li>Taste: How flavorful and satisfying is the food?</li>
<li>Value: Is the meal a good value for the price?</li>
<li>Nutrition: Is the meal nutritious and balanced?</li>
<li>Portion size: Is the portion size generous and satisfying?</li>
<li>Freshness: Is the food fresh and of high quality?</li> </ol> <br>
By focusing on these factors, you can create a memorable experience for your customers.  <br>
As you package your meals, think about how you can make each dish a work of art. Add a personal touch with a handwritten note or a small garnish. The more thought and care you put into the presentation, the more likely customers are to rave about your meals and come back for more
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
    <Footer />
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

/* link text swap */
.swap {
    
    overflow: hidden;
    position: relative;
    display: inline-block;
}

.swap::before,
.swap::after {
    content: "";
    position: absolute;
    width: 100%;
    left: 0;
}

/* .swap::before {
    background-color: #93032e;
    height: 2px;
    bottom: 0;
    transform-origin: 100% 50%;
    transform: scaleX(0);
    transition: transform 1s cubic-bezier(0.76, 0, 0.24, 1);
} */

.swap::after {
    content: attr(data-replace);
    height: 100%;
    top: 0;
    transform-origin: 100% 50%;
    transform: translate3d(200%, 0, 0);
    transition: transform 1s cubic-bezier(0.76, 0, 0.24, 1);
    
}

.swap:hover::before {
    transform-origin: 0% 50%;
    transform: scaleX(1);
}

.swap:hover::after {
    transform: translate3d(0, 0, 0);
}

.swap span {
    display: inline-block;
    transition: transform 1s cubic-bezier(0.76, 0, 0.24, 1);
}

.swap:hover span {
    transform: translate3d(-200%, 0, 0);
}
</style>
