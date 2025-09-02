<script setup>
import { ref, reactive, onMounted, onBeforeUnmount } from "vue";
import { animate } from "motion-v";

const rows = 5;
const cols = 20; // number of columns
const items = Array.from({ length: rows * cols }, (_, i) => i + 1);

const containerRef = ref(null);
const viewport = reactive({ w: 0, h: 0 });

const spring = { type: "spring", stiffness: 300, damping: 25 };

onMounted(() => {
  const container = containerRef.value;
  const circles = container.querySelectorAll(".circle");

  const updateViewport = () => {
    viewport.w = window.innerWidth;
    viewport.h = window.innerHeight;
  };
  updateViewport();
  window.addEventListener("resize", updateViewport);

  const updateScales = () => {
    const centerX = viewport.w / 2;

    circles.forEach((circle) => {
      const rect = circle.getBoundingClientRect();
      const circleCenterX = rect.left + rect.width / 2;

      // Distance from viewport horizontal center
      const distance = Math.abs(circleCenterX - centerX);

      // Scale (closer = bigger, farther = smaller)
      const scale = Math.max(0.6, 1.6 - distance / 250);

      // Animate with motion-v
      animate(
        circle,
        { scale },
        { ...spring, duration: 0.3 }
      );
    });
  };

  // Initial call
  updateScales();

  // Scroll listener
  container.addEventListener("scroll", updateScales, { passive: true });

  onBeforeUnmount(() => {
    window.removeEventListener("resize", updateViewport);
    container.removeEventListener("scroll", updateScales);
  });
});
</script>

<template>
  <div
    ref="containerRef"
    class="scroll-container overflow-x-scroll overflow-y-hidden no-scrollbar"
  >
    <div
      class="grid gap-8 px-16 py-16"
      :style="{ gridTemplateRows: `repeat(${rows}, 1fr)` }"
    >
      <div
        v-for="(item, i) in items"
        :key="item"
        class="circle w-20 h-20 rounded-full bg-gray-300 flex items-center justify-center shrink-0"
        :style="{ 
          transform: `translateY(${(i % rows) % 2 === 0 ? 0 : 40}px)` 
        }"
      >
        {{ item }}
      </div>
    </div>
  </div>
</template>

<style>
.scroll-container {
  width: 100vw;
  height: 100vh;
}
.no-scrollbar::-webkit-scrollbar {
  display: none;
}
</style>
