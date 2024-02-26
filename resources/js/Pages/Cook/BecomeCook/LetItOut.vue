<script setup>
import { Head, Link } from "@inertiajs/vue3";

import BecomeCook from "./BecomeCook.vue";
</script>

<template>
    <BecomeCook>
        <template #info>
            <div class="container relative mx-auto overflow-hidden w-screen">
                <div
                    class="m-auto flex flex-col lg:flex-row items-center h-full px-6 lg:p-8"
                >
                    <div class="lg:w-1/2 py-5 lg:px-5">
                        <h1
                            class="pb-3 font-semibold text-sm lg:text-base tracking-wide text-oynx dark:text-snow"
                        >
                            Phase 3
                        </h1>
                        <h1
                            class="font-semibold text-3xl lg:text-4xl tracking-wide text-oynx dark:text-snow"
                        >
                        Get the meal out there
                        </h1>
                        <h1
                            class="pt-5 lg:text-lg  text-oynx dark:text-snow"
                        >
                        Get your aprons tightened!  Final step: personalize ordering preferences, set your price point, and proudly publish your meal for eager foodies to discover.
                        </h1>
                    </div>
                    <div class="lg:w-1/2">
                        <div class="flex flex-col w-full">
                            <div class="flex lg:p-5">
                                <div class="w-2/3 p-3 lg:p-10 ml-8">
                                    <img
                                        class=""
                                        src="/images/getitout.jpg"
                                        alt=""
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template #progressbar>
            <div class="h-1 w-full bg-neutral-400 dark:bg-neutral-600">
                <div
                    class="h-1 bg-persian transition-all duration-250 delay-75"
                    style="width: 58%"
                ></div>
            </div>
        </template>
        <template #backbtn>
            <div class="float-left ml-8 h-full flex items-center">
                <Link :href="`/become-a-cook/${Meal.id}/photos`" class="font-semibold">
                    <button class="relative group">
                        <span
                            class="hover-underline-animation"
                        >
                            Back
                        </span>
                    </button>
                </Link>
            </div>
        </template>
        <template #mainbtn>
            <Link :href="`/become-a-cook/${Meal.id}/ordering-preference`" class="float-right mr-8">
                <button  class="btn2span group">
                    <span class="next-span">Next Step</span>
                    <span class="with-span">We're with you</span>
                </button> </Link
        ></template>
    </BecomeCook>
</template>
<script>

export default {
    props: {
    Meal: Object,
  }, 
    
}
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
    animation: fade-in 0.7s ease-in;
}
</style>
