<script setup>
import { Head, Link } from "@inertiajs/vue3";

import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
defineProps(["meal"]);
</script>
<template>
    <td class="whitespace-nowrap px-6 py-3 font-bold">
        <Link :href="`//${meal.id}`" class="flex items-center j">
            <p class="">
                {{ meal.meal.name }}
            </p>
        </Link>
    </td>
    <!-- <td class="whitespace-nowrap px-6 py-3">{{  meal.meal.id }}</td> -->
    <td class="whitespace-nowrap px-6 py-3 font-semibold">
        {{ getCook(meal.meal.id) }}
    </td>
    <td class="whitespace-nowrap px-6 py-3 font-semibold">
        {{ meal.meal_time }}
    </td>
    <td class="whitespace-nowrap px-6 py-3 font-semibold">
        {{ FormattedDate(meal.created_at) }}
    </td>

    <td class="whitespace-nowrap px-6 py-3 text-center font-semibold">
        <div class="flex items-center">
            <p>
                {{ meal.status }}
            </p>
        </div>
    </td>

    <td class="whitespace-nowrap px-6 py-3">
        <div class="bg text-xl z-20 flex items-center">
            <div v-if="meal.status == 'accept'">
                <Link :href="`/process_order/${meal.id}`">
                    <div
                        class="p-2 cursor-pointer shadow-sm w-full hover:shadow-xs group"
                    >
                        <p
                            class="text-base font-semibold group-action-text capitalize"
                        >
                            Pay
                        </p>
                    </div></Link
                >
            </div>
            <div v-else-if="meal.status == 'delivered'">
                <div
                    @click="ChangeStatus('confirmed')"
                    class="p-2 cursor-pointer shadow-sm w-full hover:shadow-xs group"
                >
                    <p
                        class="text-base font-semibold group-action-text capitalize"
                    >
                        Confirm
                    </p>
                </div>
            </div>
            <div v-else-if="meal.status == 'confirmed'">
                <div
                    @click="openModal(meal.id)"
                    class="p-2 cursor-pointer shadow-sm w-full hover:shadow-xs group"
                >
                    <p
                        class="text-base font-semibold group-action-text capitalize"
                    >
                        Rate
                    </p>
                </div>
            </div>
        </div>
    </td>
    <div
        class="modal disable-scrollbars overflow-y-auto overflow-x-hidden fixed top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 z-[100] flex justify-center items-center backdrop-blur-sm w-full h-full"
        v-show="newEventModalVisible"
    >
        <div
            class="relative p-4 w-full max-w-xl max-h-full transition-all duration-300 ease-in delay-200"
        >
            <div class="relative shadow-reverse rounded-lg">
                <button
                    @click="closeModal"
                    type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="popup-modal"
                >
                    <font-awesome-icon
                        icon="fa-solid fa-close"
                        class="text-lighred text-3xl"
                    />
                    <span class="sr-only">Close modal</span>
                </button>
                <!-- <div class="" v-if="message">
                        <div
                            class="px-6 py-4 mt-1 bg-persian/20 rounded-lg text-persian"
                        >
                            <span class="font-bold"> {{ message }} </span>
                        </div>
                    </div>
                    <div class="" v-if="error">
                        <div
                            class="px-6 py-4 "
                        >
                            <InputError class="font-bold">{{ error }}</InputError>
                        </div>
                    </div> -->
                <form @submit.prevent class="p-4 md:py-8">
                   
                    <div class="flex flex-wrap justify-between">
                        <div class="py-4 w-[30%] relative flex flex-col">
                            <InputLabel
                                class="text-lg pb-2"
                                for="presentation"
                                value="Presentation"
                            />
                            <select
                                title="Meal Time"  v-model="newRating.presentation"
                                placeholder="Choose a meal time"
                                class="border-oynx bg-snow text-oynx dark:bg-oynx dark:text-snow w-full shadow-snow-sm ] focus:shadow-none dark:focus:shadow-none dark:shadow-oynx-sm dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred rounded-md"
                            >
                                <option
                                    selected
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                >
                                    Choose a rating
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="1"
                                >
                                    1
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="2"
                                >
                                    2
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="3"
                                >
                                    3
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="4"
                                >
                                    4
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="5"
                                >
                                    5
                                </option>
                            </select>
                        </div>
                        <div class="py-4 w-[30%] relative flex flex-col">
                            <InputLabel
                                class="text-lg pb-2"
                                for="taste"
                                value="Taste"
                            />
                            <select
                                title="Meal Time"  v-model="newRating.taste"
                                placeholder="Choose a meal time"
                                class="border-oynx bg-snow text-oynx dark:bg-oynx dark:text-snow w-full shadow-snow-sm ] focus:shadow-none dark:focus:shadow-none dark:shadow-oynx-sm dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred rounded-md"
                            >
                                <option
                                    selected
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                >
                                    Choose a rating
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="1"
                                >
                                    1
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="2"
                                >
                                    2
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="3"
                                >
                                    3
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="4"
                                >
                                    4
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="5"
                                >
                                    5
                                </option>
                            </select>
                        </div>
                        <div class="py-4 w-[30%] relative flex flex-col">
                            <InputLabel
                                class="text-lg pb-2"
                                for="value"
                                value="Value for Money"
                            />
                            <select v-model="newRating.value"
                                title="Meal Time"
                                placeholder="Choose a meal time"
                                class="border-oynx bg-snow text-oynx dark:bg-oynx dark:text-snow w-full shadow-snow-sm ] focus:shadow-none dark:focus:shadow-none dark:shadow-oynx-sm dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred rounded-md"
                            >
                                <option
                                    selected
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                >
                                    Choose a rating
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="1"
                                >
                                    1
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="2"
                                >
                                    2
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="3"
                                >
                                    3
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="4"
                                >
                                    4
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="5"
                                >
                                    5
                                </option>
                            </select>
                        </div>
                        <div class="py-4 w-[30%] relative flex flex-col">
                            <InputLabel
                                class="text-lg pb-2"
                                for="Nutrition"
                                value="Nutrition"
                            />
                            <select v-model="newRating.nutrition"
                                title="Meal Time"
                                placeholder="Choose a meal time"
                                class="border-oynx bg-snow text-oynx dark:bg-oynx dark:text-snow w-full shadow-snow-sm ] focus:shadow-none dark:focus:shadow-none dark:shadow-oynx-sm dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred rounded-md"
                            >
                                <option
                                    selected
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                >
                                    Choose a rating
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="1"
                                >
                                    1
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="2"
                                >
                                    2
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="3"
                                >
                                    3
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="4"
                                >
                                    4
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="5"
                                >
                                    5
                                </option>
                            </select>
                        </div>

                        <div class="py-4 w-[30%] relative flex flex-col">
                            <InputLabel
                                class="text-lg pb-2"
                                for="portion"
                                value="Portion"
                            /> 
                            <select v-model="newRating.portion"
                                title="Meal Time"
                                placeholder="Choose a meal time"
                                class="border-oynx bg-snow text-oynx dark:bg-oynx dark:text-snow w-full shadow-snow-sm focus:shadow-none dark:focus:shadow-none dark:shadow-oynx-sm dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred rounded-md"
                            >
                                <option
                                    selected
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                >
                                    Choose a rating
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="1"
                                >
                                    1
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="2"
                                >
                                    2
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="3"
                                >
                                    3
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="4"
                                >
                                    4
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow text-center"
                                    value="5"
                                >
                                    5
                                </option>
                            </select>
                        </div>
                        <div class="py-4 w-[30%] relative flex flex-col">
                            <InputLabel
                                class="text-lg pb-2"
                                for="portion"
                                value="Total Rating"
                            />
                            <TextInput v-model="newRating.total"
                                class="w-full"
                                type="number"
                                placeholder=""
                            />
                        </div>
                    </div>
                    <div class="py-4 relative flex flex-col">
                        <InputLabel
                            class="text-lg pb-2"
                            for="comment"
                            value="Comment"
                        />
                        <textarea v-model="newRating.comment"
                            autocomplete="other_info"
                            id="other_info"
                            class="mt-1 text-sm block w-full disable-scrollbars border-oynx bg-gradient-to-br from-[#e3dedf] to-[#ffffff] shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] focus:shadow-none dark:focus:shadow-none dark:shadow-oynx-sm dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred rounded-md text-oynx dark:text-snow"
                            rows="3"
                            cols="50"
                        ></textarea>
                    </div>

                    <div
                        class="flex justify-center item-center">
                        <PrimaryButton @click="addSchedule" class="w-full">Save</PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            meal_photo: "",
            user_name: "",
            message: "",
            error: "",
            newEventModalVisible: false,
            userId: this.$page.props.auth.user.id,

            newRating: {
                meal_id:"",
                user_id:"",
                presentation: "",
                taste: "",
                value: "",
                nutrition: "",
                portion_size: "",
                total: (presentation*taste*value*nutrition*portion_size)/5,
                comment: "",
            },
        };
    },
    created() {
        this.FormattedDate();
        this.truncatedIng();
        // this.getCook()
    },
    methods: {
        FormattedDate(timestamp) {
            const date = new Date(timestamp);
            const formattedDate = `${date.getFullYear()}-${(date.getMonth() + 1)
                .toString()
                .padStart(2, "0")}-${date
                .getDate()
                .toString()
                .padStart(2, "0")}`;
            return formattedDate;
        },
        truncatedIng(description) {
            // Check if description exists and has more than 30 characters
            if (description && description.length > 1) {
                // Truncate description to 30 characters and add ellipsis
                return description.slice(0, 1) + "...";
            } else {
                // Return full description if it's less than or equal to 30 characters
                return description;
            }
        },
        getCook(id) {
            axios
                .get("/meal/" + id)
                .then((response) => {
                    // console.log("Data sent successfully:", response.data.meal);
                    this.user_name = response.data.meal.user.name;
                })
                .catch((error) => {
                    console.error("Error sending data:", error);
                });
            return this.user_name;
        },
        ChangeStatus(status) {
            axios
                .put("/cook/order/" + this.meal.id, { status })
                .then((response) => {
                    console.log(
                        "Data sent successfully:",
                        response.data.order.status
                    );
                    // this.meal.status = response.data.order.status
                })
                .catch((error) => {
                    console.error("Error sending data:", error);
                });
        },
        addSchedule() {
            const today = new Date().toISOString().replace(/T.*$/, "");
            if (
                this.newSchedule.meal_name == "" ||
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

                        setTimeout(() => {
                            this.closeModal();
                            // Uncomment the line below if you want to toggle addingMode after the delay
                            // this.addingMode = !this.addingMode;
                        }, 5000);
                    })
                    .catch((err) => {
                        this.error = "Unable to add Meal !";
                        setTimeout(() => {
                            this.error = "";
                        }, 10000);
                    });
            }
        },
        openModal(meal) {
           

            // // Format the next day date as an ISO string without the time part
            // const nextDayISOString = nextDayDate
            //     .toISOString()
            //     .replace(/T.*$/, "");
            // // clear everything in the div and close it
            this.newEventModalVisible = true;


            newRating = {
                meal_id:"",
                user_id:"",
                presentation: "",
                taste: "",
                value: "",
                nutrition: "",
                portion_size: "",
                total:(presentation*taste*value*nutrition*portion_size)/5,
                comment: "",
            }

            // if (this.$page.props.auth.user) {
            //     // this.suggestedMeal = [];
            //     this.newSchedule = {
            //         meal_name: meal.title,
            //         meal_id: meal.id.toString(),
            //         user_id: this.$page.props.auth.user.id.toString(),
            //         start_date: nextDayISOString,
            //         end_date: nextDayISOString,
            //         meal_time: "Choose a Meal time",
            //     };
            // }
        },
        closeModal() {
            // clear everything in the div and close it
            this.newEventModalVisible = false;
            newRating = {
                meal_id:"",
                user_id:"",
                presentation: "",
                taste: "",
                value: "",
                nutrition: "",                
                portion_size: "",
                total:"",
                comment: "",
            };
            this.message = "";
            this.error = "";
        },
    },
};
</script>
