<script setup>
import { Head, Link } from "@inertiajs/vue3";

import Footer from "@/Layouts/Footer.vue";
import HeaderVue from "../Header.vue";
</script>

<template>
    <Head title="Menu" />
    <div
        class="relative sm:flex sm:justify-center sm:items-center bg-center bg-snow dark:bg-oynx selection:bg-red-500 selection:text-white"
    >
        <div class="container relative mx-auto overflow-hidden">
            <HeaderVue> </HeaderVue>

            <div
                class="m-auto flex flex-col justify-center h-full p-6 lg:pb-10 w-full"
            >
                <div class="lg:w-full">
                    <div class="flex flex-col w-full">
                        <div
                            class="flex flex-col md:flex-row items-start justify-between md:items-center"
                        >
                            <div class="py-3">
                                <h1
                                    class="font-semibold text-xl lg:text-2xl text-oynx dark:text-snow"
                                >
                                    <nav class="flex" aria-label="Breadcrumb">
                                        <ol
                                            class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse"
                                        >
                                            <li
                                                class="inline-flex items-center"
                                            >
                                                <a
                                                    href="#"
                                                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white"
                                                >
                                                    <svg
                                                        class="w-3 h-3 me-2.5"
                                                        aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor"
                                                        viewBox="0 0 20 20"
                                                    >
                                                        <path
                                                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"
                                                        />
                                                    </svg>
                                                    Resources
                                                </a>
                                            </li>
                                            <li>
                                                <div class="flex items-center">
                                                    <svg
                                                        class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1"
                                                        aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 6 10"
                                                    >
                                                        <path
                                                            stroke="currentColor"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="m1 9 4-4-4-4"
                                                        />
                                                    </svg>
                                                    <a
                                                        href="#"
                                                        class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white"
                                                        >General</a
                                                    >
                                                </div>
                                            </li>
                                            <li aria-current="page">
                                                <div class="flex items-center">
                                                    <svg
                                                        class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1"
                                                        aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 6 10"
                                                    >
                                                        <path
                                                            stroke="currentColor"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="m1 9 4-4-4-4"
                                                        />
                                                    </svg>
                                                    <span
                                                        class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400"
                                                        >Return Policy
                                                    </span>
                                                </div>
                                            </li>
                                        </ol>
                                    </nav>
                                </h1>
                            </div>
                            <div
                                class="flex flex-wrap md:flex-row items-start justify-between md:items-center"
                            ></div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="container p-4 lg:p-8 mx-auto relative grid grid-cols-1 lg:grid-cols-3 min-h-screen selection:bg-red-500 selection:text-white bg-snow dark:bg-oynx"
            >
                <div class="col-span-2">
                    <div class="py-3">
                        <h1
                            class="font-semibold text-2xl lg:text-5xl text-oynx dark:text-snow"
                        >
                            Why Our Return Policy Exists
                        </h1>
                    </div>
                    <div class="py-3">
                        <h1 class="text-sm opacity-70 text-oynx flex justify-between dark:text-snow">
                           <span> By Airbnb on Dec 18, 2019 </span> <span>3 min read </span> 
                        </h1>
                        <h1 class="text-sm py-2 italic opacity-65 text-oynx dark:text-snow">
Updated Sep 2, 2021
                        </h1>
                    </div>
                    <div class="py-3 h-96 max-w-full overflow-y-scroll disable-scrollbars">
                        <!-- class="relative object-cover  transition-all duration-[0.8s]  group-hover:left-0" -->
                        <img
                     class="w-full h-auto"
                    src="/images/cook.png"
                    alt=""
                />
                    </div>
                    
                    <div class="py-3">
                        <h1 class="text-lg text-oynx dark:text-snow">
                            At Ounjemi, we are committed to ensuring every meal
                            shared through our platform brings joy and
                            satisfaction. Our return policy is designed to
                            address any concerns you may have, uphold the
                            quality of our services, and maintain trust between
                            cooks and customers.
                            <br /><br />
                            <span class="font-semibold text-xl">
                                Our Core Values </span
                            ><br /><br />
                            <ul>
                                <li>
                                    <b> Fairness: </b> We believe in creating a
                                    balanced system that protects both our cooks
                                    and customers.
                                </li>
                                <li>
                                    <b>Transparency:</b> Clear and honest
                                    communication is at the heart of our return
                                    process.
                                </li>
                                <li>
                                    <b>Customer Satisfaction: </b> Your
                                    happiness matters to us, and we aim to make
                                    every experience a positive one.
                                </li>
                                <li>
                                    <br /><br />
                                    This policy reflects our dedication to
                                    creating a platform where homemade meals are
                                    enjoyed with confidence and peace of mind.
                                </li>
                            </ul>
                        </h1>
                    </div>
                </div>
            </div>

            <!-- {{ $page.props.auth.user }} -->

        </div>
    </div>
    <Footer></Footer>
</template>

<script>
import axios from "axios";

export default {};
</script>

<style scoped>
button:hover .span-mother {
    position: absolute;
}

button:hover .span-mother span {
    transform: translateY(1.3em);
}

button .span-mother span:nth-child(1) {
    transition: 0.2s;
}

button .span-mother span:nth-child(2) {
    transition: 0.3s;
}

button .span-mother span:nth-child(3) {
    transition: 0.4s;
}

button .span-mother span:nth-child(4) {
    transition: 0.5s;
}

button .span-mother span:nth-child(5) {
    transition: 0.6s;
}

button .span-mother span:nth-child(6) {
    transition: 0.7s;
}
button .span-mother2 {
    display: flex;
    position: absolute;
    overflow: hidden;
}

button .span-mother2 span {
    transform: translateY(-1.5em);
}

button:hover .span-mother2 span {
    transform: translateY(0);
}

button .span-mother2 span {
    transition: 0.2s;
}

button .span-mother2 span:nth-child(2) {
    transition: 0.3s;
}

button .span-mother2 span:nth-child(3) {
    transition: 0.4s;
}

button .span-mother2 span:nth-child(4) {
    transition: 0.5s;
}

button .span-mother2 span:nth-child(5) {
    transition: 0.6s;
}

button .span-mother2 span:nth-child(6) {
    transition: 0.7s;
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
    animation: fade-in 0.5s ease-in;
}
</style>
