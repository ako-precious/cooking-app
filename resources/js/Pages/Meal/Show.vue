<script setup>
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-snow dark:bg-oynx selection:bg-red-500 selection:text-white"
    >
        <div class="container relative mx-auto overflow-hidden">
            <div
                class="m-auto flex flex-col justify-center h-full px-6 lg:px-8 lg:pb-20 w-full"
            >
                <div class="py-5">
                    <h1
                        class="font-semibold text-3xl lg:text-4xl text-oynx dark:text-snow"
                    >
                        Meal Title
                    </h1>
                </div>
                <div
                    class="flex flex-col lg:flex-row lg:h-[18rem] overflow-scroll disable-scrollbars"
                >
                    <div class="lg:w-1/2">
                        <div class="overflow-hidden">
                            <img
                                class="h-auto max-w-full rounded-lg"
                                src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image.jpg"
                                alt=""
                            />
                        </div>
                    </div>
                    <div
                        class="lg:w-1/2 px-4 grid grid-cols-2 md:grid-cols-3 gap-4"
                    >
                        <div class="grid gap-4">
                            <div
                                class="overflow-scroll disable-scrollbars rounded-lg"
                            >
                                <img
                                    class="h-auto max-w-full rounded-lg"
                                    src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image.jpg"
                                    alt=""
                                />
                            </div>
                            <div
                                class="overflow-scroll disable-scrollbars rounded-lg"
                            >
                                <img
                                    class="h-auto max-w-full rounded-lg"
                                    src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-1.jpg"
                                    alt=""
                                />
                            </div>
                            <div
                                class="overflow-scroll disable-scrollbars rounded-lg"
                            >
                                <img
                                    class="h-auto max-w-full rounded-lg"
                                    src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-2.jpg"
                                    alt=""
                                />
                            </div>
                        </div>
                        <div class="grid gap-4">
                            <div
                                class="overflow-scroll disable-scrollbars rounded-lg"
                            >
                                <img
                                    class="h-auto max-w-full rounded-lg"
                                    src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-3.jpg"
                                    alt=""
                                />
                            </div>
                            <div
                                class="overflow-scroll disable-scrollbars rounded-lg"
                            >
                                <img
                                    class="h-auto max-w-full rounded-lg"
                                    src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-4.jpg"
                                    alt=""
                                />
                            </div>
                            <div
                                class="overflow-scroll disable-scrollbars rounded-lg"
                            >
                                <img
                                    class="h-auto max-w-full rounded-lg"
                                    src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-5.jpg"
                                    alt=""
                                />
                            </div>
                        </div>
                        <div class="grid gap-4">
                            <div
                                class="overflow-scroll disable-scrollbars rounded-lg"
                            >
                                <img
                                    class="h-auto max-w-full rounded-lg"
                                    src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-6.jpg"
                                    alt=""
                                />
                            </div>
                            <div
                                class="overflow-scroll disable-scrollbars rounded-lg"
                            >
                                <img
                                    class="h-auto max-w-full rounded-lg"
                                    src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-7.jpg"
                                    alt=""
                                />
                            </div>
                            <div
                                class="overflow-scroll disable-scrollbars rounded-lg"
                            >
                                <img
                                    class="h-auto max-w-full rounded-lg"
                                    src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-8.jpg"
                                    alt=""
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:w-full py-8">
                    <div class="flex flex-col w-full">
                        <div class="lg:w-1/2">

                       
                        <div class="flex items-center py-5">
                            <font-awesome-icon
                                icon="user"
                                class="mr-5 p-2 bg-oynx text-snow rounded-full"
                            />
                            <h1
                                class="font-semibold text-xl text-oynx dark:text-snow"
                            >
                                Cooked by Ako Precious
                            </h1>
                        </div>
                        <hr
                            class="h-px mb-2 bg-transparent bg-gradient-to-r from-transparent via-oynx/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-snow dark:to-transparent"
                        />
                        <div class="flex flex-col py-8">
                           
                            <h1
                                class="text-lg text-oynx dark:text-snow"
                            >
                            This meal is popular in certain regions of Africa </h1>
                        </div>
                        
                        <hr
                            class="h-px mb-2 bg-transparent bg-gradient-to-r from-transparent via-oynx/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-snow dark:to-transparent"
                        />
                        <div class="flex flex-col py-8">
                            <h1
                                class="font-semibold text-2xl lg:text-3xl pb-4 text-oynx dark:text-snow"
                            >
                                About the meal
                            </h1>
                            <h1
                                class="text-lg text-oynx dark:text-snow"
                            >
                              Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas molestiae omnis eligendi excepturi asperiores porro, necessitatibus iusto? Consequuntur sequi, veniam veritatis, accusantium tempora ipsam placeat quo asperiores error, adipisci dignissimos!
                            </h1>
                        </div>
                        <hr
                            class="h-px mb-2 bg-transparent bg-gradient-to-r from-transparent via-oynx/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-snow dark:to-transparent"
                        />
                        <div class="py-5">
                            <h1
                            class="font-semibold text-2xl lg:text-3xl text-oynx dark:text-snow"
                            >
                            Ingredients
                        </h1>
                        <ul>
                            <li>jk</li>
                            <li>jk</li>
                            <li>jk</li>
                            <li>jk</li>
                        </ul>
                    </div>
                    <hr
                        class="h-px mb-2 bg-transparent bg-gradient-to-r from-transparent via-oynx/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-snow dark:to-transparent"
                    />
                       </div>  
                       <div   class="lg:w-1/2">
                        
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    props: {
        menu: Object,
    },
    created() {
        this.FormattedDate();
    },
    methods: {
        FormattedDate(timestamp) {
            const date = new Date(timestamp);
            const formattedDate = `${date.getFullYear()}-${(date.getMonth() + 1)
                .toString()
                .padStart(2, "0")}-${date
                .getDate()
                .toString()
                .padStart(2, "0")} at ${date.getHours()}:${date
                .getMinutes()
                .toString()
                .padStart(2, "0")}`;
            return formattedDate;
        },
    },
};
</script>

<style scoped>
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
