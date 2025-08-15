<script setup>
import axios from "axios";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Datepicker from "vue3-datepicker";
import { ref } from "vue";
import { add, isBefore, getDay } from "date-fns";
</script>

<template>
    <div class="" v-if="message">
        <div class="px-6 py-3 mt-1 bg-persian/20 rounded-lg text-persian">
            <span class="font-bold"> {{ message }} </span>
        </div>
    </div>
    <div class="" v-if="error">
        <div class="px-6 py-3 mt-1 bg-lighred/20 rounded-lg text-lighred">
            <span class="font-bold">{{ error }}</span>
        </div>
    </div>

    <form @submit.prevent class="p-4 md:py-8">
        <h2 v-if="newSchedule.prices" class="text-oynx dark:text-snow font-extrabold text-2xl">
            ${{ newSchedule.prices.price }} CAD
        </h2>
        <div class="py-3 relative">
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
                class=""
                type="number"
                v-model="newSchedule.meal_id"
            />

            <TextInput
                readonly
                hidden
                class="my-2 w-full"
                type="number"
                v-model="newSchedule.user_id"
                placeholder=""
            />
        </div>

        <div
            class="gap-2 flex flex-col md:flex-row items-center justify-between"
        >
            <div class="md:w-1/2 w-full py-4">
                <Datepicker
                    class="my-2 w-full relative border-oynx bg-gradient-to-br from-[#e3dedf] to-[#ffffff] shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] focus:shadow-none dark:focus:shadow-none dark:shadow-oynx-sm dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred rounded-md text-oynx dark:text-snow"
                    v-model="pickedDate"
                    :clearable="true"
                    :disabledDates="{ predicate: isDateDisabled }"
                    :upper-limit="limit_to"
                    :lower-limit="limit_from"
                    placeholder="Delivery Date"
                >
                    <template v-slot:clear="{ onClear }">
                        <button
                            @click="onClear"
                            class="absolute top-0 right-0 text-lighred"
                        >
                            x
                        </button>
                    </template>
                </Datepicker>
            </div>
            <div class="w-full py-3 md:w-1/2">
                <TextInput
                    v-model="newSchedule.portion"
                    required
                    class="w-full"
                    type="number"
                    placeholder="Portion eg 1,2,3 "
                />
            </div>
        </div>

        <div class="py-3 flex justify-between">
            <TextInput
                required
                class="w-full"
                v-model="newSchedule.address"
                placeholder="Address (Where you want it delivered)"
            />
            <TextInput
                hidden
                class="w-[47%]"
                v-model="newSchedule.cook_id"
                type="date"
                placeholder=""
            />
            <TextInput
                hidden
                class="w-[47%]"
                v-model="newSchedule.end_date"
                type="date"
                placeholder=""
            />
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
            userId: "",
            message: "",
            error: "",
            formattedEvents: [],
            newEventModalVisible: false,
            pickedDate: ref(new Date()),
            limit_from: ref(new Date()),
            limit_to: ref(add(new Date(), { days: 20 })),
        };
    },

    methods: {
        formatForMySQL(datetime) {
            const date = new Date(datetime);

            // Pad to 2 digits
            const pad = (n) => n.toString().padStart(2, "0");

            const formatted =
                `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(
                    date.getDate()
                )} ` +
                `${pad(date.getHours())}:${pad(date.getMinutes())}:${pad(
                    date.getSeconds()
                )}`;

            return formatted;
        },
        formatSchedule() {
            this.newSchedule.start_date = this.pickedDate;
            this.newSchedule.meal_time = "Lunch";
            this.formattedEvents = {
                meal_id: this.newSchedule.meal_id,
                user_id: this.newSchedule.user_id,
                meal_time: this.newSchedule.meal_time,
                start_date: this.formatForMySQL(this.newSchedule.start_date),
                end_date: this.formatForMySQL(this.newSchedule.end_date),
                portion: this.newSchedule.portion,
                prices: this.newSchedule.prices,
                address: this.newSchedule.address,
            };
        },

        isDateDisabled(date) {
            // const id = this.newSchedule;
            // console.log(id);

            // Define a mapping from day names to day numbers
            const dayNameToNumber = {
                Sunday: 0,
                Monday: 1,
                Tuesday: 2,
                Wednesday: 3,
                Thursday: 4,
                Friday: 5,
                Saturday: 6,
            };

            // Map availability day names to day numbers
            const today = new Date();
            const day = getDay(date);
            // // const userSelectedDays = [0, 3, 4];
            // console.log( typeof this.newSchedule.cook_availability);
            // console.log( this.newSchedule.cook_availability);

            if (this.newSchedule.cook_availability) {
                console.log(this.newSchedule.cook_availability);

                // Check if cook_availability is an empty string
                if (this.newSchedule.cook_availability.trim() === "") {
                    console.warn("cook_availability is an empty string.");
                    return false; // or some default behavior
                }

                try {
                    // Parse cook_availability JSON string into an array
                    const array1 = JSON.parse(
                        this.newSchedule.cook_availability
                    );
                    let array = Array.isArray(array1)
                        ? array1
                        : JSON.parse(array1);

                    // If array is empty or not parsed correctly, use all days of the week as a default
                    if (!Array.isArray(array) || array.length === 0) {
                        console.warn("Using default days of the week.");
                        array = [
                            "Monday",
                            "Tuesday",
                            "Wednesday",
                            "Thursday",
                            "Friday",
                            "Saturday",
                            "Sunday",
                        ];
                    }

                    // Map days to their numerical values using a predefined mapping object
                    const userSelectedDays = array.map(
                        (day) => dayNameToNumber[day]
                    );

                    // Disable past dates and dates not in userSelectedDays
                    return !userSelectedDays.includes(day);
                } catch (error) {
                    console.error(
                        "Error parsing JSON or mapping array:",
                        error
                    );
                    return false; // or some default behavior
                }
            } else {
                // console.warn("cook_availability is undefined or empty.");
                // console.warn(this.newSchedule.cook_availability);

                // Use default array with all days of the week
                const array = [
                    "Monday",
                    "Tuesday",
                    "Wednesday",
                    "Thursday",
                    "Friday",
                    "Saturday",
                    "Sunday",
                ];
                const userSelectedDays = array.map(
                    (day) => dayNameToNumber[day]
                );

                return !userSelectedDays.includes(day); // Based on userSelectedDays
            }
        },

        addSchedule() {
            if (this.$page.props.auth.user) {
                const today = new Date().toISOString().replace(/T.*$/, "");
                if (
                    this.newSchedule.start_date == "" ||
                    this.newSchedule.meal_time == "" ||
                    this.newSchedule.portion == "" ||
                    this.newSchedule.address == "" ||
                    this.newSchedule.user_id == ""
                ) {
                    this.error =
                        "Please fill in all  fields to create your schedule.";
                } else if (today >= this.newSchedule.start_date) {
                    this.error =
                        "Schedules can only be created for future dates. Would you like to choose a future date for the start, or cancel this schedule? ";
                } else {
                    this.formatSchedule();
                    console.log(this.formattedEvents);

                    axios
                        .post("/schedule", this.formattedEvents)
                        .then((resp) => {
                            this.message = resp.data.message;

                            const MealId = resp.data.data.id;
                            console.log(resp.data.data);
                            // check if the schedule has been accepted or not
                            if (resp.data.data.status == "accepted") {
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
            }
        },
    },
};
</script>
