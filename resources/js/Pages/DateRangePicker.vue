<template>
  <div class="flex items-center space-x-2">
    <!-- Start Date Input -->
    <div class="relative inline-block">
      <input
        type="text"
        v-model="startDate"
        @focus="showPicker(true, 'startDate')"
        placeholder="Start Date"
        class="px-4 py-2 border rounded w-40"
      />
      <div v-show="showDatepicker.startDate" @click="showPicker(false, 'startDate')" class="fixed inset-0 z-10"></div>
      <div v-show="showDatepicker.startDate" class="absolute top-12 left-0 z-20">
        <div class="bg-white border rounded shadow p-4">
          <vue-datepicker v-model="startDate" :minDate="new Date()" :maxDate="endDate" />
        </div>
      </div>
    </div>

    <!-- To Label -->
    <span class="mx-2">to</span>

    <!-- End Date Input -->
    <div class="relative inline-block">
      <input
        type="text"
        v-model="endDate"
        @focus="showPicker(true, 'endDate')"
        placeholder="End Date"
        class="px-4 py-2 border rounded w-40"
      />
      <div v-show="showDatepicker.endDate" @click="showPicker(false, 'endDate')" class="fixed inset-0 z-10"></div>
      <div v-show="showDatepicker.endDate" class="absolute top-12 left-0 z-20">
        <div class="bg-white border rounded shadow p-4">
          <vue-datepicker v-model="endDate" :minDate="startDate" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';
import { format, addDays } from 'date-fns';
import VueDatepicker from 'vue3-datepicker';

export default {
  components: {
    VueDatepicker,
  },
  data() {
    return {
      showDatepicker: {
        startDate: false,
        endDate: false,
      },
      startDate: null,
      endDate: null,
    };
  },
  methods: {
    showPicker(value, field) {
      this.showDatepicker[field] = value;
    },
  },
};
</script>

<style>
/* Add Tailwind CSS styles here or in your global styles */
</style>
