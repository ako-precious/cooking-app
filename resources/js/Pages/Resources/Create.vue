<script setup>
import { Head, Link } from "@inertiajs/vue3";

import Footer from "@/Layouts/Footer.vue";

import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import HeaderVue from "./Header.vue";
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
                <div class="col-span-2"><div class="lg:w-full">
                        <div class="flex flex-col w-full">
                            <div
                                class="flex justify-center item-center lg:gap-10 lg:px-10"
                            >
                                <div class="w-full max-w-full py-2">
                                    <form
                                        class="relative flex min-w-0 break-words w-full py-4 shadow-reverse group rounded-2xl bg-clip-border"
                                    >
                                        <div
                                            class="m-auto flex lg:flex-col justify-center flex-wrap w-full p-4 mb-0 list-none rounded-xl"
                                        >
                                            <div class="py-5 w-full px-1">
                                                <InputLabel
                                                    for="name"
                                                    value="Meal Title (Limit 50 char)"
                                                />
                                                <TextInput
                                                    id="name"
                                                  
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    required
                                                    autocomplete="name"
                                                />
                                              
                                            </div>
                                            <div class="py-5 w-full px-1">
                                                <InputLabel
                                                    for="name"
                                                    value="Meal Title (Limit 50 char)"
                                                />
                                                <TextInput
                                                    id="name"
                                                  
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    required
                                                    autocomplete="name"
                                                />
                                              
                                            </div>
                                            <div class="py-5 px-1">
                                                <InputLabel
                                                    for="name"
                                                    value="Meal Description (Limit 600 char)"
                                                />

                                                <textarea @input="checkLength"
                                                    autocomplete="other_info"
                                                    id="other_info"
                                                   
                                                    class="mt-1 block w-full disable-scrollbars border-oynx bg-gradient-to-br from-[#e3dedf] to-[#ffffff] shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] focus:shadow-none dark:focus:shadow-none dark:shadow-oynx-sm dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred rounded-md text-oynx dark:text-snow"
                                                    rows="5"
                                                    cols="50"
                                                ></textarea>
                                                
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
