<script setup>
import { Head, Link } from "@inertiajs/vue3";
import axios from "axios";
import ApplicationMark from "@/Components/ApplicationMark.vue";

import Footer from "@/Layouts/Footer.vue";
import DropBarNav from "@/Pages/Header/DropBarNav.vue";
import ShowRating from "@/Pages/Rating/Show.vue";
import Loader from "@/Components/Loader.vue";
import Login from "@/Pages/Auth/Login.vue";
import SocialLogin from "@/Pages/Auth/SocialLogin.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import Dropdown from "@/Components/Dropdown.vue";
import OrderCard from "@/Pages/Order/OrderCard.vue";
</script>

<template>
    <Head :title="`${meal.name}`" />
    <header
        class="relative py-3 px-5 md:px-12 bg-snow dark:bg-oynx z-990 transition-all duration-300 delay-75 ease-in animate-fade-in"
    >
        <div
            :class="{ 'fix align-bottom shadow-sm': isHeaderFixed }"
            class="flex justify-between items-center w-full bg-snow dark:bg-oynx"
        >
            <Link
                :href="route('welcome')"
                :class="{ 'sm:absolute sm:-left-16 ': isHeaderFixed }"
                class="transition-all duration-300 delay-75 ease-in animate-fade-in"
            >
                <div class="w-full flex items-center">
                    <ApplicationMark class="block w-auto" />
                </div>
            </Link>

            <div
                class="hidden bg-transparent w-4/12 sm:w-4/12 capitalize font-bold text-sm mr-4 sm:flex justify-around transition-all duration-300 delay-75 ease-in"
                name=""
                id=""
            >
                <a href="#photo" class="py-2 px-3 navbar-link">
                    <p>Photo</p>
                </a>

                <a href="#detail" class="py-2 px-3 navbar-link">
                    <p>Details</p>
                </a>
                <a href="#rating" class="py-2 px-3 navbar-link text-nowrap">
                    <p>Ratings</p>
                </a>
                <div
                    class="items-center justify-end rounded-md flex py-2 group-hover:m-0 text-center text-sm font-medium text-snow focus:outline-none transition-all duration-200 delay-75 ease"
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
                        icon="share"
                        class="text-xl px-3 text-oynx active:text-persian hover:text-polynesian dark:text-snow dark:hover:text-lighred"
                    />
                </div>
            </div>
            <div class="flex gap-6 items-center sm:ms-6">
                <!-- Settings Dropdown -->
                <div
                    class="w-24 relative"
                    @click="openModal(meal)"
                    :class="{
                        ' right-0 ': isHeaderFixed,
                    }"
                >
                    <SocialLogin class="group">
                        <template #logo>
                            <font-awesome-icon
                                icon="circle-plus"
                                class="text-xl px-2 group-hover:-ml-3 group-action-text"
                            />
                        </template>
                        <template #name> Order </template>
                    </SocialLogin>
                </div>
                <div
                    :class="{
                        'absolute -right-50': isHeaderFixed,
                    }"
                >
                    <div>
                        <DropBarNav class="w-10 h-10 relative" />
                    </div>
                </div>
                <div class="sm:hidden flex items-center">
                    <a
                        mini-sidenav-burger=""
                        href="javascript:;"
                        class="sm:marker:hidden p-0 text-sm text-white transition-all ease-nav-brand block"
                        aria-expanded="false"
                    >
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <div class="w-4.5 overflow-hidden">
                                    <i
                                        class="ease mb-0.75 relative block h-0.5 rounded-sm bg-persian group-hover:bg-polynesian dark:group-hover:bg-lighred transition-all"
                                    ></i>
                                    <i
                                        class="ease mb-0.75 relative block h-0.5 rounded-sm bg-persian group-hover:bg-polynesian dark:group-hover:bg-lighred transition-all"
                                    ></i>
                                    <i
                                        class="ease relative block h-0.5 rounded-sm bg-persian group-hover:bg-polynesian dark:group-hover:bg-lighred transition-all"
                                    ></i>
                                </div>
                            </template>

                            <template #content class="bg-snow dark:bg-oynx">
                                <div
                                    class="origin-top-right absolute right-0 mt-2 w-48 delay-75 rounded-md border-snow ring-1 bg-gradient-to-br from-[#e3dedf] to-[#ffffff] -shadow-snow-sm hover:shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] dark:-shadow-oynx-sm hover:dark:shadow-oynx-sm z-20 transition-all duration-250 ease-in dark:border-oynx"
                                >
                                    <DropdownLink
                                        href="#photo"
                                        class="flex w-full items-center rounded-md px-4 py-2 text-sm text-oynx hover:text-polynesian dark:text-snow dark:hover:text-lighred cursor-pointer transition-all duration-200 ease-in-out"
                                    >
                                        <p>Photo</p>
                                    </DropdownLink>
                                    <DropdownLink
                                        href="#detail"
                                        class="relative flex items-center rounded-md px-4 py-2 text-sm text-oynx hover:text-polynesian dark:text-snow dark:hover:text-lighred cursor-pointer transition-all duration-200 ease-in-out"
                                    >
                                        <p>Details</p>
                                    </DropdownLink>
                                    <DropdownLink
                                        href="#rating"
                                        :href="'profile.show'"
                                        class="relative flex items-center rounded-md px-4 py-2 text-sm text-oynx hover:text-polynesian dark:text-snow dark:hover:text-lighred cursor-pointer transition-all duration-200 ease-in-out"
                                    >
                                        <a>
                                            <p>Ratings</p>
                                        </a>
                                    </DropdownLink>
                                </div>
                            </template>
                        </Dropdown>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-snow dark:bg-oynx selection:bg-red-500 selection:text-white"
    >
        <div class="container relative mx-auto overflow-hidden">
            <div
                class="m-auto flex flex-col justify-center h-full px-6 lg:px-8 lg:pb-20 w-full"
            >
                <div id="photo" class="py-5">
                    <h1
                        class="font-semibold text-3xl lg:text-4xl text-oynx dark:text-snow"
                    >
                        {{ meal.name }}
                    </h1>
                </div>
                <div
                    class="flex flex-col lg:flex-row h-[25rem] overflow-scroll disable-scrollbars"
                >
                    <div class="lg:w-1/2">
                        <div class="overflow-hidden pb-4 lg:p-0">
                            <div v-if="isLoading" class="">
                                <Loader class="object-cover h-fit"></Loader>
                            </div>
                            <img
                                v-if="!isLoading"
                                class="h-auto max-w-full rounded-lg lg:px-6"
                                :src="src"
                                alt=""
                            />
                        </div>
                    </div>
                    <div
                        class="lg:w-1/2 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"
                    >
                        <div v-for="(preview, index) in other_src">
                            <div
                                class="overflow-scroll disable-scrollbars rounded-lg"
                            >
                                <div v-if="isLoading" class="">
                                    <Loader class="object-cover h-fit"></Loader>
                                </div>
                                <img
                                    v-if="!isLoading"
                                    class="h-auto max-w-full rounded-lg"
                                    :src="preview.src"
                                    :alt="preview.src"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:w-full py-8 relative">
                    <div
                        id="detail"
                        class="flex flex-col lg:flex-row w-full relative"
                    >
                        <div class="lg:w-full">
                            <div class="flex items-center py-5">
                                <img
                                    v-if="meal.user.profile_photo_path"
                                    :src="
                                        getProfilePhotoUrl(
                                            meal.user.profile_photo_path
                                        )
                                    "
                                    class="rounded-full shadow-md dark:shadow-black/30 mr-3 w-10"
                                    alt="avatar"
                                />
                                <img
                                    v-else
                                    :src="`https://ui-avatars.com/api/?name=${meal.user.name}&color=FE6D73&background=004E98`"
                                    class="rounded-full shadow-md dark:shadow-black/30 mr-3 w-10"
                                    alt="avatar"
                                />
                                <h1
                                    class="font-semibold text-xl text-oynx dark:text-snow"
                                >
                                    <small>Cooked by </small>
                                    {{ meal.user.name }}
                                </h1>
                            </div>
                            <hr
                                class="h-px mb-2 bg-transparent bg-gradient-to-r from-transparent via-oynx/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-snow dark:to-transparent"
                            />
                            <div class="flex flex-col py-8">
                                <h1 class="text-lg text-oynx dark:text-snow">
                                    <font-awesome-icon
                                        icon="globe"
                                        class="mr-3"
                                    />
                                    This meal is popular in certain regions of
                                    {{ meal.region }}
                                </h1>
                            </div>

                            <hr
                                class="h-px mb-2 bg-transparent bg-gradient-to-r from-transparent via-oynx/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-snow dark:to-transparent"
                            />
                            <div class="flex flex-col py-8">
                                <h1
                                    class="font-semibold text-2xl lg:text-3xl pb-4 text-oynx dark:text-snow"
                                >
                                    <font-awesome-icon
                                        icon="newspaper"
                                        class="mr-2"
                                    />
                                    About the meal
                                </h1>
                                <h1 class="text-lg text-oynx dark:text-snow">
                                    {{ meal.description }}
                                </h1>
                            </div>
                            <hr
                                class="h-px mb-2 bg-transparent bg-gradient-to-r from-transparent via-oynx/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-snow dark:to-transparent"
                            />

                            <div class="py-5">
                                <div class="flex items-center">
                                    <img
                                        class="w-[1.5rem] h-[1.5rem] lg:w-[2rem] lg:h-[2rem] mr-2 hidden dark:block"
                                        src="/images/icons8-ingredients-50.png"
                                        alt="ingredients"
                                    />
                                    <img
                                        class="w-[1.5rem] h-[1.5rem] lg:w-[2rem] lg:h-[2rem] mr-2 block dark:hidden"
                                        src="https://img.icons8.com/ios/50/ingredients.png"
                                        alt="ingredients"
                                    />

                                    <h1
                                        class="py-3 font-semibold text-2xl lg:text-3xl text-oynx dark:text-snow"
                                    >
                                        Ingredients
                                    </h1>
                                </div>

                                <ul
                                    class="max-w-md space-y-1 text-oynx list-disc list-inside dark:text-snow"
                                    v-for="ingredient in meal.ingredients"
                                    :key="meal.id"
                                >
                                    <li class="py-1">{{ ingredient }}</li>
                                </ul>
                            </div>
                        </div>

                        <div
                            class="modal disable-scrollbars overflow-y-auto overflow-x-hidden pt-16 fixed top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 z-[100] flex justify-center items-center backdrop-blur-sm w-full h-full"
                            v-show="newEventModalVisible"
                        >
                            <div
                                class="relative p-4 w-full max-w-md max-h-full transition-all duration-300 ease-in delay-200"
                            >
                                <div
                                    class="relative rounded-lg shadow shadow-small"
                                >
                                    <button
                                        @click="closeModal"
                                        type="button"
                                        class="float-right z-[10000] top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-12 h-12 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="popup-modal"
                                    >
                                        <font-awesome-icon
                                            icon="fa-solid fa-close"
                                            class="text-lighred text-2xl"
                                        />
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div v-if="$page.props.auth.user">
                                        <OrderCard
                                            :newSchedule="newSchedule"
                                        ></OrderCard>
                                    </div>
                                    <template v-else>
                                        <Login></Login>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr
                class="h-px mb-2 bg-transparent bg-gradient-to-r from-transparent via-oynx/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-snow dark:to-transparent"
            />

            <div id="rating">
                <ShowRating :meal="meal"></ShowRating>
            </div>

            <hr
                class="h-px mb-2 bg-transparent bg-gradient-to-r from-transparent via-oynx/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-snow dark:to-transparent"
            />

            <!-- component -->
            <div class="  my-12 ">
            <div class=" px-12 mb-4  ">
                    <h1 class="font-semibold text-xl text-oynx dark:text-snow">
                        More about your cook
                    </h1>
                </div>
            <div
                class="flex flex-col lg:flex-row items-center py-3 md:px-8"
            >
               

                <div
                    class="h-56 w-75 absolute flex justify-center items-center"
                >
                    <img
                        v-if="meal.user.profile_photo_path"
                        :src="getProfilePhotoUrl(meal.user.profile_photo_path)"
                        class="object-cover h-20 w-20 rounded-full"
                        alt="avatar"
                    />
                    <img
                        v-else
                        :src="`https://ui-avatars.com/api/?name=${meal.user.name}&color=FE6D73&background=004E98`"
                        class="object-cover h-20 w-20 rounded-full"
                        alt="avatar"
                    />
                </div>

                <div
                    class="h-56  mx-4 w-5/6 bg-polynesian dark:bg-lighred rounded-3xl shadow-md sm:w-80 sm:mx-0"
                >
                    <div
                        class="h-1/2 w-full flex justify-between items-baseline px-3 py-5"
                    >
                        <div class="p-3 text-center">
                            <span
                                class="text-base font-bold block uppercase tracking-wide dark:text-oynx text-snow"
                            >
                                {{ ratings.toFixed(1) }}
                            </span>
                            <span class="text-xs dark:text-oynx text-snow"
                                >Rating</span
                            >
                        </div>
                        <div class="p-3 text-center">
                            <span
                                class="text-base font-bold block uppercase tracking-wide dark:text-oynx text-snow"
                            >
                                {{ reviews.length }}
                            </span>
                            <span class="text-xs dark:text-oynx text-snow"
                                >Review(s)</span
                            >
                        </div>
                    </div>

                    <div
                        class="bg-snow dark:bg-oynx shadow-small h-1/2 w-full rounded-b-3xl flex flex-col justify-around items-center"
                    >
                        <div
                            class="w-full h-1/2 flex justify-between items-center px-3 pt-2"
                        >
                            <div
                                class="p-3 flex flex-col justify-center items-center"
                            >
                                <span
                                    class="text-base font-bold block uppercase tracking-wide text-oynx dark:text-snow"
                                >
                                    {{ timeCooking }}
                                </span>
                                <span class="text-xs text-oynx dark:text-snow">
                                    {{ CookingDate }} <br />
                                    Cooking</span
                                >
                            </div>
                            <div
                                class="flex flex-col justify-center items-center"
                            >
                                <div class="z-10 p-3 text-center">
                                    <Link
                                        :href="
                                            route('user.show', {
                                                id: meal.user.id,
                                            })
                                        "
                                    >
                                        <span
                                            class="text-sm block tracking-wide text-oynx dark:text-snow hover:underline"
                                        >
                                            View <br />
                                            Profile
                                        </span>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class=" lg:w-2/3  p-10 text-oynx dark:text-snow">
                    <hr
                class="h-px mb-2 bg-transparent bg-gradient-to-r from-transparent via-oynx/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-snow dark:to-transparent"
            />
            <br>  {{ meal.user.other_info }} <br> <br>
                    <hr
                class="h-px mb-2 bg-transparent bg-gradient-to-r from-transparent via-oynx/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-snow dark:to-transparent"
            />
                    <font-awesome-icon icon="circle-exclamation" />    To protect your payment, do not transfer money outside of the Ounjemi website.
                </div>
            </div>
            
            </div>
        </div>
    </div>
    <Footer></Footer>
