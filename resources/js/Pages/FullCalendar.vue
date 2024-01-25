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
    props: ["InitialEvent"],
    data() {
        return {
            newEventModalVisible: false,
            newSchedule: {
                meal_name: "",
                meal_time: "",
                user_id: "",
                start_date: "",
                end_date: "",
            },
            schedules: [],
            formattedEvents: "",
            calendarOptions: {
                plugins: [
                    dayGridPlugin,
                    timeGridPlugin,
                    interactionPlugin, // needed for dateClick
                ],
                headerToolbar: {
                    right: "today prev next",
                    left: "title",
                },

                editable: true,
                selectable: true,
                selectMirror: true,
                dayMaxEvents: true,
                events: this.formattedEvents,
            },
            currentEvents: [],
        };
    },
    created() {
        this.getMealSchedule(), this.formatSchedules();
    },
    methods: {
        getMealSchedule() {
            axios
                .get("/schedule")
                .then((resp) => (console.log(typeof(this.schedules = resp.data))))
                .catch((err) => console.log(err.response.data));
        },
        formatSchedules() {
            // this.formattedEvents = this.schedules.map((schedule) => {
            //     return {
            //         title: schedule.meal.title,
            //         start: schedule.start, // Use start and end dates from your data
            //         end: schedule.end,
            //         // Add other event properties as needed
            //     };
            // });
            if (Array.isArray(this.schedules)) {
                this.formattedEvents = this.schedules.value.map((schedule) => {
                    return {
                        title: schedule.meal.title,
                        start: schedule.start, // Use start and end dates from your data
                        end: schedule.end,
                        // Add other event properties as needed
                    };
                });
            } else {
                console.error("schedules is not an array:", typeof(this.schedules));
            }
        },
    },
    //   components: { PrimaryButton, SecondaryButton, TextInput, Selection },
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
        <li v-for="schedule in formattedEvents" :key="schedule.id">
            <p>User's Name: {{ schedule.title }}</p>
            <p>Meal Time: {{ schedule.end }}</p>
            <!-- Add other fields as needed -->
        </li>
        <FullCalendar class="demo-app-calendar" :options="calendarOptions">
            <template v-slot:eventContent="arg">
                <b>{{ arg.timeText }}</b>
                <b>{{ arg.mealtime }}</b>
                <i>{{ arg.event.title }}</i>
            </template>
        </FullCalendar>
        <div
            class="modal overflow-y-auto overflow-x-hidden fixed top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 z-50 flex justify-center items-center backdrop-blur-sm w-full h-full"
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
                        <h2 class="text-oynx dark:text-snow">
                            {{ newEventModalVisible ? "New Meal" : "Meal" }}
                        </h2>
                        <div class="py-4">
                            <TextInput
                                class="my-2"
                                v-model="newSchedule.meal_name"
                                placeholder="Meal Name"
                            />
                        </div>
                        <div class="py-4">
                            <Selection></Selection>
                        </div>
                        <div class="flex justify-center item-center">
                            <PrimaryButton
                                class="mr-3"
                                @click="handleDateSelect(selectInfo)"
                                v-if="newEventModalVisible"
                                >Save
                            </PrimaryButton>
                            <!-- <SecondaryButton
                                @click="deleteEvent"
                                v-if="deleteEventModalVisible"
                                class="mr-4"
                            >
                                Delete</SecondaryButton
                            > -->
                        </div>
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
