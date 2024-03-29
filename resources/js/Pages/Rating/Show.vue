<script setup>
import { Head, Link } from "@inertiajs/vue3";
import axios from "axios";


</script>

<template>
           <div>

            <div
                class="flex flex-wrap md:grid grid-rows-3 grid-flow-col gap-5 auto-cols-fr md:px-6 lg:p-8"
            > <div
                    class="w-full col-start-2 col-end-3 row-span-3 shadow-extra-small rounded-3 ..."
                >
                    <div
                        class="cursor-pointer group overflow-hidden  p-5 duration-1000 hover:duration-1000 relative h-full w4 mx-auto rounded-xl"
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
                            class="w-full h-full shadow-xl shadow-neutral-900 p-5 bg-snow dark:bg-oynx opacity-60 rounded-xl flex-col gap-2 flex justify-center"
                        >
                            <div class="flex flex-col ">
                                <div>
                                    <h1
                                        class="font-bold text-lg lg:text-xl text-oynx dark:text-snow"
                                    >
                                        Overall Rating
                                    </h1>
                                </div>
                                <div class="flex flex-wrap items-center my-3">
                                    <div class="flex items-center my-3">
                                        
                                        <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-lg"
                                        />
                                        <p
                                        class="ms-2 text-lg font-extrabold text-gray-900 dark:text-white"
                                        >
                                        4.95
                                    </p>
                                </div>
                                    <span
                                        class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full dark:bg-gray-400"
                                    ></span>
                                    <a
                                        href="#"
                                        class="text-lg font-bold text-gray-900 underline hover:no-underline dark:text-white"
                                        >73 reviews</a
                                    >
                                </div>
                                <div>
                                    <div class="flex items-center">
                                        <a
                                            href="#"
                                            class="text-sm font-medium text-oynx dark:text-snow "
                                            >5</a
                                        >
                                        <div
                                            class="w-2/4 h-1 mx-4 bg-oynx rounded dark:bg-snow"
                                        >
                                            <div
                                                class="h-1 bg-persian rounded"
                                                style="width: 70%"
                                            ></div>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <a
                                            href="#"
                                            class="text-sm font-medium text-oynx dark:text-snow "
                                            >4</a
                                        >
                                        <div
                                            class="w-2/4 h-1 mx-4 bg-oynx rounded dark:bg-snow"
                                        >
                                            <div
                                                class="h-1 bg-persian rounded"
                                                style="width: 17%"
                                            ></div>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <a
                                            href="#"
                                            class="text-sm font-medium text-oynx dark:text-snow "
                                            >3</a
                                        >
                                        <div
                                            class="w-2/4 h-1 mx-4 bg-oynx rounded dark:bg-snow"
                                        >
                                            <div
                                                class="h-1 bg-persian rounded"
                                                style="width: 8%"
                                            ></div>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <a
                                            href="#"
                                            class="text-sm font-medium text-oynx dark:text-snow "
                                            >2</a
                                        >
                                        <div
                                            class="w-2/4 h-1 mx-4 bg-oynx rounded dark:bg-snow"
                                        >
                                            <div
                                                class="h-1 bg-persian rounded"
                                                style="width: 4%"
                                            ></div>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <a
                                            href="#"
                                            class="text-sm font-medium text-oynx dark:text-snow "
                                            >1</a
                                        >
                                        <div
                                            class="w-2/4 h-1 mx-4 bg-oynx rounded dark:bg-snow"
                                        >
                                            <div
                                                class="h-1 bg-persian rounded"
                                                style="width: 1%"
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-span-1 rounded-3">
                    <div class="h-full m-auto lg:w-1/2 rounded-3 group">
                        <div class="flex items-center">
                            <img
                                class="w-[2rem] h-[2rem] lg:w-[3rem] lg:h-[3rem] mr-3"
                                src="/images/package.png"
                                alt="ingredients"
                            />

                            <div>
                                <h1
                                    class="font-semibold text-lg lg:text-xl text-oynx dark:text-snow"
                                >
                                    Package
                                </h1>
                                <p
                                    class="font-bold text-sm lg:text-base text-oynx dark:text-snow"
                                >
                                    4.0
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-span-1 rounded-3">
                    <div class="h-full m-auto lg:w-1/2 rounded-3 group">
                        <div class="flex items-center">
                            <img
                                class="w-[2rem] h-[2rem] lg:w-[3rem] lg:h-[3rem] mr-3"
                                src="/images/freshness.png"
                                alt="ingredients"
                            />

                            <div>
                                <h1
                                    class="font-semibold text-lg lg:text-xl text-oynx dark:text-snow"
                                >
                                    Freshness
                                </h1>
                                <p
                                    class="font-bold text-sm lg:text-base text-oynx dark:text-snow"
                                >
                                    4.0
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-span-1 rounded-3">
                    <div class="h-full m-auto lg:w-1/2 rounded-3 group">
                        <div class="flex items-center">
                            <img
                                class="w-[2rem] h-[2rem] lg:w-[3rem] lg:h-[3rem] mr-3"
                                src="/images/taste.png"
                                alt="ingredients"
                            />

                            <div>
                                <h1
                                    class="font-semibold text-lg lg:text-xl text-oynx dark:text-snow"
                                >
                                    Taste
                                </h1>
                                <p
                                    class="font-bold text-sm lg:text-base text-oynx dark:text-snow"
                                >
                                    4.0
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row-span-1 rounded-3">
                    <div class="h-full m-auto lg:w-1/2 rounded-3 group">
                        <div class="flex items-center">
                            <img
                                class="w-[2rem] h-[2rem] lg:w-[3rem] lg:h-[3rem] mr-3"
                                src="/images/nutrition.png"
                                alt="ingredients"
                            />

                            <div>
                                <h1
                                    class="font-semibold text-lg lg:text-xl text-oynx dark:text-snow"
                                >
                                    Nutrition
                                </h1>
                                <p
                                    class="font-bold text-sm lg:text-base text-oynx dark:text-snow"
                                >
                                    4.0
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-span-1 rounded-3">
                    <div class="h-full m-auto lg:w-1/2 rounded-3 group">
                        <div class="flex items-center">
                            <img
                                class="w-[2rem] h-[2rem] lg:w-[3rem] lg:h-[3rem] mr-3"
                                src="/images/portionsize.png"
                                alt="ingredients"
                            />

                            <div>
                                <h1
                                    class="font-semibold text-lg lg:text-xl text-oynx dark:text-snow"
                                >
                                    Quantity
                                </h1>
                                <p
                                    class="font-bold text-sm lg:text-base text-oynx dark:text-snow"
                                >
                                    4.0
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-span-1 rounded-3">
                    <div class="h-full m-auto lg:w-1/2 rounded-3 group">
                        <div class="flex items-center">
                            <img
                                class="w-[2rem] h-[2rem] lg:w-[3rem] lg:h-[3rem] mr-3"
                                src="/images/value.png"
                                alt="ingredients"
                            />

                            <div>
                                <h1
                                    class="font-semibold text-lg lg:text-xl text-oynx dark:text-snow"
                                >
                                    Value
                                </h1>
                                <p
                                    class="font-bold text-sm lg:text-base text-oynx dark:text-snow"
                                >
                                    4.0
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

               
            </div>
            <div class="flex flex-col py-6 overflow-scroll disable-scrollbars">
                <h1
                    class="font-semibold text-3xl text-center lg:text-4xl text-oynx dark:text-snow"
                >
                    No Reviews
                </h1>
            </div>

</div>
            
</template>

<script>
export default {
    inheritAttrs: false,
    props: {
        meal: Object,
    },
    data() {
        return {
          
            rating: [],
        };
    },
    created() {
        this.getRatings();
    },
    methods: {
       
        getRatings() {
            const mealId =  this.meal.id
        //    console.log( mealId); 
            axios
                .get("/rating/" + mealId)
                .then((response) => {
                  console.log(response)
                })
                .catch((error) => {
                    console.error("Error fetching data:", error);
                })
                .finally(() => {
                    // Set loading state to false when fetching completes
                    this.isLoading = false;
                });
        },
    },
};
</script>
