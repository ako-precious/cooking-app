<script setup lang="ts">
import { motion, useScroll, useMotionValue, useMotionValueEvent, useDomRef, animate } from 'motion-v'
import { type CSSProperties } from 'vue'

const containerRef = useDomRef()
const { scrollXProgress } = useScroll({ container: containerRef })
const maskImage = useScrollOverflowMask(scrollXProgress)

const left = `0%`
const right = `100%`
const leftInset = `20%`
const rightInset = `80%`
const transparent = `#0000`
const opaque = `#000`

function useScrollOverflowMask(scrollXProgress) {
  const maskImage = useMotionValue(
    `linear-gradient(90deg, ${opaque}, ${opaque} ${left}, ${opaque} ${rightInset}, ${transparent})`
  )

  useMotionValueEvent(scrollXProgress, "change", (value) => {
    if (value === 0) {
      animate(
        maskImage,
        `linear-gradient(90deg, ${opaque}, ${opaque} ${left}, ${opaque} ${rightInset}, ${transparent})`
      )
    } else if (value === 1) {
      animate(
        maskImage,
        `linear-gradient(90deg, ${transparent}, ${opaque} ${leftInset}, ${opaque} ${right}, ${opaque})`
      )
    } else if (
      scrollXProgress.getPrevious() === 0 ||
      scrollXProgress.getPrevious() === 1
    ) {
      animate(
        maskImage,
        `linear-gradient(90deg, ${transparent}, ${opaque} ${leftInset}, ${opaque} ${rightInset}, ${transparent})`
      )
    }
  })

  return maskImage
}

/**
 * ==============   Styles   ================
 */

const example: CSSProperties = {
  width: '100vw',
  maxWidth: '400px',
  position: 'relative',
}

const progress: CSSProperties = {
  position: 'absolute',
  top: '-65px',
  left: '-15px',
  transform: 'rotate(-90deg)',
}

const bg: CSSProperties = {
  stroke: '#0b1011',
}

const circle: CSSProperties = {
  strokeDashoffset: 0,
  strokeWidth: '10%',
  fill: 'none',
}

const indicator: CSSProperties = {
  stroke: '#1B998B',
}

const list: CSSProperties = {
  display: 'flex',
  listStyle: 'none',
  height: '420px',
  // width: '100%',
  overflowX: 'scroll',
  padding: '20px 10px',
  flex: '0 0 600px',
  margin: '0 auto',
  gap: '20px',
}

const listItem: CSSProperties = {
  flex: '0 0 200px',
}
</script>

<template>
  <div id="example" :style="example" class="flex items-center justify-center">
    <svg id="progress" width="80" height="80" viewBox="0 0 100 100" :style="progress">
      <circle cx="50" cy="50" r="30" pathLength="1" class="bg" :style="bg" />
      <motion.circle cx="50" cy="50" r="30" class="indicator"
        :style="{ ...circle, ...indicator, pathLength: scrollXProgress }" />
    </svg>
    <motion.ul ref="containerRef" :style="{ ...list, maskImage } " class=" max-w-7xl w-[80rem]">
      <li :style="{ ...listItem, background: '#ff0088' }"></li>
      <li :style="{ ...listItem, background: '#dd00ee' }"></li>
      <li :style="{ ...listItem, background: '#9911ff' }"></li>
      <li :style="{ ...listItem, background: '#0d63f8' }"></li>
      <li :style="{ ...listItem, background: '#0cdcf7' }"></li>
      <li :style="{ ...listItem, background: '#4ff0b7' }"></li>
    </motion.ul>
  </div>
</template>

<style>
#example ::-webkit-scrollbar {
  height: 7px;
  width: 7px;
  background: rgba(0, 0, 0, 0.58);
  -webkit-border-radius: 1ex;
}

#example ::-webkit-scrollbar-thumb {
  background: #1b998a76;
  -webkit-border-radius: 1ex;
}

#example ::-webkit-scrollbar-corner {
  background: rgba(224, 13, 13, 0.632);
}
</style>
