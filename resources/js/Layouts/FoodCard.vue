<script setup>
import axios from "axios";
import Login from "@/Pages/Auth/Login.vue";
import { Head, Link } from "@inertiajs/vue3";
import Loader from "@/Components/Loader.vue";
import OrderCard from "@/Pages/Order/OrderCard.vue";
import BulkIcon from "@/Components/Icons/BulkIcon.vue";
defineProps(["meal"]);
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
                <Loader class="object-cover h-fit"></Loader>
            </div>

            <div v-if="!isLoading">
                <img
                    class="object-cover h-fit"
                    :src="src"
                    alt="product image"
                />
            </div>
            <span
                class="absolute top-0 left-0 m-2 rounded-full bg-lighred px-2 text-center text-sm font-medium text-snow"
                >New</span
            >
        </Link>
        <div class="my-2 px-5 pb-3 transition-all duration-200 ease delay-75">
            <Link :href="`/meals/${meal.id}`">
                <h5
                    class="text-lg capitalize font-bold tracking-tight text-oynx dark:text-snow text-nowrap"
                >
                    {{ meal.title }}
                </h5>
            </Link>
            <div class="my-2 flex items-center justify-between">
                <a href="#" class=" ">
                    <span
                        class="text-sm capitalize text-oynx dark:text-snow hover:text-polynesian hover:dark:text-lighred"
                        >{{ meal.cook.name }}
                    </span>
                </a>

                <div class="flex items-center">
                    <font-awesome-icon icon="star" class="text-persian" />
                    <span
                        class="mr-2 ml-3 rounded bg-persian px-1 py-0.5 text-xs font-semibold"
                        >{{ rating }}</span
                    >
                </div>
            </div>
            <div class="flex items-center justify-between">
                <p>
                    <span class="text-lg font-bold text-oynx dark:text-snow"
                        >${{ meal.price }}</span
                    >
                    <BulkIcon></BulkIcon>
                </p>
                <div
                    class="items-center justify-end rounded-md flex opacity-70 group-hover:opacity-100 py-2 group-hover:m-0 text-center text-sm font-medium text-snow focus:outline-none transition-all duration-200 delay-75 ease"
                >
                    <div v-if="$page.props.auth.user">
                        <font-awesome-icon
                            v-if="wishlist == null"
                            title="Add to wishlist"
                            @click="addWishList(meal.id)"
                            icon="fa-solid fa-heart"
                            class="text-xl pr-2 text-oynx cursor-pointer active:text-persian hover:text-polynesian dark:text-snow dark:hover:text-lighred"
                        />
                        <font-awesome-icon
                            v-else
                            title="Added to wishlist"
                            @click="removeWishList(meal.id)"
                            icon="fa-solid fa-heart"
                            class="text-xl text-persian pr-2 cursor-pointer active:text-persian hover:text-polynesian dark:text-snow dark:hover:text-lighred"
                        />
                    </div>
                    <div v-else>
                        <font-awesome-icon
                            title="Add to wishlist"
                            icon="fa-solid fa-heart"
                            class="text-xl pr-2 text-oynx cursor-pointer active:text-persian hover:text-polynesian dark:text-snow dark:hover:text-lighred"
                        />
                    </div>

                    <font-awesome-icon
                        title="Add to Meal Schedule"
                        @click="openModal(meal)"
                        icon="circle-plus"
                        class="text-xl px-2 text-oynx cursor-pointer active:text-persian hover:text-polynesian dark:text-snow dark:hover:text-lighred"
                    />
                    <font-awesome-icon
                        title="Share Meal"
                        icon="share"
                        class="text-xl px-2 text-oynx cursor-pointer active:text-persian hover:text-polynesian dark:text-snow dark:hover:text-lighred"
                    />
                </div>
            </div>
        </div>
    </div>
    <div
        class="modal disable-scrollbars overflow-y-auto overflow-x-hidden pt-16 fixed top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 z-[100] flex justify-center items-center backdrop-blur-sm w-full h-full"
        v-show="newEventModalVisible"
    >
        <div
            class="relative p-4 w-full max-w-md max-h-full transition-all duration-300 ease-in delay-200"
        >
            <div class="relative rounded-lg shadow shadow-small">
                <button
                    @click="closeModal"
                    type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-12 h-12 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="popup-modal"
                >
                    <font-awesome-icon
                        icon="fa-solid fa-close"
                        class="text-lighred text-2xl"
                    />
                    <span class="sr-only">Close modal</span>
                </button>
                <div v-if="$page.props.auth.user">
                    <OrderCard :newSchedule="newSchedule"></OrderCard>
                </div>
                <template v-else>
                    <Login></Login>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    inheritAttrs: false,
    data() {
        return {
            userId: "",
            isLoading: true,
            src: "",
            rating: "",
            wishlist: null,
            newSchedule: {
                meal_name: "",
                meal_time: "",
                user_id: "",
                cook_availability: "",
                start_date: "",
                end_date: "",
                price: "",
            },
            newEventModalVisible: false,
            isHeaderFixed: false,
        };
    },
    mounted() {
        // console.log(this.meal);
        this.handleScroll();
        this.WishList();
    },
    created() {
        this.getPhoto();
        this.WishList();
        this.fetchData();
        this.getRatings();
    },
    methods: {
        async getPhoto() {
            await axios
                .get("/meal_photos/" + this.meal.id)
                .then((response) => {
                    if (
                        response.data.firstPhoto &&
                        response.data.firstPhoto.meal_photo_path
                    ) {
                        this.src =
                            `/storage/${response.data.firstPhoto.meal_photo_path}`.replace(
                                "/public",
                                ""
                            );
                    } else {
                        this.src = "/images/imagenotfound.png";
                    }
                    // cons
                    // console.log(this.src);
                })
                .catch((error) => {
                    // console.error("Error fetching data:", error);
                    // Set default image on error as well
                    this.src = "/images/imagenotfound.png";
                })
                .finally(() => {
                    // Set loading state to false when fetching completes
                    this.isLoading = false;
                });
        },
        async loadMoreData() {
            if (this.hasMoreData) {
                this.page++;
                await this.fetchData();
            }
        },
        async fetchData() {
            try {
                const response = await axios.get(
                    `/meals?page=${this.page}&perPage=${this.perPage}`
                );
                const newMeals = response.data;

                // If there is no new data, set hasMoreData to false
                if (newMeals.length === 0) {
                    this.hasMoreData = false;
                }

                // Concatenate new data to the existing meals
                this.meals = [...this.meals, ...newMeals];
            } catch (error) {
                // console.error("Error fetching data:", error);
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

                        this.rating = response.data.total.toFixed(1);

                        // this.total = response.data.total;
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
        handleScroll() {
            // Adjust the scroll threshold as needed
            const scrollThreshold = 50;
            this.isHeaderFixed = window.scrollY > scrollThreshold;
        },
        removeWishList(id) {
            axios
                .delete(`/wishlist/${id}`)
                .then((response) => {
                    this.wishlist = response.data.wishlist;
                    // Update UI if necessary
                })
                .catch((error) => {
                    // console.error("Error deleting item:", error);
                });
        },
        addWishList(id) {
            const wishlistData = {
                meal_id: id,
                user_id: this.$page.props.auth.user.id,
            };
            axios
                .post("/wishlist", wishlistData)
                .then((response) => {
                    this.wishlist = response.data.wishlist;
                    // Update UI if necessary
                })
                .catch((error) => {
                    // console.error("Error adding to wishlist:", error);
                });
        },
        WishList() {
            if (this.$page.props.auth.user) {
                const id = this.meal.id;
                axios
                    .get("/wishlist/" + id)
                    .then((response) => {
                        this.wishlist = response.data.wishlist;
                    })
                    .catch((error) => {
                        // console.error("Error fetching wishlist data:", error);
                    });
            }
        },

        async openModal(meal) {
            const response = await axios.get(`/cook/menu/` + this.meal.cook.id);
            const availability = response.data.data.availability;
            // console.log(response.data.data);
            // console.log(this.meal.cook.id );

            // Get the current date
            const currentDate = new Date();

            // Add one day to the current date
            const nextDayDate = new Date(currentDate);
            nextDayDate.setDate(currentDate.getDate() + 1);

            // Format the next day date as an ISO string without the time part
            const nextDayISOString = nextDayDate
                .toISOString()
                .replace(/T.*$/, "");
            // clear everything in the div and close it
            this.newEventModalVisible = true;
            if (this.$page.props.auth.user) {
                // this.suggestedMeal = [];
                this.newSchedule = {
                    meal_name: meal.title,
                    meal_id: meal.id.toString(),
                    cook_availability: availability,
                    user_id: this.$page.props.auth.user.id.toString(),
                    start_date: nextDayISOString,
                    end_date: nextDayISOString,
                    price: meal.price,
                    meal_time: "Choose a Meal time",
                };
            }
            // console.log(meal );
        },
        closeModal() {
            // clear everything in the div and close it
            this.newEventModalVisible = false;
            this.newSchedule = {
                meal_name: "",
                start_date: "",
                end_date: "",
                meal_time: "",
            };
            this.message = "";
            this.error = "";
        },
    },
};
</script>

<style scoped></style>
