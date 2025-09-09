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
    <section class="my-20 flex items-center justify-center container relative">
     <div class="contain flex flex-col items-center justify-center gap-10 ">
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
    </section>
  
</template>

<style scoped>

        .contain {
            position: relative;
            margin-top: -100px;
            width: 360px;
            height: 200px;
        }

        .card {
            width: 540px;
            height: 300px;
            border: solid 1px #bebebe;
            background-color: #1f1f1f;
            position: absolute;
            border-radius: 10px;
            padding: 10px;
            color: #fff;
            box-shadow: 0px 8px 20px -10px #bbbbbb;
            text-shadow: 0px 0px 5px #fff;
            letter-spacing: 1px;
            background-image: radial-gradient(circle 160px at 50% 120%, #353535, #1f1f1f);
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            user-select: none;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 14px;
            line-height: 1.4;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 12px 25px -10px #bbbbbb;
        }

        .card:active {
            transform: translateY(0px);
        }

        /* Layer positions */
        .card[data-layer="0"] {
            z-index: 3;
            width: 340px;
            margin: 0px 0px 0px 0px;
            transform: translateX(0px) translateY(0px) scale(1);
        }

        .card[data-layer="1"] {
            z-index: 2;
            width: 320px;
            margin: -10px 0px 0px 10px;
            transform: translateX(0px) translateY(0px) scale(0.95);
        }

        .card[data-layer="2"] {
            z-index: 1;
            width: 300px;
            margin: -20px 0px 0px 20px;
            transform: translateX(0px) translateY(0px) scale(0.9);
        }

        /* Animation for moving to back */
        .card.moving-to-back {
            z-index: 0;
            transform: translateX(-50px) translateY(20px) scale(0.8) rotateY(15deg);
            opacity: 0.7;
        }

        /* Reset hover effect during animation */
        .card.moving-to-back:hover {
            transform: translateX(-50px) translateY(20px) scale(0.8) rotateY(15deg);
            box-shadow: 0px 8px 20px -10px #bbbbbb;
        }

        .instructions {
            position: absolute;
            top: -60px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-size: 16px;
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 10px 20px;
            border-radius: 25px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card-number {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 18px;
            font-weight: bold;
            opacity: 0.7;
        }
</style>
