# Privacy Policy

Edit this file to define the privacy policy for your application.
<script setup>
import axios from "axios";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Datepicker from "vue3-datepicker";
import { ref } from "vue";
import { isBefore, getDay } from "date-fns";


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
        <h2 class="text-oynx dark:text-snow font-extrabold text-2xl">
            ${{ newSchedule.price }} CAD
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
                required
                class=""
                type="number"
                v-model="newSchedule.meal_id"
            />

           

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

        <div class=" gap-2 flex flex-col md:flex-row items-center justify-between">
           <div class=" md:w-1/2 w-full py-4">

               <Datepicker
                   class="my-2 w-full relative border-oynx bg-gradient-to-br from-[#e3dedf] to-[#ffffff] shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] focus:shadow-none dark:focus:shadow-none dark:shadow-oynx-sm dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred rounded-md text-oynx dark:text-snow"
                   v-model="pickedDate"
                   :clearable="true"
                   placeholder="Delivery Date"
                   :disabledDates="{ predicate: isDateDisabled }"
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
                required
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
            pickedDate: '',
          
            selectedDays: [2, 3, 0], // Replace with actual selected days from database
        };
    },

    methods: {
        
        formatSchedule() {
            this.newSchedule.start_date = this.pickedDate;
            this.newSchedule.meal_time = 'Lunch'
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
        isDateDisabled(date) {
              const id = this.newSchedule.cook_id
            axios
                        .get(`/cook/menu/` + id )
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
            const today = new Date();
            const day = getDay(date);
            const userSelectedDays = [0, 3, 4]; // Sunday (0), Wednesday (3), Thursday (4)

            // Disable past dates and dates not in userSelectedDays
            return isBefore(date, today) || !userSelectedDays.includes(day);
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
                }  else {
                    this.formatSchedule();
                   console.log( this.formattedEvents);
                    ;

                    // axios
                    //     .post("/schedule", this.formattedEvents)
                    //     .then((resp) => {
                    //         this.message = resp.data.message;

                    //         const MealId = resp.data.data.id;
                    //         console.log(resp.data.data);
                    //         // check if the schedule has been accepted or not
                    //         if (resp.data.data.status == "accepted") {
                    //             this.$inertia.visit(`/process_order/${MealId}`);
                    //         } else {
                    //             this.$inertia.visit(`/meal-schedule`);
                    //         }
                    //     })
                    //     .catch((err) => {
                    //         this.error = "Unable to add Meal !";
                    //         setTimeout(() => {
                    //             this.error = "";
                    //             console.log("Unable to add Meal !", err);
                    //         }, 10000);
                    //     });
                }
            }
        },
    },
};
</script>
