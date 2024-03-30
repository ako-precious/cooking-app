<script setup>
import { Head, Link } from "@inertiajs/vue3";
import axios from "axios";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
</script>

<template>
    <div class="" v-if="message">
        <div class="px-6 py-4 mt-1 bg-persian/20 rounded-lg text-persian">
            <span class="font-bold"> {{ message }} </span>
        </div>
    </div>
    <div class="" v-if="error">
        <div class="px-6 py-4 mt-1 bg-lighred/20 rounded-lg text-lighred">
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
</template>

<script>
export default {
    inheritAttrs: false,
    props: {
        newSchedule: Object,
    },
    data() {
        return {
            userId: '',
            message: "",
            error: "",           
            formattedEvents: [],
            newEventModalVisible: false,
        };
    },

    methods: {
       
        
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
                this.newSchedule.meal_time == "Choose a Meal time" ||
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
                            // console.log("Unable to add Meal !", err);
                        }, 10000);
                    });
            }
        },
    },
};
</script>
