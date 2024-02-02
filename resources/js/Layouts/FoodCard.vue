

<script setup>
import axios from "axios";
import PrimaryButton from "@/Components/PrimaryButton.vue";
defineProps(["meal"]);
</script>
<script>
export default {
    inheritAttrs: false,
    data() {
        return {
            userId: '' ,
            newSchedule: {
                meal_name: "",
                meal_time: "Choose a Meal Time",
                user_id:  "",
                start_date: "",
                end_date: "",
            },
            formattedEvents: [],
            newEventModalVisible: false,
            isHeaderFixed: false,
        };
    },
    created() {
        this.getMeals(), this.handleScroll(), this.filterMeals(), this.fetchData();
    },
    methods: {
        getMeals() {
            axios
                .get("/api/meals")
                .then((response) => {
                    this.meals = response.data;
                })
                .catch((error) => {
                    console.error("Error fetching data:", error);
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
            const scrollThreshold = 20;
            this.isHeaderFixed = window.scrollY > scrollThreshold;
        },
    },
};
</script>
<template>
    <div
        class="group relative m-auto flex w-full max-w-xs flex-col overflow-hidden rounded-xl bg-gradient-to-br from-[#e3dedf] to-[#ffffff] -shadow-snow-sm  hover:shadow-snow-md dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37]  dark:-shadow-oynx-sm hover:dark:shadow-oynx-md transition-all duration-250 ease-in delay-75"
    >
        <a class="relative flex h-54 overflow-hidden" href="#">
            <img
                class="object-cover h-fit"
                src="https://images.unsplash.com/photo-1484723091739-30a097e8f929?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fGZvb2R8ZW58MHx8MHx8fDA%3D"
                alt="product image"
            />
            <span
                class="absolute top-0 left-0 m-2 rounded-full bg-black px-2 text-center text-sm font-medium text-white"
                >New</span
            >
        </a>
        <div class="my-2 px-5 pb-3 transition-all duration-200 ease delay-75">
            <a href="#">
                <h5
                    class="text-lg font-bold tracking-tight text-oynx dark:text-snow text-nowrap"
                >
                   {{ meal.title }}
                </h5>
            </a>
            <div class="my-1 flex items-center justify-between">
                <a href="#" class=" ">
                    <span class="text-xs text-oynx dark:text-snow hover:font-bold ">{{ meal.cook.name }}</span>
                </a>
                <div class="flex items-center">
                    <font-awesome-icon icon="star" class="text-persian" />
                    <span
                        class="mr-2 ml-3 rounded bg-persian px-2.5 py-0.5 text-xs font-semibold"
                        >5.0</span
                    >
                </div>
            </div>
            <div class="flex items-center justify-between">
                <p>
                    <span class="text-lg font-bold text-oynx dark:text-snow"
                        >$14</span
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
                        icon="circle-plus" 
                        class="text-xl px-2 text-oynx active:text-persian hover:text-polynesian dark:text-snow dark:hover:text-lighred"
                    />
                    <font-awesome-icon
                        icon="share"
                        class="text-xl px-2 text-oynx active:text-persian hover:text-polynesian dark:text-snow  dark:hover:text-lighred"
                    />
                </div>
            </div>
        </div>
    </div>
    <div
            class="modal disable-scrollbars overflow-y-auto overflow-x-hidden fixed top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 z-[100] flex justify-center items-center backdrop-blur-sm w-full h-full"
            v-show="newEventModalVisible"
        >
            <div
                class="relative p-4 w-full max-w-md max-h-full transition-all duration-300 ease-in delay-200"
            >
                <div class="relative card rounded-lg shadow dark:card">
                    <button
                        @click="closeModal"
                        type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="popup-modal"
                    >
                        <font-awesome-icon
                            icon="fa-solid fa-close"
                            class="text-persian text-lg"
                        />
                        <span class="sr-only">Close modal</span>
                    </button>
                    <form @submit.prevent class="p-4 md:py-8 text-center">
                        <h2 class="text-oynx dark:text-snow font-bold text-xl">
                          New Meal Schedule
                        </h2>
                        <div class="py-4 relative">
                            <TextInput
                                class="my-2 w-full"
                                v-model="newSchedule.meal_name"
                                placeholder="Meal Name"
                            />
                            <TextInput
                                readonly
                                hidden
                                class="my-2 w-full"
                                type="number"
                                v-model= newSchedule.meal_id
                                placeholder=""
                            />
                            <TextInput
                                readonly
                                hidden
                                class="my-2 w-full"
                                type="number"
                                v-model= newSchedule.user_id
                                placeholder=""
                            />
                        </div>

                        <div class="py-4 flex justify-between">
                            <TextInput
                                class="w-[47%]"
                                v-model="newSchedule.start_date"
                                type="date"
                                placeholder=""
                            />
                            <TextInput
                                class="w-[47%]"
                                v-model="newSchedule.end_date"
                                type="date"
                                placeholder=""
                            />
                        </div>
                        <div class="py-4 flex justify-between">
                            <select
                                v-model="newSchedule.meal_time"
                                title="Meal Time" placeholder="Choose a meal time"
                                class="border-oynx bg-snow text-oynx dark:bg-oynx dark:text-snow bg-gradient-to-br from-[#e3dedf] to-[#ffffff] w-full shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] focus:shadow-none dark:focus:shadow-none dark:shadow-oynx-sm dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred rounded-md "
                            >
                                <option  selected                               
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow"                                   
                                >  {{ newSchedule.meal_time }}
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
                            class="flex justify-center item-center">
                            <PrimaryButton  @click="addSchedule" class="w-full">Save</PrimaryButton>
                        </div>

                       
                    </form>
                </div>
            </div>
        </div>
</template>
<style scoped>

</style>