</template>

<script>
export default {
    inheritAttrs: false,
    props: {
        meal: Object,
        user: Object,
        cook: Object,
        reviews: Object,
        ratings: String,
        rating: Object,
    },
    data() {
        return {
            src: "",
            isLoading: true,
            other_src: "",
            imagePreviews: [],
            userId: "",
            message: "",
            error: "",
            wishlist: null,
            newSchedule: {
                meal_name: "",
                meal_time: "",
                user_id: "",
                start_date: "",
                price: "",
                end_date: "",
            },
            formattedEvents: [],
            rating: [],
            newEventModalVisible: false,
            isHeaderFixed: false,
        };
    },
    mounted() {
        window.addEventListener("scroll", this.handleScroll);
    },
    created() {
        this.getPhoto();
        this.getPhotos();
    },
    beforeDestroy() {
        window.removeEventListener("scroll", this.handleScroll);
    },
    computed: {
        timeCooking() {
            const createdAt = new Date(this.meal.user.created_at);
            const now = new Date();
            const diffTime = Math.abs(now - createdAt);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            if (diffDays < 30) {
                return `${diffDays} `;
            } else if (diffDays < 365) {
                const diffMonths = Math.floor(diffDays / 30);
                return `${diffMonths} `;
            } else {
                const diffYears = Math.floor(diffDays / 365);
                return `${diffYears}`;
            }
        },
        CookingDate() {
            const createdAt = new Date(this.meal.user.created_at);
            const now = new Date();
            const diffTime = Math.abs(now - createdAt);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            if (diffDays < 30) {
                return `Days`;
            } else if (diffDays < 365) {
                return `Months`;
            } else {
                return `Years`;
            }
        },
    },
    methods: {
        handleScroll() {
            // Adjust the scroll threshold as needed
            const scrollThreshold = 20;
            this.isHeaderFixed = window.scrollY > scrollThreshold;
        },
        getProfilePhotoUrl(profilePhotoPath) {
            if (
                profilePhotoPath.includes("https://lh3.googleusercontent.com")
            ) {
                return profilePhotoPath;
            } else {
                return `/storage/${profilePhotoPath}`;
            }
        },
        removeWishList(id) {
            axios
                .delete(`/wishlist/${id}`)
                .then((response) => {
                    this.wishlist = response.data.wishlist;
                    // Update UI if necessary
                })
                .catch((error) => {
                    console.error("Error deleting item:", error);
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
                    console.error("Error adding to wishlist:", error);
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
                        console.error("Error fetching wishlist data:", error);
                    });
            }
        },
        getPhoto() {
            axios
                .get("/meal_photos/" + this.meal.id)
                .then((response) => {
                    this.src =
                        `/storage/${response.data.firstPhoto.meal_photo_path}`.replace(
                            "/public",
                            ""
                        );
                })
                .catch((error) => {
                    console.error("Error fetching data:", error);
                })
                .finally(() => {
                    // Set loading state to false when fetching completes
                    this.isLoading = false;
                });
        },
        getPhotos() {
            axios
                .get("/meal_photos/" + this.meal.id)
                .then((response) => {
                    // this.other_src = `/storage/${response.data.otherPhotos.meal_photo_path}`.replace("/public", "");
                    this.other_src = response.data.otherPhotos
                        .slice(1)
                        .map((image) => ({
                            src: `/storage/${image.meal_photo_path}`.replace(
                                "/public",
                                ""
                            ), // Assuming your image object has a 'url' property
                            id: image.id, // Assuming your image object has an 'id' property
                        }));
                })
                .catch((error) => {
                    console.error("Error fetching data:", error);
                })
                .finally(() => {
                    // Set loading state to false when fetching completes
                    this.isLoading = false;
                });
        },
        openModal() {
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
                    meal_name: this.meal.name,
                    meal_id: this.meal.id.toString(),
                    user_id: this.$page.props.auth.user.id.toString(),
                    start_date: nextDayISOString,
                    end_date: nextDayISOString,
                    price: this.meal.price,
                    meal_time: "Choose a Meal time",
                };
            }
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
        formatSchedule() {
            this.formattedEvents = {
                meal_id: this.newSchedule.meal_id,
                user_id: this.newSchedule.user_id,
                meal_time: this.newSchedule.meal_time,
                start_date: this.newSchedule.start_date,
                end_date: this.newSchedule.end_date,
            };
        },

        addSchedule() {
            const today = new Date().toISOString().replace(/T.*$/, "");
            if (
                this.newSchedule.start_date == "" ||
                this.newSchedule.end_date == "" ||
                this.newSchedule.meal_time == "" ||
                this.newSchedule.user_id == ""
            ) {
                this.error =
                    "Please fill in all  fields to create your schedule.";
            } else if (today >= this.newSchedule.start_date) {
                this.error =
                    "Schedules can only be created for future dates. Would you like to choose a future date for the start, or cancel this schedule? ";
            } else if (
                this.newSchedule.start_date > this.newSchedule.end_date
            ) {
                this.error =
                    "The start date cannot be later than the end date. Please choose a start date that comes before the end date.";
            } else {
                this.formatSchedule();

                axios
                    .post("/schedule", this.formattedEvents)
                    .then((resp) => {
                        this.message = resp.data.message;
                        if (this.meal.ordering_preferences == "automatic") {
                            const MealId = resp.data.data.id;
                            this.$inertia.visit(`/process_order/${MealId}`);
                        } else {
                            this.$inertia.visit(`/meal-schedule`);
                        }
                    })
                    .catch((err) => {
                        this.error = "Unable to add Meal !";
                        setTimeout(() => {
                            this.error = "";
                            console.log("Unable to add Meal !", err);
                        }, 10000);
                    });
            }
        },
    },
};
</script>
<style scoped>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
.fix {
    position: fixed;
    top: 0;
    right: 0;
    width: 100%;
    padding: 1rem 3rem;
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
