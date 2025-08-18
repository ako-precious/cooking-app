<script setup>
import axios from "axios";
import { Head, Link } from "@inertiajs/vue3";
import Loader from "@/Components/Loader.vue";
import OrderCard from "@/Pages/Order/OrderCard.vue";
import BulkIcon from "@/Components/Icons/BulkIcon.vue";
import Login from "@/Pages/Auth/Login.vue";

defineProps(["meal"]);
</script>

<template>
    <div
        class="group relative m-auto flex w-full max-w-xs flex-col overflow-hidden rounded-xl bg-gradient-to-br from-[#e3dedf] to-[#ffffff] hover:border hover:border-gray-500 dark:from-[#2b312e] dark:to-[#333a37] transition-all duration-250 delay-75 ease-in"
    >
        <!-- Image & Badge -->
        <Link
            :href="`/meals/${meal.id}`"
            class="relative flex h-56 overflow-hidden"
        >
            <div v-if="isLoading"><Loader /></div>
            <img
                v-else
                :src="src"
                alt="product image"
                class="object-cover h-fit"
            />
            <span
                class="absolute top-0 left-0 m-2 rounded-full bg-lighred px-2 text-sm font-medium text-snow"
            >
                New
            </span>
        </Link>

        <!-- Meal Info -->
        <div class="my-2 px-5 pb-3 transition-all duration-200">
            <Link :href="`/meals/${meal.id}`">
                <h5
                    class="text-lg font-bold capitalize tracking-tight text-oynx dark:text-snow truncate"
                >
                    {{ meal.title }}
                </h5>
            </Link>

            <div class="my-2 flex items-center justify-between">
                <!-- Cook Name -->
                <Link
                    :href="route('user.show', { id: meal.cook.id })"
                    class="text-sm capitalize text-oynx dark:text-snow hover:text-polynesian dark:hover:text-lighred"
                >
                    {{ meal.cook.name }}
                </Link>

                <!-- Rating -->
                <div class="flex items-center">
                    <font-awesome-icon icon="star" class="text-persian" />
                    <span
                        class="ml-2 rounded bg-persian px-1 py-0.5 text-xs font-semibold"
                    >
                        {{ rating }}
                    </span>
                </div>
            </div>

            <!-- Price Selector -->
            <form class="relative w-full">
                <span
                    v-if="!selectedPrice && !isDropdownOpen"
                    class="absolute left-0 top-1/2 -translate-y-1/2 pl-2.5 text-sm text-oynx dark:text-snow pointer-events-none"
                >
                    Choose a size and price
                </span>

                <select
                    v-model="selectedPrice"
                    name="price"
                    @focus="isDropdownOpen = true"
                    @blur="isDropdownOpen = false"
                    class="w-full p-1.5 border border-gray-400 rounded-lg cursor-pointer bg-snow text-oynx dark:bg-oynx dark:text-snow focus:border-polynesian focus:shadow-lg"
                >
                    <option value="" disabled>Choose a size and price</option>
                    <option
                        v-for="(priceOption, i) in meal.prices"
                        :key="i"
                        :value="priceOption"
                    >
                        {{ priceOption.size }}
                        {{
                            priceOption.size === priceOption.unit
                                ? ""
                                : priceOption.unit
                        }}
                        - ${{ priceOption.price }}
                    </option>
                </select>
            </form>
            <div class=" text-xs capitalize text-lighred py-2">
                {{ error }}
            </div>
            <!-- Actions -->
            <div class="flex items-center justify-between mt-2">
                <div
                    class="flex items-center opacity-70 group-hover:opacity-100 transition-all duration-200"
                >
                    <p class="flex items-center">
                        <BulkIcon />
                    </p>

                    <!-- Wishlist -->
                    <template v-if="$page.props.auth.user">
                        <font-awesome-icon
                            v-if="!wishlist"
                            title="Add to wishlist"
                            @click="addWishList(meal.id)"
                            icon="fa-solid fa-heart"
                            class="text-xl pr-2 text-oynx cursor-pointer hover:text-polynesian dark:text-snow dark:hover:text-lighred"
                        />
                        <font-awesome-icon
                            v-else
                            title="Added to wishlist"
                            @click="removeWishList(meal.id)"
                            icon="fa-solid fa-heart"
                            class="text-xl pr-2 text-persian cursor-pointer"
                        />
                    </template>
                    <template v-else>
                        <font-awesome-icon
                            title="Add to wishlist"
                            icon="fa-solid fa-heart"
                            class="text-xl pr-2 text-oynx cursor-pointer hover:text-polynesian dark:text-snow dark:hover:text-lighred"
                        />
                    </template>

                    <!-- Schedule & Share -->
                    <font-awesome-icon
                        title="Add to Meal Schedule"
                        @click="openModal(meal)"
                        icon="circle-plus"
                        class="text-3xl px-2 cursor-pointer text-oynx hover:text-polynesian dark:text-snow dark:hover:text-lighred"
                    />
                    <font-awesome-icon
                        title="Share Meal"
                        @click="shareMeal"
                        icon="share"
                        class="text-xl px-2 cursor-pointer text-oynx hover:text-polynesian dark:text-snow dark:hover:text-lighred"
                    />
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div
        v-show="newEventModalVisible"
        class="fixed inset-0 z-[100] flex items-center justify-center backdrop-blur-sm"
    >
        <div class="relative w-full max-w-md p-4">
            <div class="relative rounded-lg shadow-small shadow">
                <button
                    @click="closeModal"
                    type="button"
                    class="absolute top-3 right-3 w-10 h-10 flex items-center justify-center rounded-lg text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600"
                >
                    <font-awesome-icon
                        icon="fa-solid fa-close"
                        class="text-lighred text-xl"
                    />
                </button>
                <div v-if="$page.props.auth.user">
                    <OrderCard :newSchedule="newSchedule" />
                </div>
                <Login v-else />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            src: "",
            rating: "",
            wishlist: null,
            selectedPrice: null,
            isDropdownOpen: false,
            isLoading: true,
            newSchedule: {},
            error: null,
            newEventModalVisible: false,
        };
    },

    created() {
        this.getPhoto();
        this.getRatings();
        this.WishList();
    },

    methods: {
        async getPhoto() {
            try {
                const { data } = await axios.get(
                    `/meal_photos/${this.meal.id}`
                );
                this.src = data.firstPhoto?.meal_photo_path
                    ? `/storage/${data.firstPhoto.meal_photo_path}`.replace(
                          "/public",
                          ""
                      )
                    : "/images/imagenotfound.png";
            } catch {
                this.src = "/images/imagenotfound.png";
            } finally {
                this.isLoading = false;
            }
        },

        async getRatings() {
            try {
                const { data } = await axios.get(
                    `/api/ratings/${this.meal.id}`
                );
                this.rating = data?.total ? data.total.toFixed(1) : "";
            } finally {
                this.isLoading = false;
            }
        },

        async shareMeal() {
            const shareUrl = `/meals/${this.meal.id}`;
            const shareData = {
                title: this.meal.title,
                text: `Check out this delicious meal: ${this.meal.title}`,
                url: shareUrl,
            };

            try {
                if (navigator.share) {
                    await navigator.share(shareData);
                } else {
                    await navigator.clipboard.writeText(shareUrl);
                    alert("Link copied to clipboard!");
                }
            } catch {
                prompt("Copy this link to share:", shareUrl);
            }
        },

        addWishList(id) {
            axios
                .post("/wishlist", {
                    meal_id: id,
                    user_id: this.$page.props.auth.user.id,
                })
                .then((res) => (this.wishlist = res.data.wishlist));
        },

        removeWishList(id) {
            axios
                .delete(`/wishlist/${id}`)
                .then((res) => (this.wishlist = res.data.wishlist));
        },

        WishList() {
            if (!this.$page.props.auth.user) return;
            axios
                .get(`/wishlist/${this.meal.id}`)
                .then((res) => (this.wishlist = res.data.wishlist));
        },

        async openModal(meal) {
            if (!this.$page.props.auth.user)
                return this.$inertia.visit("/login");
            if (!this.selectedPrice) {
                this.error = "Please select a price option before scheduling.";
                return;
            }
            const { data } = await axios.get(`/cook/menu/${meal.cook.id}`);
            const nextDay = new Date();
            nextDay.setDate(nextDay.getDate() + 1);

            this.newSchedule = {
                meal_name: meal.title,
                meal_id: meal.id.toString(),
                cook_availability: data.data.availability,
                user_id: this.$page.props.auth.user.id.toString(),
                start_date: nextDay.toISOString().split("T")[0],
                end_date: nextDay.toISOString().split("T")[0],
                prices: this.selectedPrice,
                meal_time: "Choose a Meal time",
            };

            this.newEventModalVisible = true;
        },

        closeModal() {
            this.newEventModalVisible = false;
            this.newSchedule = {};
        },
    },
};
</script>
<style scoped></style>
