<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";

const cards = ref([
    {
        id: 1,
        layer: 2,
        step: "Step 3",
        header: "Enjoy Your Meal",
        text: "Sit back and relax — your fresh meal is delivered safely to your door, often by the next day. Every dish is cooked with care, packed securely, and tastes just like home.",
        image: "images/enjoymeal.jpg",
    },
    {
        id: 2,
        layer: 1,
        header: "Pick Your Plan",
        image: "images/mealplan.png",
        step: "Step 2",
        text: "One-time order or weekly plan starting at $54/week. Choose what fits your lifestyle. Flexible, affordable, and designed to take the stress out of mealtime.",
    },
    {
        id: 3,
        layer: 0,
        header: "Browse Meals Near You",
        image: "images/browsemeal.jpg",
        step: "Step 1",
        text: "Explore authentic dishes made by local cooks. See authentic home-style dishes prepared by trusted cooks in your community.",
    },
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
    <div class="bg-lavender dark:bg-oynx -my-20 py-10">
        <section
            class="my-20 flex flex-col items-center justify-center container relative"
        >
            <div>
                <h4
                    class="text-4xl font-bold text-oynx dark:text-snow uppercase text-center mt-4 max-w-md"
                >
                    3 Simple Steps to Enjoy Home-Cooked Comfort
                </h4>
                <h2></h2>
            </div>

            <div
                class="contain relative max-w-7xl w-[700px] h-[550px] flex flex-col items-center justify-center gap-20"
            >
                <div
                    v-for="card in cards"
                    :key="card.id"
                    class="card"
                    :data-layer="card.layer"
                    :class="{ 'moving-to-back': card.moving }"
                    :style="card.style"
                    @click="handleCardClick(card)"
                >
                    <!-- From Uiverse.io by Javierrocadev -->
                    <div
                        class="group cursor-pointer group overflow-hidden relative text-oynx dark:text-snow h-full w-full rounded-2xl hover:duration-700 duration-700"
                    >
                        <div class="w-full h-[90%] object-cover bg-persian">
                            <img
                                alt="..."
                                :src="card.image"
                                class="h-full w-auto align-middle object-cover rounded-t-lg"
                            />
                        </div>
                        <div
                            class="absolute bg-snow dark:bg-oynx -bottom-24 w-full p-3 flex flex-col gap-1 group-hover:-bottom-0 group-hover:duration-600 duration-500"
                        >
                            <span class="text-persian font-bold text-sm">{{
                                card.step
                            }}</span>
                            <span class="text-gray-800 font-bold text-3xl">{{
                                card.header
                            }}</span>
                            <p class="pb-4">{{ card.text }}</p>
                            <p>Click any card to cycle through👆</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="instructions text-oynx dark:text-snow">
                <!-- From Uiverse.io by nathAd17 -->
                <button
                    type="submit"
                    class="flex justify-center gap-2 items-center dark:text-snow mx-auto shadow-xl text-lg bg-gray-50 dark:bg-oynx_alt backdrop-blur-md lg:font-semibold isolation-auto border-gray-50 dark:border-oynx before:absolute before:w-full before:transition-all before:duration-700 before:hover:w-full before:-left-full before:hover:left-0 before:rounded-full before:bg-persian hover:text-gray-50 before:-z-10 before:aspect-square before:hover:scale-150 before:hover:duration-700 relative z-10 px-4 py-2 overflow-hidden border-2 rounded-full group"
                >
                    Feast your eyes, then your plate.
                    <svg
                        class="w-8 h-8 justify-end group-hover:rotate-90 group-hover:bg-gray-50 text-gray-50 ease-linear duration-300 rounded-full border border-gray-700 group-hover:border-none p-2 rotate-45"
                        viewBox="0 0 16 19"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M7 18C7 18.5523 7.44772 19 8 19C8.55228 19 9 18.5523 9 18H7ZM8.70711 0.292893C8.31658 -0.0976311 7.68342 -0.0976311 7.29289 0.292893L0.928932 6.65685C0.538408 7.04738 0.538408 7.68054 0.928932 8.07107C1.31946 8.46159 1.95262 8.46159 2.34315 8.07107L8 2.41421L13.6569 8.07107C14.0474 8.46159 14.6805 8.46159 15.0711 8.07107C15.4616 7.68054 15.4616 7.04738 15.0711 6.65685L8.70711 0.292893ZM9 18L9 1H7L7 18H9Z"
                            class="fill-gray-800 group-hover:fill-gray-800"
                        ></path>
                    </svg>
                </button>
            </div>
        </section>
    </div>
</template>

<style scoped>
.card {
    /* width: 700px; */
    height: 460px;
    border: solid 1px #bebebe;
    background-color: #073a34;
    position: absolute;
    border-radius: 10px;
    padding: 10px;
    color: #fff;
    box-shadow: 0px 8px 20px -10px #bbbbbb;
    text-shadow: 0px 0px 5px #fff;
    letter-spacing: 1px;

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

@media (min-width: 768px) {
    .card[data-layer="0"] {
        width: 540px;
    }

    .card[data-layer="1"] {
        width: 520px;
    }

    .card[data-layer="2"] {
        width: 500px;
    }
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
    font-size: 16px;
    text-align: center;
    background: rgba(255, 255, 255, 0.486);
    padding: 10px ;
    border-radius: 25px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.92);
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
