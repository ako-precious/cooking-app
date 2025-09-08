<script setup>
import { ref } from "vue";
import {
  useMotionValue,
  useTransform,
  useSpring,
  useScroll,
  useVelocity,
  useAnimationFrame,
  motion
} from "motion-v";
import { wrap } from "@motionone/utils";

// props
const props = defineProps({
  children: {
    type: String,
    required: true
  },
  baseVelocity: {
    type: Number,
    default: 100
  }
});

const baseX = useMotionValue(0);

// scroll tracking
const { scrollY } = useScroll();
const scrollVelocity = useVelocity(scrollY);

const smoothVelocity = useSpring(scrollVelocity, {
  damping: 50,
  stiffness: 400
});

const velocityFactor = useTransform(smoothVelocity, [0, 1000], [0, 5], {
  clamp: false
});

// map baseX to wrapped %
const x = useTransform(baseX, (v) => `${wrap(-20, -45, v)}%`);

const directionFactor = ref(1);

// animate per frame
useAnimationFrame((time, delta) => {
  let moveBy = directionFactor.value * props.baseVelocity * (delta / 1000);

  if (velocityFactor.get() < 0) {
    directionFactor.value = -1;
  } else if (velocityFactor.get() > 0) {
    directionFactor.value = 1;
  }

  moveBy += directionFactor.value * moveBy * velocityFactor.get();
  baseX.set(baseX.get() + moveBy);
});
</script>

<template>
  <div class="parallax overflow-hidden w-full">
    <motion.div class="scroller flex whitespace-nowrap text-snow " :style="{ x }">
      <span v-for="i in 4" :key="i" class="mr-4"> <slot />
        <!-- {{ children }} dsddsdddddddddddddddddddssssssssssssssssssssss Food made with love, not factories. Try authentic meals from real cooks nearby -->
      </span>
    </motion.div>
  </div>
</template>

<style scoped>
.parallax {
  position: relative;
  overflow: hidden;
  white-space: nowrap;
}

.scroller span {
  display: inline-block;
  font-size: 1.2rem;
  font-weight: bold;
    font-family: "Plaster", sans-serif;
  font-style: normal;
  -webkit-font-smoothing: antialiased;
}
</style>
