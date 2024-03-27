<script setup>
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-snow dark:bg-oynx selection:bg-red-500 selection:text-white"
    >
        <div class="container relative mx-auto overflow-hidden h-screen">
            <iframe
                src="https://my.spline.design/untitled-22ece4253c983291af7e559585416b64/"
                frameborder="0"
                class="absolute w-screen h-screen z-0"
            ></iframe>
            <div
                class="absolute w-[115px] h-[60px] z-0 right-0 bottom-0 bg-snow dark:bg-oynx"
            ></div>

            <div
                class="m-auto flex items-center h-full px-6 lg:p-8 max-w-screen-lg"
            >
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    <div class="z-10">
                        <p
                            class="mt-4 font-semibold leading-relaxed text-oynx dark:text-snow"
                        >
                            Discover your culinary talents and share your
                            masterpieces with the world! Whether you're a
                            seasoned chef or a passionate home cook, we provide
                            the perfect stage for showcasing your delicious
                            creations.
                            <br />
                            <br />
                            Connect with Student
                            <span class="hidden"> food enthusiasts </span> eager
                            to taste your dishes and offer your culinary
                            expertise to those seeking homemade delights. Join
                            us and let your cooking skills shine!
                        </p>
                        <Link :href="`/become-a-cook/overview`">
                            <button
                                @click="addUserToCook"
                                class="bg-gradient-to-br from-[#e3dedf] to-[#ffffff] dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] shadow-snow-sm dark:shadow-oynx-sm mt-5 button type1 text-xs"
                            ></button>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container relative mx-auto my-8">
        <div
            class="grid grid-rows-6 grid-flow-col gap-5 auto-cols-fr px-6 lg:p-8"
        >
            <div class="row-span-4 shadow-extra-small rounded-3 ">
                <div class="card  h-full rounded-3">
                    <img
                                        class="h-full"
                                        src="/images/ordering.jpeg"
                                        alt=""
                                    />
                    <div class="card__content">
                        <p class="card__title">Card Title</p>
                        <p class="card__description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis
                            nostrud exercitation ullamco.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-start-2 col-end-4 row-span-2 h-50 shadow-extra-small rounded-3 ...">
                <div class="card h-full">
                    <img
                                        class="h-full"
                                        src="/images/cook.png"
                                        alt=""
                                    />
                    <div class="card__content">
                        <p class="card__title">Card Title</p>
                        <p class="card__description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis
                            nostrud exercitation ullamco.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row-start-3 row-end-7 shadow-extra-small rounded-3 ...">
                <div class="card h-full rounded-3">
                    <img
                                        class="h-full"
                                        src="/images/packing.jpeg"
                                        alt=""
                                    />
                    <div class="card__content">
                        <p class="card__title">Card Title</p>
                        <p class="card__description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis
                            nostrud exercitation ullamco.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row-start-5 row-end-7 col-start-1 col-end-3 h-50 shadow-extra-small rounded-3 ...">
                <div class="card h-full rounded-3">
                    <img
                                        class="h-full"
                                        src="/images/deliver.png"
                                        alt=""
                                    />
                    <div class="card__content">
                        <p class="card__title">Card Title</p>
                        <p class="card__description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis
                            nostrud exercitation ullamco.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-start-2 col-end-3 row-span-2  shadow-extra-small rounded-3 ...">
                <div
                    class="cursor-pointer group overflow-hidden p-5 duration-1000 hover:duration-1000 relative h-full w4 mx-auto  rounded-xl"
                >
                    <div
                        class="group-hover:-top-3 bg-transparent -top-12 -left-12 absolute shadow-yellow-800 shadow-inner rounded-xl transition-all ease-in-out group-hover:duration-1000 duration-1000 w-24 h-24"
                    ></div>
                    <div
                        class="group-hover:top-60 bg-transparent top-44 left-14 absolute shadow-lighred shadow-inner rounded-xl transition-all ease-in-out group-hover:duration-1000 duration-1000 w-24 h-24"
                    ></div>
                    <div
                        class="group-hover:-left-12 bg-transparent top-24 left-56 absolute shadow-sky-800 shadow-inner rounded-xl transition-all ease-in-out group-hover:duration-1000 duration-1000 w-24 h-24"
                    ></div>
                    <div
                        class="group-hover:-top-44 bg-transparent top-12 left-12 absolute shadow-lighred shadow-inner rounded-xl transition-all ease-in-out group-hover:duration-1000 duration-1000 w-12 h-12"
                    ></div>
                    <div
                        class="group-hover:left-44 bg-transparent top-12 left-12 absolute shadow-persian shadow-inner rounded-xl transition-all ease-in-out group-hover:duration-1000 duration-1000 w-44 h-44"
                    ></div>
                    <div
                        class="group-hover:-left-2 bg-transparent -top-24 -left-12 absolute shadow-sky-800 shadow-inner rounded-xl transition-all ease-in-out group-hover:duration-1000 duration-1000 w-64 h-64"
                    ></div>
                    <div
                        class="group-hover:top-44 bg-transparent top-24 left-12 absolute shadow-sky-500 shadow-inner rounded-xl transition-all ease-in-out group-hover:duration-1000 duration-1000 w-4 h-4"
                    ></div>
                    <div
                        class="w-full h-full shadow-xl shadow-neutral-900 p-3 bg-snow dark:bg-oynx opacity-60 rounded-xl flex-col gap-2 flex justify-center"
                    >
                        <span class="text-neutral-50 font-bold text-xl italic"
                            >Get Paid</span
                        >
                        <p class="text-oynx dark:text-snow">
                            Accept the order, prepare the meal, and deliver it –
                            get paid once the customer confirms receiving it
                        </p>
                    </div>
                </div>
            </div>
        </div>
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
<!-- Saving for later -->
<!-- "Indulge your taste buds and unlock a world of culinary delights with our platform, where passionate home chefs transform ordinary ingredients into extraordinary experiences. From tantalizing dishes to mouthwatering desserts, our community of food artisans invites you to savor their creations and bring the flavors of the world into your home. Whether you're seeking a gourmet feast for a special occasion or craving everyday comfort food made with love, discover your perfect match among our talented cooks who are ready to turn your cravings into unforgettable culinary adventures." -->

<style scoped>
.card {
    position: relative;
   
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    perspective: 1000px;
    /* box-shadow: 0 0 0 5px #ffffff80; */
    transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.card svg {
    width: 48px;
    fill: #333;
    transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.card:hover {
    box-shadow: 0 8px 16px rgba(255, 255, 255, 0.2);
}

.card__content {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    padding: 20px;
    box-sizing: border-box;
    background-color: #f2f2f2;
    transform: rotateX(-90deg);
    transform-origin: bottom;
    transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.card:hover .card__content {
    transform: rotateX(0deg);
}

.card__title {
    margin: 0;
    font-size: 24px;
    color: #333;
    font-weight: 700;
}

.card:hover svg {
    scale: 0;
}

.card__description {
    margin: 10px 0 0;
    font-size: 14px;
    color: #777;
    line-height: 1.4;
}

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
    content: "Monetize Your Passion";
    height: 50px;
    width: 165px;
    background-color: #1b998b;
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
    content: "Start Cooking Today";
    height: 50px;
    width: 165px;
    /* background-color: #fff; */
    color: #1b998b;
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
</style>
