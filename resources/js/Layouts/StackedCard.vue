<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";

const cards = ref([
  { id: 1, layer: 2, text: "Card stacks are awesome and inspired by real card stacks at your table. This is the foundation card." },
  { id: 2, layer: 1, text: "Card stacks are awesome and inspired by real card stacks at your table. Click me to see the magic!" },
  { id: 3, layer: 0, text: "Card stacks are awesome and inspired by real card stacks at your table. Interactive and smooth!" },
]);

const isAnimating = ref(false);
let autoCycleTimer = null;

const handleCardClick = (card) => {
  if (isAnimating.value) return;
  if (card.layer !== 0) return; // Only top card clickable
  cycleCards(card);
};

const cycleCards = (clickedCard) => {
  isAnimating.value = true;

  clickedCard.moving = true;

  setTimeout(() => {
    cards.value = cards.value.map((c) => {
      if (c.id === clickedCard.id) {
        return { ...c, layer: 2, moving: false };
      } else {
        return { ...c, layer: Math.max(0, c.layer - 1) };
      }
    });

    setTimeout(() => {
      isAnimating.value = false;
    }, 100);
  }, 200);
};

const startAutoCycle = (interval = 3000) => {
  autoCycleTimer = setInterval(() => {
    if (!isAnimating.value) {
      const topCard = cards.value.find((c) => c.layer === 0);
      if (topCard) cycleCards(topCard);
    }
  }, interval);
};

const stopAutoCycle = () => {
  if (autoCycleTimer) clearInterval(autoCycleTimer);
};

// Mouse movement effect
const handleMouseMove = (e) => {
  const mouseX = e.clientX / window.innerWidth;
  const mouseY = e.clientY / window.innerHeight;

  cards.value.forEach((card) => {
    const intensity = (3 - card.layer) * 2;
    const rotateY = (mouseX - 0.5) * intensity;
    const rotateX = (mouseY - 0.5) * -intensity;

    if (!card.moving) {
      card.style = `transform: rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
    }
  });
};

onMounted(() => {
  window.addEventListener("mousemove", handleMouseMove);
  // Uncomment to auto-cycle
  // startAutoCycle();
});

onBeforeUnmount(() => {
  window.removeEventListener("mousemove", handleMouseMove);
  stopAutoCycle();
});
</script>

<template>
  <div class="container">
    <div class="instructions">👆 Click any card to cycle through</div>

    <div
      v-for="card in cards"
      :key="card.id"
      class="card"
      :data-layer="card.layer"
      :class="{ 'moving-to-back': card.moving }"
      :style="card.style"
      @click="handleCardClick(card)"
    >
      <div class="card-number">{{ card.id }}</div>
      {{ card.text }}
    </div>
  </div>
</template>

<style scoped>
.container {
  position: relative;
  width: 300px;
  margin: auto;
  perspective: 1000px;
}
.instructions {
  text-align: center;
  margin-bottom: 10px;
  font-size: 14px;
  color: #555;
}
.card {
  position: absolute;
  width: 100%;
  padding: 20px;
  border-radius: 10px;
  background: white;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
  cursor: pointer;
  transition: transform 0.3s ease, opacity 0.3s ease;
}
.card[data-layer="0"] {
  z-index: 3;
}
.card[data-layer="1"] {
  z-index: 2;
  transform: translateY(10px) scale(0.95);
  opacity: 0.9;
}
.card[data-layer="2"] {
  z-index: 1;
  transform: translateY(20px) scale(0.9);
  opacity: 0.8;
}
.moving-to-back {
  transform: translateY(40px) scale(0.8) rotateZ(-5deg);
  opacity: 0.5;
}
.card-number {
  font-weight: bold;
  margin-bottom: 10px;
}
</style>
