<script setup>
import { Head, Link } from "@inertiajs/vue3";
import axios from "axios";


</script>

<template>
    <Head :title="`${meal.name}`" />
   
    
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
        this.getRatings();
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

        getRatings() {
            axios
                .get("/rating" , this.meal.id)
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
