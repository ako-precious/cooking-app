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
                    class="w-full col-start-2 col-end-3 row-span-3 shadow-extra-small rounded-3 ..."
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
                                            {{ total.toFixed(1) }}
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
                    <template #rating>{{ presentation.toFixed(1) }}</template>
                </RatingsCard>
                <RatingsCard>
                    <template #img
                        ><img
                            class="w-[2rem] h-[2rem] lg:w-[3rem] lg:h-[3rem] mr-3"
                            src="/images/freshness.png"
                            alt="ingredients"
                    /></template>
                    <template #title>Freshness</template>
                    <template #rating>{{ freshness.toFixed(1) }}</template>
                </RatingsCard>
                <RatingsCard>
                    <template #img
                        ><img
                            class="w-[2rem] h-[2rem] lg:w-[3rem] lg:h-[3rem] mr-3"
                            src="/images/taste.png"
                            alt="ingredients"
                    /></template>
                    <template #title>Taste</template>
                    <template #rating>{{ taste.toFixed(1) }}</template>
                </RatingsCard>
                <RatingsCard>
                    <template #img
                        ><img
                            class="w-[2rem] h-[2rem] lg:w-[3rem] lg:h-[3rem] mr-3"
                            src="/images/nutrition.png"
                            alt="ingredients"
                    /></template>
                    <template #title>Nutrition</template>
                    <template #rating>{{ nutrition.toFixed(1) }}</template>
                </RatingsCard>
                <RatingsCard>
                    <template #img
                        ><img
                            class="w-[2rem] h-[2rem] lg:w-[3rem] lg:h-[3rem] mr-3"
                            src="/images/portionsize.png"
                            alt="ingredients"
                    /></template>
                    <template #title>Quantity</template>
                    <template #rating>{{ portion_size.toFixed(1) }}</template>
                </RatingsCard>
                <RatingsCard>
                    <template #img
                        ><img
                            class="w-[2rem] h-[2rem] lg:w-[3rem] lg:h-[3rem] mr-3"
                            src="/images/value.png"
                            alt="ingredients"
                    /></template>
                    <template #title>Value</template>
                    <template #rating>{{ value.toFixed(1) }}</template>
                </RatingsCard>
            </div>
            <hr
                class="h-px mb-2 bg-transparent bg-gradient-to-r from-transparent via-oynx/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-snow dark:to-transparent"
            />
            <div
                class="overflow-y-scroll max-h-[500px] lg:max-h-[1000px] flex flex-col py-8 md:px-6 lg:p-8"
            >
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 auto-cols-fr"
                >
                    <!--Background-->
                  
                    <div
                        v-for="comment in comments"
                        :key="comment.id"
                        class="animate-fade-in"
                    >
                        <div class="col-span-1 rounded-3">
                            <div class="m-4 block rounded-lg">
                                <!--Testimonial-->
                                <div class="md:flex md:flex-row">
                                    <div
                                        class="mx-auto mb-6 flex flex-col items-center w-36 md:w-1/3 md:mx-0 lg:mb-0"
                                    >
                                        <img v-if="comment.profile_photo_path"
                                            src="comment.profile_photo_path"
                                            class="rounded-full shadow-md dark:shadow-black/30"
                                            alt="woman avatar"
                                        />
                                        <img v-else
                                            :src="`https://ui-avatars.com/api/?name=${comment.user.name}&color=FE6D73&background=004E98`"
                                            class="rounded-full shadow-md dark:shadow-black/30"
                                            alt="woman avatar"
                                        />
                                        <div class="flex items-center my-3">
                                            
                                            <div
                                                v-for="index in getStars(comment.total)"
                                                :key="index"
                                            >
                                                <font-awesome-icon
                                                    icon="star"
                                                    class="text-persian text-xxs"
                                                />
                                            </div>
                                           
                                        </div>
                                        <p
                                            class="mb-2 text-xs font-bold text-oynx dark:text-snow"
                                        >
                                            {{
                                                FormattedDate(
                                                    comment.updated_at
                                                )
                                            }}
                                        </p>
                                    </div>
                                    <div class="md:ms-5 flex-col md:w-2/3">
                                        <p
                                            class="mb-4 text-base font-light text-oynx dark:text-snow"
                                        >
                                            {{ comment.comment }}
                                        </p>
                                        <p
                                            class="mb-2 text-base font-bold text-oynx dark:text-snow capitalize"
                                        >
                                            {{ comment.user.name }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full flex justify-center items-center">
                <button @click="loadMoreData">Show More Reviews</button>
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
            page: 1, // Current page
            perPage: 3, // Number of items per page
            hasMoreData: true,
            comments: [],
        };
    },
    created() {
        this.getRatings();
    },
    methods: {
        async loadMoreData() {
            if (this.hasMoreData) {
                this.page++;
                await this.fetchData();
            }
        },
        getStars(num) {
            return Array.from({ length: num }, (_, i) => i + 1);
        },
        FormattedDate(date) {
            const currentDate = new Date();
            const targetDate = new Date(date);

            const diffTime = Math.abs(currentDate - targetDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            const diffWeeks = Math.floor(diffDays / 7);
            const diffMonths =
                currentDate.getMonth() -
                targetDate.getMonth() +
                12 * (currentDate.getFullYear() - targetDate.getFullYear());

            if (diffDays < 7 && diffDays > 1) {
                return `${diffDays} days ago`;
            } else if (diffDays === 1) {
                return "Yesterday";
            } else if (diffDays >= 7 && diffDays < 14) {
                return "1 week ago";
            } else if (diffDays >= 14 && diffDays < 30) {
                return `${diffWeeks} weeks ago`;
            } else {
                return `${targetDate.toLocaleString("default", {
                    month: "long",
                })}, ${targetDate.getFullYear()}`;
            }
        },
        async fetchData() {
            try {
                const response = await axios.get(
                    `/api/rating/${this.meal.id}?page=${this.page}&perPage=${this.perPage}`
                );
                const newComments = response.data.comments.data;

                //     // If there is no new data, set hasMoreData to false
                if (newComments.length === 0) {
                    this.hasMoreData = false;
                }

                // Concatenate new data to the existing meals
                this.comment = [...this.comment, ...newComments];
            } catch (error) {
                //     console.error("Error fetching data:", error);
            }
        },
        getRatings() {
            const mealId = this.meal.id;
            //    console.log( mealId);
            axios
                .get("/api/ratings/" + mealId)
                .then((response) => {
                    if (response.data) {
                        // console.log(response);
                        this.rating = "yes";
                        this.comments = response.data.comments.data;
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
                    // console.error("Error fetching data:", error);
                })
                .finally(() => {
                    // Set loading state to false when fetching completes
                    this.isLoading = false;
                });
        },
    },
};
</script>
<style scoped>
button {
    --color: #1b998b;
    font-family: inherit;
    display: inline-block;
    width: 8em;
    height: 2.5em;
    margin: 10px;
    line-height: 2.5em;
    margin: 10px;
    position: relative;
    overflow: hidden;
    border: 2px solid var(--color);
    transition: color 0.5s;
    z-index: 1;
    font-size: 17px;
    border-radius: 6px;
    font-weight: 600;
    color: var(--color);
}

button:before {
    content: "";
    position: absolute;
    z-index: -1;
    background: var(--color);
    height: 150px;
    width: 200px;
    border-radius: 50%;
}

button:hover {
    color: #fff;
}

button:before {
    top: 100%;
    left: 100%;
    transition: all 0.7s;
}

button:hover:before {
    top: -30px;
    left: -30px;
}

button:active:before {
    background: #0e534b;
    transition: background 0s;
}
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
.fixed {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000; /* Adjust z-index as needed */
}

@keyframes fade-in {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.animate-fade-in {
    animation: fade-in 0.3s ease-in;
}
</style>
