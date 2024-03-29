<script setup>
import { Head, Link } from "@inertiajs/vue3";
import axios from "axios";

import DropBarNav from "@/Pages/Header/DropBarNav.vue";
import DateRangePicker from "@/Pages/Header/DateRangePicker.vue";
import Navbar from "@/Pages/Header/Navbar.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import ShowRating from "@/Pages/Rating/Show.vue";
import Loader from "@/Components/Loader.vue";
</script>

<template>
    <Head :title="`${meal.name}`" />
    <!-- <header
        class="bg-snow dark:bg-oynx z-990 transition-all duration-300 delay-75 ease-in animate-fade-in"
    >
        <Navbar class="bg-snow dark:bg-oynx">
            <template #search>
                <div
                    class="w-full p-4 max-w-xs lg:max-w-lg 2xl:max-w-2xl bg-snow dark:bg-oynx rounded-md flex items-center"
                >
                    <DateRangePicker
                        @filter-meals="filterMeals"
                        class="transition-all duration-300 delay-75 ease-in"
                    ></DateRangePicker>
                </div>
            </template>
            <template #dropdown>
                <DropBarNav />
            </template>
        </Navbar>
    </header> -->
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
                        {{ meal.name }}
                    </h1>
                </div>
                <div
                    class="flex flex-col lg:flex-row h-[20rem] overflow-scroll disable-scrollbars"
                >
                    <div class="lg:w-1/2">
                        <div class="overflow-hidden px-4 pb-4 lg:p-0">
                            <div v-if="isLoading" class="">
                                <Loader class="object-cover h-fit"></Loader>
                            </div>
                            <img
                                v-if="!isLoading"
                                class="h-auto max-w-full rounded-lg"
                                :src="src"
                                alt=""
                            />
                        </div>
                    </div>
                    <div
                        class="lg:w-1/2 px-4 grid grid-cols-2 md:grid-cols-3 gap-4"
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
                    <div class="flex flex-col lg:flex-row w-full relative">
                        <div class="lg:w-1/2">
                            <div class="flex items-center py-5">
                                <font-awesome-icon
                                    icon="user"
                                    class="mr-3 p-2 bg-oynx text-snow rounded-full"
                                />
                                <h1
                                    class="font-semibold text-xl text-oynx dark:text-snow"
                                >
                                    Cooked by {{ meal.user.name }}
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
                                        src="/images/ingredients.png"
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
                        <div class="lg:w-1/2 relative">
                            <div class="sticky lg:p-12 top-0 z-10">
                                <div class="shadow-reverse rounded-lg">
                                    <form
                                        @submit.prevent
                                        class="p-4 md:py-8 text-center"
                                    >
                                        <h2
                                            class="text-oynx dark:text-snow font-bold text-xl"
                                        >
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
                                        <div
                                            class="flex justify-center item-center"
                                        >
                                            <PrimaryButton
                                                @click="addSchedule"
                                                class="w-full"
                                                >Order</PrimaryButton
                                            >
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr
                class="h-px mb-2 bg-transparent bg-gradient-to-r from-transparent via-oynx/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-snow dark:to-transparent"
            />
            
            <div>
          <ShowRating :meal="meal"></ShowRating>
            </div>
            <hr
                class="h-px mb-2 bg-transparent bg-gradient-to-r from-transparent via-oynx/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-snow dark:to-transparent"
            />
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
            src: "",
            isLoading: true,
            other_src: "",
            imagePreviews: [],
            userId: "",
            message: "",
            error: "",
            newSchedule: {
                meal_name: "",
                meal_time: "",
                user_id: "",
                start_date: "",
                end_date: "",
            },
            formattedEvents: [],
            rating: [],
            newEventModalVisible: false,
            isHeaderFixed: false,
        };
    },
    mounted() {
        this.openModal();
    },
    created() {
        this.getPhoto();
        this.getPhotos();
    },
    methods: {
        filterMeals(searchText) {
            axios
                .get(`/api/filtered-meals?query=${searchText}`)
                .then((response) => {
                    if (response.data.length != 0) {
                        // Use Inertia to visit the directed page with the meals data as a prop
                        const meals = response.data;
                        console.log(meals);
                        this.$inertia.visit(
                            route("welcome"), // Navigate to the welcome route
                            { f_meals: meals } // Pass meals data as a prop
                        );
                    }
                })
                .catch((error) => {
                    console.error("Error fetching filtered data:", error);
                });
        },

        // getRatings() {
        //     axios
        //         .get("/rating" , this.meal.id)
        //         .then((response) => {
        //           console.log(response)
        //         })
        //         .catch((error) => {
        //             console.error("Error fetching data:", error);
        //         })
        //         .finally(() => {
        //             // Set loading state to false when fetching completes
        //             this.isLoading = false;
        //         });
        // },
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
                    this.other_src = response.data.otherPhotos.map((image) => ({
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
                    meal_time: "Choose a Meal time",
                };
            }
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
