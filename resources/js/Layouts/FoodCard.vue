<script setup>
import axios from "axios";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Login from "@/Pages/Auth/Login.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link } from "@inertiajs/vue3";
import Loader from "@/Components/Loader.vue";

defineProps(["meal"]);
</script>
<script>
export default {
    inheritAttrs: false,
    data() {
        return {
            userId: "",
            isLoading: true,
            message: "",
            src: "",
            error: "",
            newSchedule: {
                meal_name: "",
                meal_time: "",
                user_id: "",
                start_date: "",
                end_date: "",
            },
            formattedEvents: [],
            newEventModalVisible: false,
            isHeaderFixed: false,
        };
    },
    mounted() {
        // console.log(this.meal);
        this.handleScroll()
    },
    created() {
        this.getPhoto();
        // this.getMeals(),
        //     this.filterMeals(),
        //     this.fetchData(),
        //     this.closeModal();
    },
    methods: {
        getMeals() {
            // axios
            //     .get("/api/meals")
            //     .then((response) => {
            //         this.meals = response.data;
            //     })
            //     .catch((error) => {
            //         console.error("Error fetching data:", error);
            //     })
                
        },
        getPhoto() {
            axios
                .get("/meal_photos/" + this.meal.id)
                .then((response) => {
                    this.src =
                        `/storage/${response.data.firstPhoto.meal_photo_path}`.replace("/public","");
                    // console.log(this.src);
                })
                .catch((error) => {
                    console.error("Error fetching data:", error);
                })
                .finally(() => {
                    // Set loading state to false when fetching completes
                    this.isLoading = false;
                });
        },
        filterMeals(searchText) {
          
                axios
                    .get(`/api/filtered-meals?query=${searchText}`)
                    .then((response) => {
                        if (response.data.length != 0) {
                            this.meals = response.data;
                        }
                    })
                    .catch((error) => {
                        console.error("Error fetching filtered data:", error);
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
                    `/api/meals?page=${this.page}&perPage=${this.perPage}`
                );
                const newMeals = response.data;

                // If there is no new data, set hasMoreData to false
                if (newMeals.length === 0) {
                    this.hasMoreData = false;
                }

                // Concatenate new data to the existing meals
                this.meals = [...this.meals, ...newMeals];
            } catch (error) {
                console.error("Error fetching data:", error);
            }
        },
        handleScroll() {
            // Adjust the scroll threshold as needed
            const scrollThreshold = 50;
            this.isHeaderFixed = window.scrollY > scrollThreshold;
        },
        openModal(meal) {
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
                    user_id: this.$page.props.auth.user.id.toString(),
                    start_date: nextDayISOString,
                    end_date: nextDayISOString,
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

                        const MealId = resp.data.data.id;
                        this.$inertia.visit(`/process_order/${MealId}`);

                        // setTimeout(() => {
                        //     this.closeModal();
                        //     // Uncomment the line below if you want to toggle addingMode after the delay
                        //     // this.addingMode = !this.addingMode;
                        // }, 5000);
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
<template>
    <div
        class="group relative m-auto flex w-full max-w-xs flex-col overflow-hidden rounded-xl shadow-reverse"
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
                    v-if="src"
                    class="object-cover h-fit"
                    :src="src"
                    alt="product image"
                />
                <img
                    v-else
                    class="object-cover h-fit"
                    src="https://images.unsplash.com/photo-1484723091739-30a097e8f929?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fGZvb2R8ZW58MHx8MHx8fDA%3D"
                    alt="product image"
                />
            </div>
            <span
                class="absolute top-0 left-0 m-2 rounded-full bg-oynx px-2 text-center text-sm font-medium text-snow"
                >New</span
            >
        </Link>
        <div class="my-2 px-5 pb-3 transition-all duration-200 ease delay-75">
            <Link :href="`/meals/${meal.id}`">
                <h5
                    class="text-lg font-bold tracking-tight text-oynx dark:text-snow text-nowrap"
                >
                    {{ meal.title }}
                </h5>
            </Link>
            <div class="my-2 flex items-center justify-between">
                <a href="#" class=" ">
                    <span
                        class="text-xs text-oynx dark:text-snow hover:text-polynesian hover:dark:text-lighred"
                        >{{ meal.cook.name }}</span
                    >
                </a>
                <div class="flex items-center">
                    <font-awesome-icon icon="star" class="text-persian" />
                    <span
                        class="mr-2 ml-3 rounded bg-persian px-1 py-0.5 text-xs font-semibold"
                        >5.0</span
                    >
                </div>
            </div>
            <div class="flex items-center justify-between">
                <p>
                    <span class="text-lg font-bold text-oynx dark:text-snow"
                        >${{ meal.price }}</span
                    >
                </p>
                <div
                    class="items-center justify-end rounded-md flex opacity-0 group-hover:opacity-100 py-2 group-hover:m-0 text-center text-sm font-medium text-snow focus:outline-none transition-all duration-200 delay-75 ease"
                >
                    <font-awesome-icon
                        icon="fa-regular fa-heart"
                        class="text-xl pr-2 text-oynx active:text-persian hover:text-polynesian dark:text-snow dark:hover:text-lighred"
                    />

                    <font-awesome-icon
                        @click="openModal(meal)"
                        icon="circle-plus"
                        class="text-xl px-2 text-oynx active:text-persian hover:text-polynesian dark:text-snow dark:hover:text-lighred"
                    />
                    <font-awesome-icon
                        icon="share"
                        class="text-xl px-2 text-oynx active:text-persian hover:text-polynesian dark:text-snow dark:hover:text-lighred"
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
                    <div class="" v-if="message">
                        <div
                            class="px-6 py-4 mt-1 bg-persian/20 rounded-lg text-persian"
                        >
                            <span class="font-bold"> {{ message }} </span>
                        </div>
                    </div>
                    <div class="" v-if="error">
                        <div
                            class="px-6 py-4 mt-1 bg-lighred/20 rounded-lg text-lighred"
                        >
                            <span class="font-bold">{{ error }}</span>
                        </div>
                    </div>

                    <form @submit.prevent class="p-4 md:py-8 text-center">
                        <h2 class="text-oynx dark:text-snow font-bold text-xl">
                            New Meal Schedule
                        </h2>
                        <div class="py-4 relative">
                            <TextInput
                                readonly
                                required
                                class="my-2 w-full"
                                v-model="newSchedule.meal_name"
                                placeholder="Meal Name"
                            />
                            <TextInput
                                readonly
                                hidden
                                required
                                class="my-2 w-full"
                                type="number"
                                v-model="newSchedule.meal_id"
                                placeholder=""
                            />
                            <TextInput
                                readonly
                                hidden
                                required
                                class="my-2 w-full"
                                type="number"
                                v-model="newSchedule.user_id"
                                placeholder=""
                            />
                        </div>

                        <div class="py-4 flex justify-between">
                            <TextInput
                                required
                                class="w-full"
                                v-model="newSchedule.start_date"
                                type="date"
                                placeholder=""
                            />
                            <TextInput
                                hidden
                                required
                                class="w-[47%]"
                                v-model="newSchedule.end_date"
                                type="date"
                                placeholder=""
                            />
                        </div>
                        <div class="py-4 flex justify-between">
                            <select
                                required
                                v-model="newSchedule.meal_time"
                                title="Meal Time"
                                placeholder="Choose a meal time"
                                class="border-oynx bg-snow text-oynx dark:bg-oynx dark:text-snow bg-gradient-to-br from-[#e3dedf] to-[#ffffff] w-full shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] focus:shadow-none dark:focus:shadow-none dark:shadow-oynx-sm dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred rounded-md"
                            >
                                <option
                                    selected
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow"
                                >
                                    {{ newSchedule.meal_time }}
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow"
                                    value="breakfast"
                                >
                                    Breakfast
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow"
                                    value="launch"
                                >
                                    Launch
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow"
                                    value="dinner"
                                >
                                    Dinner
                                </option>
                            </select>
                        </div>
                        <div class="flex justify-center item-center">
                            <PrimaryButton @click="addSchedule" class="w-full"
                                >Order</PrimaryButton
                            >
                        </div>
                    </form>
                </div>
                <template v-else>
                    <Login></Login>
                </template>
            </div>
        </div>
    </div>
</template>
<style scoped></style>
