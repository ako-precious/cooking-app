<template>
  <div class="watch-home" ref="homeScreen">
    <div class="icon-grid" :style="gridStyle" @mousedown="startDrag" @mousemove="onDrag" @mouseup="endDrag" @mouseleave="endDrag">
      <div
        v-for="app in apps"
        :key="app.id"
        class="app-icon"
        :style="getIconStyle(app)"
      >
        <img :src="app.icon" :alt="app.name" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { useMouse } from '@vueuse/core';

const homeScreen = ref(null);
const apps = ref([
  // Sample app data
  { id: 1, name: 'Calendar', icon: 'https://via.placeholder.com/60/FF6347' },
  { id: 2, name: 'Messages', icon: 'https://via.placeholder.com/60/4682B4' },
  { id: 3, name: 'Photos', icon: 'https://via.placeholder.com/60/3CB371' },
  { id: 4, name: 'Weather', icon: 'https://via.placeholder.com/60/87CEFA' },
  { id: 5, name: 'Music', icon: 'https://via.placeholder.com/60/FFD700' },
  { id: 6, name: 'Settings', icon: 'https://via.placeholder.com/60/D3D3D3' },
  { id: 7, name: 'Mail', icon: 'https://via.placeholder.com/60/00BFFF' },
  { id: 8, name: 'Wallet', icon: 'https://via.placeholder.com/60/006400' },
  { id: 9, name: 'Workout', icon: 'https://via.placeholder.com/60/DC143C' },
]);

const gridPosition = ref({ x: 0, y: 0 });
const isDragging = ref(false);
const startDragPosition = ref({ x: 0, y: 0 });
const { x, y } = useMouse();

const onDrag = () => {
  if (!isDragging.value) return;
  const dx = x.value - startDragPosition.x;
  const dy = y.value - startDragPosition.y;
  gridPosition.value.x += dx;
  gridPosition.value.y += dy;
  startDragPosition.x = x.value;
  startDragPosition.y = y.value;
};

const startDrag = (event) => {
  isDragging.value = true;
  startDragPosition.x = event.clientX;
  startDragPosition.y = event.clientY;
};

const endDrag = () => {
  isDragging.value = false;
};

const gridStyle = computed(() => {
  return {
    transform: `translate(${gridPosition.value.x}px, ${gridPosition.value.y}px)`,
  };
});

const getIconStyle = (app) => {
  if (!homeScreen.value) return {};

  const rect = homeScreen.value.getBoundingClientRect();
  const centerX = rect.width / 2;
  const centerY = rect.height / 2;

  // Calculate icon position relative to the grid container
  // A more advanced version would need to calculate icon position from index
  // For this example, we'll use a placeholder calculation
  const iconX = 100; // Placeholder
  const iconY = 100; // Placeholder

  const distance = Math.sqrt(Math.pow(centerX - (iconX + gridPosition.value.x), 2) + Math.pow(centerY - (iconY + gridPosition.value.y), 2));
  
  // Scale logic: closer to center = larger scale
  const maxDistance = rect.width / 2;
  const normalizedDistance = Math.min(distance, maxDistance) / maxDistance;
  const scale = 1 - normalizedDistance * 0.8; // Scales from 1x to 0.2x

  return {
    transform: `scale(${scale})`,
  };
};
</script>

<style>
.watch-home {
  width: 1000px; /* Simulated watch face size */
  height: 1000px;
  border-radius: 50%;
  overflow: hidden;
  background: #000;
  position: relative;
}
.icon-grid {
  display: grid;
  grid-template-columns: repeat(6, 1fr); /* Example grid */
  gap: 20px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform-origin: center;
  /* Add more icons and adjust grid settings for a denser look */
}
.app-icon {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background: #333;
  transition: transform 0.2s ease-out;
}
</style>
