<script setup>
import { defineComponent } from "vue";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";

import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
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
    mounted(){
        this.getMealSchedule()
        // console.log(this.orders.flat());
    },
    created() {       
            this.formatSchedule();
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
        class="container shadow-reverse rounded-lg py-6 my-2 relative text-oynx dark:text-snow"
    >
        <FullCalendar class="demo-app-calendar" :options="calendarOptions">
            <template v-slot:eventContent="arg">
                <b>{{ arg.timeText }}</b>
                <b>{{ arg.mealtime }}</b>
                <i>{{ arg.event.title }}</i>
            </template>
        </FullCalendar>
        
    </div>
</template>

