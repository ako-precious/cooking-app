<script setup>
import { defineComponent } from "vue";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import { INITIAL_EVENTS, createEventId } from "@/event-utils";

import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Selection from "@/Components/Selection.vue";
import TextInput from "@/Components/TextInput.vue";
import axios from "axios";
</script>
<script>
export default defineComponent({
    components: {
        FullCalendar,
    },
    data() {
        return {
            suggestedMeal: [],
            schedules: [],
            formattedEvents: [],
            newEventModalVisible: false,
            newSchedule: {
                meal_name: "",
                meal_time: "",
                user_id: "",
                start_date: "",
                end_date: "",
            },
            addingMode: true,
            calendarOptions: {
                plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
                headerToolbar: {
                    right: "today prev next",
                    left: "title",
                },
                editable: true,
                selectable: true,
                selectMirror: true,
                dayMaxEvents: true,
                eventClick: this.handleEventClick,
            },
        };
    },
    created() {
        this.getMealSchedule(), this.closeModal(), this.getSuggestions();
    },
    methods: {
        getMealSchedule() {
            axios
                .get("/schedule")
                .then((response) => {
                    this.schedules = response.data;
                    this.formatSchedules();
                    this.updateCalendarOptions();
                })
                .catch((error) => {
                    console.error("Error fetching data:", error);
                });
        },
        formatSchedules() {
            this.formattedEvents = this.schedules.map((schedule) => {
                return {
                    id: schedule.id,
                    title: schedule.meal.title,
                    start: schedule.start,
                    end: schedule.end,
                    meal_time: schedule.meal_time,
                    meal_id: schedule.meal.id,
                    user_id: schedule.user.id,
                    // Add other event properties as needed
                };
            });
        },

        updateCalendarOptions() {
            this.calendarOptions = {
                ...this.calendarOptions,
                events: this.formattedEvents,
            };
        },

        closeModal() {
            // clear everything in the div and close it
            this.newEventModalVisible = false;
            this.suggestedMeal = [];
            this.newSchedule = {
                meal_name: "",
                start_date: "",
                end_date: "",
                meal_time: "",
            };
        },
        handleEventClick(arg) {
            this.addingMode = false;
            // 'info' contains information about the clicked event
            this.newEventModalVisible = true;
            const { id, title, start, end, meal_time, meal_id, user_id } =
                this.formattedEvents.find(
                    (event) => event.id === +arg.event.id
                );
            // console.log({ id, title, start, end, meal_time, meal_id, user_id });

            this.newSchedule = {
                id: id,
                meal_name: title,
                meal_id: meal_id,
                user_id: user_id,
                meal_time: meal_time,
                start_date: start,
                end_date: end,
            };
        },
        getSuggestions(field) {
            // Simulated  database request (replace with actual API call)

            axios
                .get(`/api/suggestions?query=${this.newSchedule[field]}`)
                .then((response) => {
                    console.log(this.newSchedule[field]);
                    console.log((this.suggestedMeal = response.data));
                })
                .catch((error) => {
                    console.error("Error fetching suggestions:", error);
                });
        },
        selectSuggestion(field, suggestion) {
            // Set the selected suggestion to the corresponding input field
            this.newSchedule[field] = suggestion;
            // Clear suggestions for the selected field
            this.suggestedMeal = [];
        },

        updateSchedule(id) {
            axios
                .put("/schedule/" + id, {
                    ...this.newSchedule,
                    //   console.log()
                })
                .then((resp) => {
                    this.closeModal();
                    this.getEvents();
                    this.addingMode = !this.addingMode;
                })
                .catch((err) =>
                    console.log("Unable to update event!", err.response)
                );
        },
        deleteSchedule(id) {
            axios
                .put("/schedule/" + id, {
                    ...this.newSchedule,
                })
                .then((resp) => {
                    this.resetForm();
                    this.getEvents();
                    this.addingMode = !this.addingMode;
                })
                .catch((err) =>
                    console.log("Unable to update event!", err.response.data)
                );
        },
    },
});
</script>
<!-- handleDateSelect(selectInfo) {
    console.log(selectInfo);
    this.newEventModalVisible = true;
    let title = 0;
    let calendarApi = selectInfo.view.calendar;
    console.log(calendarApi);

    calendarApi.unselect(); // clear date selection

    if (title) {
        calendarApi.addEvent({
            id: createEventId(),
            title,
            start: selectInfo.startStr,
            end: selectInfo.endStr,
            allDay: selectInfo.allDay,
        });
        
        this.newEventModalVisible = false;
    }
},
handleEventClick(clickInfo) {
    if (
        confirm(
            `Are you sure you want to delete the event '${clickInfo.event.title}'`
        )
    ) {
        clickInfo.event.remove();
    }
},
closeModal() {
    // this.mealName = "";
    this.newEventModalVisible = false;
},
handleEvents(events) {
    this.currentEvents = events;
}, -->
<template>
    <div
        class="container card dark:card rounded-lg py-6 my-2 relative text-oynx dark:text-snow"
    >
        <FullCalendar class="demo-app-calendar" :options="calendarOptions">
            <template v-slot:eventContent="arg">
                <b>{{ arg.timeText }}</b>
                <b>{{ arg.mealtime }}</b>
                <i>{{ arg.event.title }}</i>
            </template>
        </FullCalendar>
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
                            {{
                                newSchedule.meal_name == ""
                                    ? "New Meal"
                                    : "Meal"
                            }}
                        </h2>
                        <div class="py-4 relative">
                            <TextInput
                                class="my-2 w-full"
                                v-model="newSchedule.meal_name"
                                @input="getSuggestions('meal_name')"
                                placeholder="Meal Name"
                            />
                            <TextInput
                                hidden
                                class="my-2 w-full"
                                type="number"
                                @input="getSuggestions('meal_id')"
                                v-model="newSchedule.meal_id"
                                placeholder=""
                            />
                            <div
                                v-if="suggestedMeal.length > 0"
                                class="absolute bg-snow dark:bg-oynx w-full p-2 rounded-lg overflow-y-scroll disable-scrollbars max-h-[11rem]"
                            >
                                <div
                                    v-for="suggestion in suggestedMeal"
                                    :key="suggestion"
                                >
                                    <div
                                        @click="
                                            selectSuggestion(
                                                'meal_name',
                                                suggestion.name
                                            ),
                                                selectSuggestion(
                                                    'meal_id',
                                                    suggestion.id
                                                )
                                        "
                                        class="bg-oynx/10 border-oynx/10 text-sm text-oynx rounded-lg p-2 dark:bg-snow/10 dark:border-snow/20 dark:text-snow flex justify-between items-center w-full mb-1"
                                    >
                                        <div class="flex items-center">
                                            <img
                                                class="inline-block h-[2.875rem] w-[2.875rem] rounded-lg mr-2"
                                                src="https://images.unsplash.com/photo-1484723091739-30a097e8f929?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fGZvb2R8ZW58MHx8MHx8fDA%3D"
                                                alt="Image Description"
                                            />
                                            <span class="font-bold">{{
                                                suggestion.name
                                            }}</span>
                                        </div>
                                        <span class="font-bold">By</span>
                                        <div class="flex flex-col items-center">
                                            <img
                                                class="inline-block h-8 w-8 rounded-full"
                                                src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=300&h=300&q=80"
                                                alt="Image Description"
                                            />
                                            <span class="font-bold">{{
                                                suggestion.user.name
                                            }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-4 flex justify-between">
                            <TextInput
                                class="w-[47%]"
                                readonly
                                v-model="newSchedule.meal_time"
                            />

                            <Selection
                                class="w-[47%]"
                                v-model="newSchedule.meal_time"
                            >
                            </Selection>
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

                        <div
                            class="flex justify-center item-center"
                            v-if="addingMode"
                        >
                            <PrimaryButton class="w-full">Save</PrimaryButton>
                        </div>

                        <template v-else>
                            <div class="flex justify-center item-center">
                                <PrimaryButton
                                    class="mr-3"
                                    @click="updateSchedule(newSchedule.id)"
                                    v-if="newEventModalVisible"
                                    >Save
                                </PrimaryButton>
                                <SecondaryButton
                                    @click="deleteSchedule(newSchedule.id)"
                                    class="mr-4"
                                >
                                    Delete
                                </SecondaryButton>
                            </div>
                        </template>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.card {
    background: linear-gradient(145deg, #e3dedf, #ffffff);
    box-shadow: 10px 10px 15px #cac6c6, -10px -10px 15px #ffffff;
}
.card:hover {
    background: linear-gradient(145deg, #e3dedf, #ffffff);
    box-shadow: -10px -10px 15px #a19e9f, 10px 10px 15px #ffffff;
}
@media (prefers-color-scheme: dark) {
    .dark\:card {
        background: linear-gradient(145deg, #2b312e, #333a37);
        box-shadow: 10px 10px 15px #262b29, -10px -10px 15px #3a413d;
    }
    .dark\:card:hover {
        background: linear-gradient(145deg, #2b312e, #333a37);
        box-shadow: -10px -10px 15px #262b29, 10px 10px 15px #3a413d;
    }
}
</style>
