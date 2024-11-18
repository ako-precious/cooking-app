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
                class="m-auto flex flex-col justify-center h-full p-6 lg:pb-20 w-full"
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
                                    You have meal(s) in your
                                    menu
                                </h1>
                            </div>
                            <div
                                class="flex flex-wrap md:flex-row items-start justify-between md:items-center"
                            >
                                <div class="p-2 flex">
                                    <Link :href="`/become-a-cook/overview`">
                                        <button
                                            class="shadow-extra-small rounded-md cursor-pointer w-[150px] h-[50px] text-oynx dark:text-snow font-semibold border-none flex justify-center items-center"
                                        >
                                            <span
                                                class="span-mother flex overflow-hidden"
                                            >
                                                <span>Cr</span>
                                                <span>ea</span>
                                                <span>t</span>
                                                <span> e M</span>
                                                <span>ea</span>
                                                <span
                                                    >l
                                                    <font-awesome-icon
                                                        icon="plus"
                                                /></span>
                                            </span>
                                            <span
                                                class="span-mother2 text-persian"
                                            >
                                                <span>Cr</span>
                                                <span>ea</span>
                                                <span>t</span>
                                                <span> e M</span>
                                                <span>ea</span>
                                                <span
                                                    >l
                                                    <font-awesome-icon
                                                        icon="plus"
                                                /></span>
                                            </span></button
                                    ></Link>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>

            <div
        class="container p-4 lg:p-10 mx-auto relative grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 sm:items-center min-h-screen selection:bg-red-500 selection:text-white bg-snow dark:bg-oynx"
    >
        <div v-for="meal in meals" :key="meal.id" class="animate-fade-in"> 

            <FoodCard :meal="meal"></FoodCard>
        </div>
    </div>
    <div
        class="flex justify-center items-center flex-col transition-all duration-250 delay-75 ease-bounce sha"
        v-if="hasMoreData"
    >
        <button @click="loadMoreData" class="button">Show More</button>
    </div>
    <!-- {{ $page.props.auth.user }} -->
   
    <Footer></Footer>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    
    
};
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
