<script setup>
import { Head, Link } from "@inertiajs/vue3";
import axios from "axios";
import ApplicationMark from '@/Components/ApplicationMark.vue';
import SettingsDropdown from "@/Components/SettingsDropdown.vue";
import ShowRating from "@/Pages/Rating/Show.vue";
import Loader from "@/Components/Loader.vue";

import SocialLogin from "@/Pages/Auth/SocialLogin.vue"
import OrderCard from '@/Pages/Order/OrderCard.vue'
</script>

<template>
    <Head :title="`${meal.name}`" />
    <header class="relative py-3 px-5 md:px-12 bg-snow dark:bg-oynx z-990 transition-all duration-300 delay-75 ease-in animate-fade-in">
            <div
                :class="{ 'fix align-bottom shadow-sm' : isHeaderFixed }"
                class="flex justify-between items-center w-full bg-snow dark:bg-oynx"
            >
            <Link :href="route('welcome')" :class="{ 'absolute -left-16 ' : isHeaderFixed }" class=" transition-all duration-300 delay-75 ease-in animate-fade-in">
             <div class="w-full flex items-center">
                    <ApplicationMark class="block w-auto" />
                </div>
            </Link>
    
                <div
                    class="bg-transparent  w-4/12 sm:w-4/12 capitalize font-bold text-sm mr-4 flex justify-around  transition-all duration-300 delay-75 ease-in"
                    name=""
                    id=""
                >
                    <a href="#photo" class="py-2 px-3 navbar-link" >
                        <p>Photo</p>
                    </a>
                    
                    <a href="#detail" class="py-2 px-3 navbar-link" >
                        <p>Details</p>
                    </a>
                    <a href="#rating" class="py-2 px-3 navbar-link text-nowrap" >
                        <p>Ratings</p>
                    </a>
                    
                    
                </div>
                <div class="flex sm:items-center sm:ms-6">
                    <!-- Settings Dropdown -->
                    <div class="w-24"  @click="openModal()"  :class="{ 'lg:absolute  lg:-right-16 relative right-0 ' : isHeaderFixed }">  <SocialLogin class="group">
                              <template #logo>
                                <font-awesome-icon 
                      
                        icon="circle-plus"
                        class="text-xl px-2 group-hover:-ml-3 group-action-text "
                    />
                              </template>
                                <template #name>
                                    Order
                                </template>                             
                            </SocialLogin></div>
                    <div :class="{ 'absolute -right-16 lg:relative lg:right-0 ' : isHeaderFixed }">
                        <SettingsDropdown></SettingsDropdown>
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

                <div  class="lg:w-full py-8 relative">
                    <div id="detail" class="flex  flex-col lg:flex-row w-full relative">
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
                        <div class=" hidden  lg:block lg:w-1/2 ">
                            <div class="sticky max-w-md m-auto lg:p-12 top-0 z-10">
                                <div class="shadow-reverse rounded-lg">
                                    <OrderCard :newSchedule=newSchedule ></OrderCard>
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
        window.addEventListener("scroll", this.handleScroll);
    },
    created() {
        this.getPhoto();
        this.getPhotos();
    },
    beforeDestroy() {
        window.removeEventListener("scroll", this.handleScroll);
    },

    methods: {
        handleScroll() {
            // Adjust the scroll threshold as needed
            const scrollThreshold = 20;
            this.isHeaderFixed = window.scrollY > scrollThreshold;
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
