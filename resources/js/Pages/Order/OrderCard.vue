<script setup>
import axios from "axios";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Datepicker from "vue3-datepicker";
import { ref } from "vue";
import { add } from "date-fns";

// References to store selected and disabled dates
const pickedDate = ref(new Date());

// Disable past dates and only allow Wednesday (3), Thursday (4), and Sunday (0)
const disableDates = (date) => {
    const day = date.getDay(); // Get the day of the week (0 for Sunday, 1 for Monday, etc.)
    
    // Define allowed days (Wednesday, Thursday, Sunday)
    const allowedDays = [0, 3, 4];
    
    // Disable past dates and dates not in allowedDays
    return date < new Date() || !allowedDays.includes(day);
};
const disabledDate = ref(add(new Date(), {
    
    
    days: 5 }));
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

    <form @submit.prevent class="p-4 md:py-8">
        <h2 class="text-oynx dark:text-snow font-extrabold text-2xl">
            ${{ newSchedule.price }} CAD
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
                class=""
                type="number"
                v-model="newSchedule.meal_id"
            />
            <Datepicker
                class="my-2 relative  w-full border-oynx bg-gradient-to-br from-[#e3dedf] to-[#ffffff] shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] focus:shadow-none dark:focus:shadow-none dark:shadow-oynx-sm dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred rounded-md text-oynx dark:text-snow"
                v-model="pickedDate" :clearable="true"
                title= "Select delivery date"
                :disabledDates="{ dates: [disabledDate] }">
                <template v-slot:clear="{ onClear }" >
                    <button @click="onClear" class=" absolute top-0 right-0 text-lighred" >x</button>
                </template>
            </Datepicker>

            <!--
               -->
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

        <div class="py-4 gap-2 flex justify-between">
            <TextInput
                v-model="newSchedule.portion"
                required
                class="pw-full"
                type="number"
                placeholder="Portion eg 1,2,3 "
            />
        </div>
        <div class="py-4 flex justify-between">
            <TextInput
                required
                class="w-full"
                v-model="newSchedule.address"
                placeholder="Address (Where you want it delivered)"
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
            <!-- <select
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
            </select> -->
        </div>
        <div class="flex justify-center item-center">
            <PrimaryButton @click="addSchedule" class="w-full"
                >Order</PrimaryButton
            >
        </div>
    </form>
</template>

<script>
import { ref } from "vue";
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
            options: {
                // ... other options
                disabledDates: (date) => {
                    const today = new Date();
                    const isPast = date < today;
                    const isNotSelected = !this.selectedDays.includes(
                        date.getDay()
                    );

                    return isPast || isNotSelected;
                },
            },
            selectedDays: [2, 3, 0], // Replace with actual selected days from database
        };
    },
    setup() {
        const selectedDate = ref(null);
        const allowedDays = ref([]);

        // Fetch allowed days from the database (example endpoint)
        axios
            .get("/api/user-allowed-days")
            .then((response) => {
                allowedDays.value = response.data.allowedDays; // Assuming the API returns { allowedDays: [3, 4, 0] }
            })
            .catch((error) => {
                console.error("Failed to fetch allowed days:", error);
            });

        const disableDates = (date) => {
            const today = new Date();
            const dayOfWeek = date.getDay();

            if (date < today || !allowedDays.value.includes(dayOfWeek)) {
                return true;
            }
            return false;
        };

        return {
            selectedDate,
            disableDates,
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
                portion: this.newSchedule.portion,
                address: this.newSchedule.address,
            };
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
