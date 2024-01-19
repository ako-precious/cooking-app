

 <template>
    <div class="container">
      <div class="header">
        <div class="monthDisplay">{{ formattedDate }}</div>
        <div>
          <button @click="navigate(-1)">Back</button>
          <button @click="navigate(1)">Next</button>
        </div>
      </div>
  
      <div class="weekdays ">
        <div v-for="weekday in weekdays" :key="weekday">{{ weekday }}</div>
      </div>
  
      <div class="calendar">
        <div v-for="day in calendarDays" :key="day.date" @click="openModal(day.date)" :class="{ 'day': true, 'currentDay': isCurrentDay(day), 'padding': day.isPadding }">
          {{ day.dayNumber }}
          <div v-if="day.event" class="event">{{ day.event.title }}</div>
        </div>
      </div>
    </div>
  
    <div class="modal" v-show="newEventModalVisible || deleteEventModalVisible">
      <h2>{{ newEventModalVisible ? 'New Event' : 'Event' }}</h2>
      <input v-model="eventTitle" placeholder="Event Title" :class="{ 'error': !eventTitle }" />
  
      <button @click="saveEvent" v-if="newEventModalVisible">Save</button>
      <button @click="deleteEvent" v-if="deleteEventModalVisible">Delete</button>
      <button @click="closeModal">Cancel</button>
    </div>
  
    <div class="backdrop" v-show="newEventModalVisible || deleteEventModalVisible"></div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        nav: 0,
        clicked: null,
        events: JSON.parse(localStorage.getItem('events')) || [],
        weekdays: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        newEventModalVisible: false,
        deleteEventModalVisible: false,
        eventTitle: '',
      };
    },
    computed: {
      formattedDate() {
        const dt = new Date();
        dt.setMonth(new Date().getMonth() + this.nav);
        return `${dt.toLocaleDateString('en-us', { month: 'long' })} ${dt.getFullYear()}`;
      },
      calendarDays() {
        const dt = new Date();
        dt.setMonth(new Date().getMonth() + this.nav);
  
        const day = dt.getDate();
        const month = dt.getMonth();
        const year = dt.getFullYear();
  
        const firstDayOfMonth = new Date(year, month, 1);
        const daysInMonth = new Date(year, month + 1, 0).getDate();
  
        const paddingDays = this.weekdays.indexOf(firstDayOfMonth.toLocaleDateString('en-us', { weekday: 'long' }));
  
        const calendarDays = [];
        for (let i = 1; i <= paddingDays + daysInMonth; i++) {
          const dayString = `${month + 1}/${i - paddingDays}/${year}`;
          const isPadding = i <= paddingDays;
          const eventForDay = this.events.find(e => e.date === dayString);
  
          calendarDays.push({
            date: dayString,
            dayNumber: isPadding ? '' : i - paddingDays,
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
        const eventForDay = this.events.find(e => e.date === this.clicked);
        if (eventForDay) {
          this.deleteEventModalVisible = true;
        } else {
          this.newEventModalVisible = true;
        }
      },
      closeModal() {
        this.eventTitle = '';
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
          localStorage.setItem('events', JSON.stringify(this.events));
          this.closeModal();
        }
      },
      deleteEvent() {
        this.events = this.events.filter(e => e.date !== this.clicked);
        localStorage.setItem('events', JSON.stringify(this.events));
        this.closeModal();
      },
      isCurrentDay(day) {
        const currentDate = new Date();
        const clickedDate = new Date(day.date);
        return currentDate.toDateString() === clickedDate.toDateString() && this.nav === 0;
      },
    },
  };
  </script>
  

   
  
<style scoped>

button {
  width: 75px;
  cursor: pointer;
  box-shadow: 0px 0px 2px gray;
  border: none;
  outline: none;
  padding: 5px;
  border-radius: 5px;
  color: white;
}

.header {
  padding: 10px;
  color: #d36c6c;
  font-size: 26px;
  font-family: sans-serif;
  display: flex;
  justify-content: space-between;
}
.header button {
  background-color:#92a1d1;
}
.container {
  width: 770px;
}
.weekdays {
  width: 100%;
  display: flex;
  color: #247BA0;
}
.weekdays div {
  width: 100px;
  padding: 10px;
}
.calendar {
  width: 100%;
  margin: auto;
  display: flex;
  flex-wrap: wrap;
}
.day {
  width: 100px;
  padding: 10px;
  height: 100px;
  cursor: pointer;
  box-sizing: border-box;
  background-color: white;
  margin: 5px;
  box-shadow: 0px 0px 3px #CBD4C2;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.day:hover {
  background-color: #e8faed;
}

.day + #currentDay {
  background-color:#e8f4fa;
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
  background-color: #FFFCFF !important;
  box-shadow: none !important;
}
.newEventModal, #deleteEventModal {
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
.cancelButton, #deleteButton {
  background-color: #d36c6c;
}
.saveButton, #closeButton {
  background-color: #92a1d1;
}
.eventText {
  font-size: 14px;
}
#modalBackDrop {
  display: none;
  top: 0px;
  left: 0px;
  z-index: 10;
  width: 100vw;
  height: 100vh;
  position: absolute;
  background-color: rgba(0,0,0,0.8);
}
</style>
