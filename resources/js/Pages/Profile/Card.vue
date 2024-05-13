
<script setup>
import { Head, Link } from "@inertiajs/vue3";
import axios from "axios";
import Loader from "@/Components/Loader.vue";
</script>
<template>
      <div
                                class="group relative m-auto flex w-full max-w-xs flex-col overflow-hidden rounded-xl bg-gradient-to-br from-[#e3dedf] to-[#ffffff] hover:border hover:border-gray-500 dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] transition-all duration-250 delay-75 ease-in"
                            >
                                <Link
                                    class="relative flex h-54 overflow-hidden"
                                    :href="`/meals/${meal.id}`"
                                >
                                    <div v-if="isLoading" class="">
                                        <Loader
                                            class="object-cover h-fit"
                                        ></Loader>
                                    </div>

                                    <div v-if="!isLoading">
                                        <img
                                            class="object-cover h-fit"
                                            :src="src"
                                            alt="product image"
                                        />
                                    </div>
                                </Link>
                                <div
                                    class="p-5 transition-all flex items-center justify-between duration-200 ease delay-75"
                                >
                                    <Link :href="`/meals/${meal.id}`">
                                        <h5
                                            class="text-lg font-bold tracking-tight text-oynx dark:text-snow text-nowrap"
                                        >
                                            {{ meal.name }}
                                        </h5>
                                    </Link>
                                    <div class="">
                                        <div class="">
                                            <font-awesome-icon
                                                icon="star"
                                                class="text-persian"
                                            />
                                            <span
                                                class="mr-2 ml-3 rounded bg-persian px-1 py-0.5 text-xs font-semibold"
                                                >5.0</span
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
</template>
<script>
import axios from "axios";
export default {
    inheritAttrs: false,
    props: {
        meal: Object, // Prop to receive paginated notifications data from Inertia
    },
    data() {
        return {
            src: "",
            isLoading: true,
        };
    },
    beforeDestroy() {
        // window.removeEventListener("scroll", this.handleScroll);
    },

    mounted() {
        // window.addEventListener("scroll", this.handleScroll);
        console.log(this.meals);
    },
    created() {
        // this.handleScroll();
        this.getPhoto();
        // // this.getNotification();
    },
    methods: {
        async getPhoto() {
            await axios
                .get("/meal_photos/" + this.meal.id)
                .then((response) => {
                    this.src =
                        `/storage/${response.data.firstPhoto.meal_photo_path}`.replace(
                            "/public",
                            ""
                        );
                    console.log(this.src);
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
