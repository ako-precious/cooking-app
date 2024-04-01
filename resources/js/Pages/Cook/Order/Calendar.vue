<script setup>
import { defineComponent } from "vue";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";

import HeaderVue from "../Header.vue";
import axios from "axios";
</script>
<script>
export default defineComponent({
    components: {
        FullCalendar,
    },
    props: {
        auth: Object,
        orders: Object,
    },
    data() {
        return {
            message: "",
            error: "",
            userId: this.$page.props.auth.user.id,
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
                select: this.handleDateSelect,
            },
        };
    },
    mounted() {
        this.getMealSchedule();
        // console.log(this.orders.flat());
    },
   
    methods: {
        getMealSchedule() {
            this.formatSchedules();
            this.updateCalendarOptions();
        },
        formatSchedules() {
            this.formattedEvents = this.orders.flat().map((schedule) => {
                try {
                    return {
                        id: schedule.id,
                        title: schedule.meal.name, // Access meal name instead of schedule.meal.title
                        start: schedule.start_date, // Assuming start_date is the property containing start date
                        end: schedule.end_date, // Assuming end_date is the property containing end date
                        meal_time: schedule.meal_time,
                        meal_id: schedule.meal.id,
                        user_id: schedule.user.id,
                        // Add other event properties as needed
                    };
                } catch (error) {
                    console.error("Error mapping event:", error);
                    return null;
                }
            });
        },

        updateCalendarOptions() {
            this.calendarOptions = {
                ...this.calendarOptions,
                events: this.formattedEvents,
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
                meal_id: meal_id.toString(),
                user_id: user_id.toString(),
                meal_time: meal_time,
                start_date: start,
                end_date: end,
            };
        },

        handleDateSelect(info) {
            // 'info' contains information about the selected range
            const start = info.startStr;
            const end = info.endStr;
            this.newEventModalVisible = true;
            this.addingMode = true;
            // console.log(start + end);

            this.newSchedule = {
                meal_name: "",
                meal_time: "Choose a Meal Time",
                user_id: this.userId.toString(),
                start_date: start,
                end_date: start,
                // end_date: end,
            };
        },
    },
});
</script>

<template>
    <Head title="Cooks Calendar" />
    <div
        class="relative sm:flex sm:justify-center sm:items-center bg-center bg-snow dark:bg-oynx selection:bg-red-500 selection:text-white"
    >
        <div class="container relative mx-auto overflow-hidden">
            <HeaderVue> </HeaderVue>
            <div
                class="m-auto flex flex-col justify-center h-full p-6 lg:pb-20 w-full"
            >
                <div class="w-full">
                    <div class="flex flex-col w-full">
                        <div class="py-5 lg:py-8">
                            <h1
                                class="font-semibold text-2xl lg:text-4xl text-oynx dark:text-snow"
                            >
                                Glad you're back,
                                <span class="capitalize">
                                    {{ firstWord }}
                                    <!-- {{ firstWord($page.props.auth.user.name ) }} -->
                                </span>
                            </h1>
                        </div>
                        <div class="w-full">
                            <FullCalendar class="demo-app-calendar" :options="calendarOptions">
            <template v-slot:eventContent="arg">
                <b>{{ arg.timeText }}</b>
                <b>{{ arg.mealtime }}</b>
                <i>{{ arg.event.title }}</i>
            </template>
        </FullCalendar>
                        </div>
                      
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
