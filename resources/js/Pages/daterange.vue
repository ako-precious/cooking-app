<template>
    <div class="relative">
      <input
        v-model="startDate"
        @focus="showPicker = true"
        @blur="showPicker = false"
        placeholder="Start Date"
        class="w-32 py-2 px-4 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
      />
      <input
        v-model="endDate"
        @focus="showPicker = true"
        @blur="showPicker = false"
        placeholder="End Date"
        class="w-32 py-2 px-4 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
      />
  
      <div v-show="showPicker" class="absolute top-12 left-0 z-10 bg-white p-4 border border-gray-300 rounded">
        <!-- Your date range picker content goes here -->
        <p>Select start and end dates</p>
        <input type="date" v-model="startDate" />
        <input type="date" v-model="endDate" />
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        startDate: '',
        endDate: '',
        showPicker: false,
      };
    },
  };
  </script>
  
  <style scoped>
  /* Add any additional styling here */
  </style>
  