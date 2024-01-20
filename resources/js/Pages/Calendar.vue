<template>
    <div class="container card dark:card rounded-lg pb-6 my-2 relative">
        <div class="flex items-center justify-between py-2">
            <div
                class="monthDisplay text-persian font-bold text-2xl capitalize"
            >
                {{ formattedDate }}
            </div>
            <div class=" ">
                <PrimaryButton class="mr-3" @click="navigate(-1)" title="Back">
                    <font-awesome-icon icon="backward" />
                </PrimaryButton>
                <PrimaryButton @click="navigate(1)" title="Next">
                    <font-awesome-icon icon="forward" />
                </PrimaryButton>
            </div>
        </div>

        <div class="weekdays grid grid-cols-7 text-oynx dark:text-snow">
            <div v-for="weekday in weekdays_short" :key="weekday">
                {{ weekday }}
            </div>
        </div>

        <div class="calendar grid grid-cols-7 py-2">
            <div
                v-for="day in calendarDays"
                :key="day.date"
                @click="openModal(day.date)"
                :class="{
                    day: true,
                    currentDay: isCurrentDay(day),
                    padding: day.isPadding,
                }"
            >
                {{ day.dayNumber }}
                <div v-if="day.event" class="event">{{ day.event.title }}</div>
            </div>
        </div>

        <!-- OPen Model  -->
        <div
            class="modal overflow-y-auto overflow-x-hidden fixed top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 z-50 flex justify-center items-center backdrop-blur-sm"
            v-show="newEventModalVisible || deleteEventModalVisible"
        >
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative card rounded-lg shadow dark:card">
                    <button
                        @click="closeModal"
                        type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="popup-modal"
                    >
                        <svg
                            class="w-3 h-3"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 14 14"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                            />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <h2>
                            {{ newEventModalVisible ? "New Event" : "Event" }}
                        </h2>
                        <div class="py-3">
                            <TextInput
                                v-model="eventTitle"
                                placeholder="Event Title"
                                :class="{ error: !eventTitle }"
                            />
                        </div>
                        <div class="py-3">
                            <label
                                for="countries_disabled"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Select Meal TIme</label
                            >

                           <Selection />

                           
                            
                        </div>
                        <div class="flex justify-center item-center">
                            <PrimaryButton
                                class="mr-3"
                                @click="saveEvent"
                                v-if="newEventModalVisible"
                                >Save
                            </PrimaryButton>
                            <SecondaryButton
                                @click="deleteEvent"
                                v-if="deleteEventModalVisible"
                                class="mr-4"
                            >
                                Delete</SecondaryButton
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div
        class="backdrop"
        v-show="newEventModalVisible || deleteEventModalVisible"
    ></div>
</template>

<script>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Selection from "@/Components/Selection.vue";
import TextInput from "@/Components/TextInput.vue";
export default {
    data() {
        return {
            nav: 0,
            clicked: null,
            events: JSON.parse(localStorage.getItem("events")) || [],
            weekdays: [
                "Sunday",
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
            ],
            weekdays_short: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            newEventModalVisible: false,
            deleteEventModalVisible: false,
            eventTitle: "",
        };
    },
    computed: {
        formattedDate() {
            const dt = new Date();
            dt.setMonth(new Date().getMonth() + this.nav);
            return `${dt.toLocaleDateString("en-us", {
                month: "long",
            })} ${dt.getFullYear()}`;
        },
        calendarDays() {
            const dt = new Date();
            dt.setMonth(new Date().getMonth() + this.nav);
            const day = dt.getDate();
            const month = dt.getMonth();
            const year = dt.getFullYear();
            const firstDayOfMonth = new Date(year, month, 1);
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const paddingDays = this.weekdays.indexOf(
                firstDayOfMonth.toLocaleDateString("en-us", { weekday: "long" })
            );
            const calendarDays = [];
            for (let i = 1; i <= paddingDays + daysInMonth; i++) {
                const dayString = `${month + 1}/${i - paddingDays}/${year}`;
                const isPadding = i <= paddingDays;
                const eventForDay = this.events.find(
                    (e) => e.date === dayString
                );
                calendarDays.push({
                    date: dayString,
                    dayNumber: isPadding ? "" : i - paddingDays,
                    isPadding,
                    event: eventForDay,
                });
            }
            return calendarDays;
        },
    },
    methods: {
        navigate(direction) {
            this.nav += direction;
        },
        openModal(date) {
            this.clicked = date;
            const eventForDay = this.events.find(
                (e) => e.date === this.clicked
            );
            if (eventForDay) {
                this.deleteEventModalVisible = true;
            } else {
                this.newEventModalVisible = true;
            }
        },
        closeModal() {
            this.eventTitle = "";
            this.newEventModalVisible = false;
            this.deleteEventModalVisible = false;
            this.clicked = null;
        },
        saveEvent() {
            if (this.eventTitle) {
                this.events.push({
                    date: this.clicked,
                    title: this.eventTitle,
                });
                localStorage.setItem("events", JSON.stringify(this.events));
                this.closeModal();
            }
        },
        deleteEvent() {
            this.events = this.events.filter((e) => e.date !== this.clicked);
            localStorage.setItem("events", JSON.stringify(this.events));
            this.closeModal();
        },
        isCurrentDay(day) {
            const currentDate = new Date();
            const clickedDate = new Date(day.date);
            return (
                currentDate.toDateString() === clickedDate.toDateString() &&
                this.nav === 0
            );
        },
    },
    components: { PrimaryButton, SecondaryButton, TextInput, Selection },
};
</script>

<style scoped>


.weekdays div {
    width: 100px;
    padding: 10px;
}

.day {
    /* width: 100px; */
    padding: 10px;
    height: 100px;
    cursor: pointer;
    box-sizing: border-box;
    background-color: white;
    margin: 1px;
    box-shadow: 0px 0px 3px #cbd4c2;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.day:hover {
    background-color: #e8faed;
}

.day + .currentDay {
    background-color: #e8f4fa;
}
.event {
    font-size: 10px;
    padding: 3px;
    background-color: #58bae4;
    color: white;
    border-radius: 5px;
    max-height: 55px;
    overflow: hidden;
}
.padding {
    cursor: default !important;
    background-color: #fffcff !important;
    box-shadow: none !important;
}
.newEventModal,
.deleteEventModal {
    display: none;
    z-index: 20;
    padding: 25px;
    background-color: #e8f4fa;
    box-shadow: 0px 0px 3px black;
    border-radius: 5px;
    width: 350px;
    top: 100px;
    left: calc(50% - 175px);
    position: absolute;
    font-family: sans-serif;
}
.eventTitleInput {
    padding: 10px;
    width: 100%;
    box-sizing: border-box;
    margin-bottom: 25px;
    border-radius: 3px;
    outline: none;
    border: none;
    box-shadow: 0px 0px 3px gray;
}
.eventTitleInput.error {
    border: 2px solid red;
}
.cancelButton,
.deleteButton {
    background-color: #d36c6c;
}
.saveButton,
.closeButton {
    background-color: #92a1d1;
}
.eventText {
    font-size: 14px;
}
.modalBackDrop {
    display: none;
    top: 0px;
    left: 0px;
    z-index: 10;
    width: 100vw;
    height: 100vh;
    position: absolute;
    background-color: rgba(0, 0, 0, 0.8);
}
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
    .dark\:dropdown {
        background: #303633;
        box-shadow: 15px 15px 30px #292e2b, -15px -15px 30px #373e3b;
    }
}
</style>
