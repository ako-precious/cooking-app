<script setup>
import { Head, Link } from "@inertiajs/vue3";
import axios from "axios";
import RatingsCard from "./RatingsCard.vue";
</script>

<template>
    <div>
        <div v-if="rating">
            <div
                class="flex flex-wrap md:grid grid-rows-3 grid-flow-col gap-5 auto-cols-fr py-8 lg:p-8"
            >
                <div
                    class=" w-full col-start-2 col-end-3 row-span-3 shadow-extra-small rounded-3 ..."
                >
                    <div
                        class="cursor-pointer group overflow-hidden p-5 duration-1000 hover:duration-1000 relative h-full w4 mx-auto rounded-xl"
                    >
                        <div
                            class="w-full h-full shadow-xl shadow-neutral-900 p-5 bg-snow dark:bg-oynx opacity-60 rounded-xl flex-col gap-2 flex justify-center"
                        >
                            <div
                                class="flex justify-center items-center flex-col"
                            >
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
                                            {{ total }}
                                        </p>
                                    </div>
                                    <span
                                        class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full dark:bg-gray-400"
                                    ></span>
                                    <a
                                        href="#"
                                        class="font-bold text-gray-900 underline hover:no-underline dark:text-white"
                                    >
                                        {{ review }} review(s)</a
                                    >
                                </div>
                                <div class="w-full">
                                    <div
                                        class="flex justify-center items-center"
                                    >
                                        <a
                                            href="#"
                                            class="text-sm font-medium text-oynx dark:text-snow"
                                            >5</a
                                        >
                                        <div
                                            class="w-2/4 h-1 mx-4 bg-oynx rounded dark:bg-snow"
                                        >
                                            <div
                                                class="h-1 bg-persian rounded"
                                                :style="{
                                                    width:
                                                        ratingsPercentage['5'] +
                                                        '%',
                                                }"
                                            ></div>
                                        </div>
                                    </div>
                                    <div
                                        class="flex justify-center items-center"
                                    >
                                        <a
                                            href="#"
                                            class="text-sm font-medium text-oynx dark:text-snow"
                                            >4</a
                                        >
                                        <div
                                            class="w-2/4 h-1 mx-4 bg-oynx rounded dark:bg-snow"
                                        >
                                            <div
                                                class="h-1 bg-persian rounded"
                                                :style="{
                                                    width:
                                                        ratingsPercentage['4'] +
                                                        '%',
                                                }"
                                            ></div>
                                        </div>
                                    </div>
                                    <div
                                        class="flex justify-center items-center"
                                    >
                                        <a
                                            href="#"
                                            class="text-sm font-medium text-oynx dark:text-snow"
                                            >3</a
                                        >
                                        <div
                                            class="w-2/4 h-1 mx-4 bg-oynx rounded dark:bg-snow"
                                        >
                                            <div
                                                class="h-1 bg-persian rounded"
                                                :style="{
                                                    width:
                                                        ratingsPercentage['3'] +
                                                        '%',
                                                }"
                                            ></div>
                                        </div>
                                    </div>
                                    <div
                                        class="flex justify-center items-center"
                                    >
                                        <a
                                            href="#"
                                            class="text-sm font-medium text-oynx dark:text-snow"
                                            >2</a
                                        >
                                        <div
                                            class="w-2/4 h-1 mx-4 bg-oynx rounded dark:bg-snow"
                                        >
                                            <div
                                                class="h-1 bg-persian rounded"
                                                :style="{
                                                    width:
                                                        ratingsPercentage['2'] +
                                                        '%',
                                                }"
                                            ></div>
                                        </div>
                                    </div>
                                    <div
                                        class="flex justify-center items-center"
                                    >
                                        <a
                                            href="#"
                                            class="text-sm font-medium text-oynx dark:text-snow"
                                            >1</a
                                        >
                                        <div
                                            class="w-2/4 h-1 mx-4 bg-oynx rounded dark:bg-snow"
                                        >
                                            <div
                                                class="h-1 bg-persian rounded"
                                                :style="{
                                                    width:
                                                        ratingsPercentage['1'] +
                                                        '%',
                                                }"
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <RatingsCard>
                    <template #img
                        ><img
                            class="w-[2rem] h-[2rem] lg:w-[3rem] lg:h-[3rem] mr-3"
                            src="/images/package.png"
                            alt="ingredients"
                    /></template>
                    <template #title>Package</template>
                    <template #rating>{{ presentation }}</template>
                </RatingsCard>
                <RatingsCard>
                    <template #img
                        ><img
                            class="w-[2rem] h-[2rem] lg:w-[3rem] lg:h-[3rem] mr-3"
                            src="/images/freshness.png"
                            alt="ingredients"
                    /></template>
                    <template #title>Freshness</template>
                    <template #rating>{{ freshness }}</template>
                </RatingsCard>
                <RatingsCard>
                    <template #img
                        ><img
                            class="w-[2rem] h-[2rem] lg:w-[3rem] lg:h-[3rem] mr-3"
                            src="/images/taste.png"
                            alt="ingredients"
                    /></template>
                    <template #title>Taste</template>
                    <template #rating>{{ taste }}</template>
                </RatingsCard>
                <RatingsCard>
                    <template #img
                        ><img
                            class="w-[2rem] h-[2rem] lg:w-[3rem] lg:h-[3rem] mr-3"
                            src="/images/nutrition.png"
                            alt="ingredients"
                    /></template>
                    <template #title>Nutrition</template>
                    <template #rating>{{ nutrition }}</template>
                </RatingsCard>
                <RatingsCard>
                    <template #img
                        ><img
                            class="w-[2rem] h-[2rem] lg:w-[3rem] lg:h-[3rem] mr-3"
                            src="/images/portionsize.png"
                            alt="ingredients"
                    /></template>
                    <template #title>Quantity</template>
                    <template #rating>{{ portion_size }}</template>
                </RatingsCard>
                <RatingsCard>
                    <template #img
                        ><img
                            class="w-[2rem] h-[2rem] lg:w-[3rem] lg:h-[3rem] mr-3"
                            src="/images/value.png"
                            alt="ingredients"
                    /></template>
                    <template #title>Value</template>
                    <template #rating>{{ value }}</template>
                </RatingsCard>
            </div>
            <hr
                class="h-px mb-2 bg-transparent bg-gradient-to-r from-transparent via-oynx/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-snow dark:to-transparent"
            />
            <div
                class="grid overflow-y-scroll max-h-[300px] lg:max-h-[500px] grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-1 auto-cols-fr md:px-6 lg:p-8"
            >
                <!--Background-->
                <div class="col-span-1 rounded-3">
                    <div class="m-4 block rounded-lg">
                        <!--Testimonial-->
                        <div class="md:flex md:flex-row">
                            <div
                                class="mx-auto mb-6 flex flex-col w-36 md:mx-0 md:w-96 lg:mb-0"
                            >
                                <img
                                    src="https://tecdn.b-cdn.net/img/Photos/Avatars/img%20%2810%29.jpg"
                                    class="rounded-full shadow-md dark:shadow-black/30"
                                    alt="woman avatar"
                                />
                                <div class="flex items-center my-3">
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                </div>
                                <p
                                    class="mb-2 text-xs font-bold text-oynx dark:text-snow"
                                >
                                    Three weeks age
                                </p>
                            </div>
                            <div class="md:ms-4 flex-col">
                                <p
                                    class="mb-6 text-base font-light text-oynx dark:text-snow"
                                >
                                    Lorem ipsum dolor, sit amet consectetur
                                    adipisicing elit. Id quam sapiente molestiae
                                    numquam quas, voluptates omnis nulla ea odio
                                    quia similique corrupti magnam.
                                </p>
                                <p
                                    class="mb-2 text-base font-bold text-oynx dark:text-snow"
                                >
                                    Anna Smith
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-1 rounded-3">
                    <div class="m-4 block rounded-lg">
                        <!--Testimonial-->
                        <div class="md:flex md:flex-row">
                            <div
                                class="mx-auto mb-6 flex flex-col w-36 md:mx-0 md:w-96 lg:mb-0"
                            >
                                <img
                                    src="https://tecdn.b-cdn.net/img/Photos/Avatars/img%20%2810%29.jpg"
                                    class="rounded-full shadow-md dark:shadow-black/30"
                                    alt="woman avatar"
                                />
                                <div class="flex items-center my-3">
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                </div>
                                <p
                                    class="mb-2 text-xs font-bold text-oynx dark:text-snow"
                                >
                                    Three weeks age
                                </p>
                            </div>
                            <div class="md:ms-4 flex-col">
                                <p
                                    class="mb-6 text-base font-light text-oynx dark:text-snow"
                                >
                                    Lorem ipsum dolor, sit amet consectetur
                                    adipisicing elit. Id quam sapiente molestiae
                                    numquam quas, voluptates omnis nulla ea odio
                                    quia similique corrupti magnam.
                                </p>
                                <p
                                    class="mb-2 text-base font-bold text-oynx dark:text-snow"
                                >
                                    Anna Smith
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-1 rounded-3">
                    <div class="m-4 block rounded-lg">
                        <!--Testimonial-->
                        <div class="md:flex md:flex-row">
                            <div
                                class="mx-auto mb-6 flex flex-col w-36 md:mx-0 md:w-96 lg:mb-0"
                            >
                                <img
                                    src="https://tecdn.b-cdn.net/img/Photos/Avatars/img%20%2810%29.jpg"
                                    class="rounded-full shadow-md dark:shadow-black/30"
                                    alt="woman avatar"
                                />
                                <div class="flex items-center my-3">
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                </div>
                                <p
                                    class="mb-2 text-xs font-bold text-oynx dark:text-snow"
                                >
                                    Three weeks age
                                </p>
                            </div>
                            <div class="md:ms-4 flex-col">
                                <p
                                    class="mb-6 text-base font-light text-oynx dark:text-snow"
                                >
                                    Lorem ipsum dolor, sit amet consectetur
                                    adipisicing elit. Id quam sapiente molestiae
                                    numquam quas, voluptates omnis nulla ea odio
                                    quia similique corrupti magnam.
                                </p>
                                <p
                                    class="mb-2 text-base font-bold text-oynx dark:text-snow"
                                >
                                    Anna Smith
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-1 rounded-3">
                    <div class="m-4 block rounded-lg">
                        <!--Testimonial-->
                        <div class="md:flex md:flex-row">
                            <div
                                class="mx-auto mb-6 flex flex-col w-36 md:mx-0 md:w-96 lg:mb-0"
                            >
                                <img
                                    src="https://tecdn.b-cdn.net/img/Photos/Avatars/img%20%2810%29.jpg"
                                    class="rounded-full shadow-md dark:shadow-black/30"
                                    alt="woman avatar"
                                />
                                <div class="flex items-center my-3">
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                </div>
                                <p
                                    class="mb-2 text-xs font-bold text-oynx dark:text-snow"
                                >
                                    Three weeks age
                                </p>
                            </div>
                            <div class="md:ms-4 flex-col">
                                <p
                                    class="mb-6 text-base font-light text-oynx dark:text-snow"
                                >
                                    Lorem ipsum dolor, sit amet consectetur
                                    adipisicing elit. Id quam sapiente molestiae
                                    numquam quas, voluptates omnis nulla ea odio
                                    quia similique corrupti magnam.
                                </p>
                                <p
                                    class="mb-2 text-base font-bold text-oynx dark:text-snow"
                                >
                                    Anna Smith
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-1 rounded-3">
                    <div class="m-4 block rounded-lg">
                        <!--Testimonial-->
                        <div class="md:flex md:flex-row">
                            <div
                                class="mx-auto mb-6 flex flex-col w-36 md:mx-0 md:w-96 lg:mb-0"
                            >
                                <img
                                    src="https://tecdn.b-cdn.net/img/Photos/Avatars/img%20%2810%29.jpg"
                                    class="rounded-full shadow-md dark:shadow-black/30"
                                    alt="woman avatar"
                                />
                                <div class="flex items-center my-3">
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                </div>
                                <p
                                    class="mb-2 text-xs font-bold text-oynx dark:text-snow"
                                >
                                    Three weeks age
                                </p>
                            </div>
                            <div class="md:ms-4 flex-col">
                                <p
                                    class="mb-6 text-base font-light text-oynx dark:text-snow"
                                >
                                    Lorem ipsum dolor, sit amet consectetur
                                    adipisicing elit. Id quam sapiente molestiae
                                    numquam quas, voluptates omnis nulla ea odio
                                    quia similique corrupti magnam.
                                </p>
                                <p
                                    class="mb-2 text-base font-bold text-oynx dark:text-snow"
                                >
                                    Anna Smith
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-1 rounded-3">
                    <div class="m-4 block rounded-lg">
                        <!--Testimonial-->
                        <div class="md:flex md:flex-row">
                            <div
                                class="mx-auto mb-6 flex flex-col w-36 md:mx-0 md:w-96 lg:mb-0"
                            >
                                <img
                                    src="https://tecdn.b-cdn.net/img/Photos/Avatars/img%20%2810%29.jpg"
                                    class="rounded-full shadow-md dark:shadow-black/30"
                                    alt="woman avatar"
                                />
                                <div class="flex items-center my-3">
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                </div>
                                <p
                                    class="mb-2 text-xs font-bold text-oynx dark:text-snow"
                                >
                                    Three weeks age
                                </p>
                            </div>
                            <div class="md:ms-4 flex-col">
                                <p
                                    class="mb-6 text-base font-light text-oynx dark:text-snow"
                                >
                                    Lorem ipsum dolor, sit amet consectetur
                                    adipisicing elit. Id quam sapiente molestiae
                                    numquam quas, voluptates omnis nulla ea odio
                                    quia similique corrupti magnam.
                                </p>
                                <p
                                    class="mb-2 text-base font-bold text-oynx dark:text-snow"
                                >
                                    Anna Smith
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-1 rounded-3">
                    <div class="m-4 block rounded-lg">
                        <!--Testimonial-->
                        <div class="md:flex md:flex-row">
                            <div
                                class="mx-auto mb-6 flex flex-col w-36 md:mx-0 md:w-96 lg:mb-0"
                            >
                                <img
                                    src="https://tecdn.b-cdn.net/img/Photos/Avatars/img%20%2810%29.jpg"
                                    class="rounded-full shadow-md dark:shadow-black/30"
                                    alt="woman avatar"
                                />
                                <div class="flex items-center my-3">
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                </div>
                                <p
                                    class="mb-2 text-xs font-bold text-oynx dark:text-snow"
                                >
                                    Three weeks age
                                </p>
                            </div>
                            <div class="md:ms-4 flex-col">
                                <p
                                    class="mb-6 text-base font-light text-oynx dark:text-snow"
                                >
                                    Lorem ipsum dolor, sit amet consectetur
                                    adipisicing elit. Id quam sapiente molestiae
                                    numquam quas, voluptates omnis nulla ea odio
                                    quia similique corrupti magnam.
                                </p>
                                <p
                                    class="mb-2 text-base font-bold text-oynx dark:text-snow"
                                >
                                    Anna Smith
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-1 rounded-3">
                    <div class="m-4 block rounded-lg">
                        <!--Testimonial-->
                        <div class="md:flex md:flex-row">
                            <div
                                class="mx-auto mb-6 flex flex-col w-36 md:mx-0 md:w-96 lg:mb-0"
                            >
                                <img
                                    src="https://tecdn.b-cdn.net/img/Photos/Avatars/img%20%2810%29.jpg"
                                    class="rounded-full shadow-md dark:shadow-black/30"
                                    alt="woman avatar"
                                />
                                <div class="flex items-center my-3">
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                    <font-awesome-icon
                                        icon="star"
                                        class="text-persian text-xxs"
                                    />
                                </div>
                                <p
                                    class="mb-2 text-xs font-bold text-oynx dark:text-snow"
                                >
                                    Three weeks age
                                </p>
                            </div>
                            <div class="md:ms-4 flex-col">
                                <p
                                    class="mb-6 text-base font-light text-oynx dark:text-snow"
                                >
                                    Lorem ipsum dolor, sit amet consectetur
                                    adipisicing elit. Id quam sapiente molestiae
                                    numquam quas, voluptates omnis nulla ea odio
                                    quia similique corrupti magnam.
                                </p>
                                <p
                                    class="mb-2 text-base font-bold text-oynx dark:text-snow"
                                >
                                    Anna Smith
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            v-else
            class="flex flex-col py-6 overflow-scroll disable-scrollbars"
        >
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
            ratingsPercentage: {},
            rating: "",
            taste: "",
            value: "",
            nutrition: "",
            freshness: "",
            presentation: "",
            portion_size: "",
            review: "",
            total: "",
        };
    },
    created() {
        this.getRatings();
    },
    methods: {
        getRatings() {
            const mealId = this.meal.id;
            //    console.log( mealId);
            axios
                .get("/ratings/" + mealId)
                .then((response) => {
                    if (response.data) {
                        console.log(response);
                        this.rating = "yer";
                        this.ratingsPercentage = response.data.percentages;
                        this.review = response.data.review;
                        this.taste = response.data.taste;
                        this.value = response.data.value;
                        this.nutrition = response.data.nutrition;
                        this.freshness = response.data.freshness;
                        this.presentation = response.data.presentation;
                        this.portion_size = response.data.portion_size;
                        this.total = response.data.total;
                    } else {
                        this.rating = "";
                    }
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
