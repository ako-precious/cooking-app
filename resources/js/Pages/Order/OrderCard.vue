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
import axios from "axios";


const dayNameToNumber = {
    Sunday: 0, Monday: 1, Tuesday: 2,
    Wednesday: 3, Thursday: 4, Friday: 5, Saturday: 6
};

export default {
    props: { newSchedule: Object },

    data() {
        return {
            userId: "",
            message: "",
            error: "",
            formattedEvents: [],
            newEventModalVisible: false,
            pickedDate: new Date(),
            limit_from: new Date(),
            limit_to: add(new Date(), { days: 20 }),
        };
    },

    methods: {
        pad(n) { return n.toString().padStart(2, "0"); },

        formatForMySQL(date) {
            const d = new Date(date);
            return `${d.getFullYear()}-${this.pad(d.getMonth() + 1)}-${this.pad(d.getDate())} ` +
                   `${this.pad(d.getHours())}:${this.pad(d.getMinutes())}:${this.pad(d.getSeconds())}`;
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
            let availability = this.newSchedule.cook_availability;

            try {
                if (!availability || availability.trim() === "") {
                    availability = Object.keys(dayNameToNumber);
                } else {
                    availability = JSON.parse(availability);
                    if (!Array.isArray(availability)) {
                        availability = JSON.parse(availability);
                    }
                    if (!availability.length) {
                        availability = Object.keys(dayNameToNumber);
                    }
                }
            } catch {
                availability = Object.keys(dayNameToNumber);
            }

            const allowedDays = availability.map(day => dayNameToNumber[day]);
            return !allowedDays.includes(getDay(date));
        },

        async addSchedule() {
            if (!this.$page.props.auth.user) return;

            const today = new Date().toISOString().split("T")[0];
            const { start_date, meal_time, portion, address, user_id } = this.newSchedule;

            if (!start_date || !meal_time || !portion || !address || !user_id) {
                return this.showError("Please fill in all fields to create your schedule.");
            }
            if (today >= start_date) {
                return this.showError("Schedules can only be created for future dates.");
            }

            this.formatSchedule();

            try {
                const resp = await axios.post("/schedule", this.formattedEvents);
                this.message = resp.data.message;

                const mealId = resp.data.data.id;
                this.$inertia.visit(
                    resp.data.data.status === "accepted" 
                        ? `/process_order/${mealId}`
                        : `/meal-schedule`
                );
            } catch (err) {
                this.showError("Unable to add Meal !");
                console.error("Error adding meal:", err);
            }
        },

        showError(msg) {
            this.error = msg;
            setTimeout(() => this.error = "", 10000);
        }
    }
};
</script>
