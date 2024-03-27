<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Card from "./Card.vue";
</script>

<template>
    <Head title="Become A Cook" />

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
        <div
            class="grid grid-rows-6 grid-flow-col gap-5 auto-cols-fr md:px-6 lg:p-8"
        >
            <div class="row-span-4 shadow-extra-small rounded-3">
                <div class="card h-full rounded-3">
                    <img class="h-full" src="/images/ordering.jpeg" alt="" />
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
            <div
                class="col-start-2 col-end-4 row-span-2 h-50 shadow-extra-small rounded-3 ..."
            >
                <div class="animated-button transition-all duration-[0.6s] h-full w-full flex relative items-center justify-start cursor-pointer overflow-hidden group ">
                    <img class="h-full absolute z-[9] transition-all duration-[0.8s] right-0 group-hover:-right-1/2" src="/images/cook.png" alt="" />
                    <span class="text p-8 text-oynx dark:text-snow"
                        >Remember to check the date of the confirmed orders. Prepare each dish by the customer's selected date. Don't forget to let them know when their food is prepared!.</span
                    >
                    <span class="circle bg-polynesian dark:bg-lighred absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-full transition-all duration-[0.8s] opacity-0 "></span>
                    <img class="h-full  absolute z-[9] transition-all duration-[0.8s] -left-1/2 group-hover:left-0" src="/images/cook.png" alt="" />
                </div>
            </div>
            <div
                class="row-start-3 h-[420px] row-end-7 shadow-extra-small rounded-3 ..."
            >
                <Card></Card>
            </div>
            <div
                class="row-start-5 row-end-7 col-start-1 col-end-3 h-50 shadow-extra-small rounded-3 ..."
            >
                <div class="card h-full rounded-3">
                    <img class="h-full" src="/images/deliver.png" alt="" />
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

            <div
                class="col-start-2 col-end-3 row-span-2 shadow-extra-small rounded-3 ..."
            >
                <div
                    class="cursor-pointer group overflow-hidden p-5 duration-1000 hover:duration-1000 relative h-full w4 mx-auto rounded-xl"
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

<style scoped>


.animated-button .text {
    position: relative;
    width: 60%;
    z-index: 1;
    transform: translateX(-12px);
    transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
}

.animated-button:hover {
    box-shadow: 0 0 0 12px transparent;
    border-radius: 12px;
    justify-content: end;
}


.animated-button:hover .text {
    transform: translateX(12px);
    float: right;

}

.animated-button:hover .circle {
    width: 220px;
    height: 220px;
    opacity: 1;
}

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
</style>
