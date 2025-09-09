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
  <div id="example" :style="example" class="flex items-center justify-center py-12">
    <svg id="progress" width="80" height="80" viewBox="0 0 100 100" :style="progress">
      <circle cx="50" cy="50" r="30" pathLength="1" class="bg" :style="bg" />
      <motion.circle cx="50" cy="50" r="30" class="indicator"
        :style="{ ...circle, ...indicator, pathLength: scrollXProgress }" />
    </svg>
    <motion.ul ref="containerRef" :style="{ ...list, maskImage } " class=" max-w-7xl w-[80rem]">
      <li :style="{ ...listItem, background: '#ff0088' }"> <div
                    class="group cursor-pointer group overflow-hidden relative text-gray-50 h-72 w-72 rounded-2xl hover:duration-700 duration-700"
                >
                    <div class="w-full h-72 bg-lime-400 text-gray-800">
                        <img
                            alt="..."
                            src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=700&amp;q=80"
                            class="hfull w-auto align-middle rounded-t-lg"
                        />
                    </div>
                    <div
                        class="absolute bg-gray-50 -bottom-24 w-full p-3 flex flex-col gap-1 group-hover:-bottom-0 group-hover:duration-600 duration-500"
                    >
                        <span class="text-lime-400 font-bold text-xs"
                            >TAILWIND</span
                        >
                        <span class="text-gray-800 font-bold text-3xl"
                            >Cheat Sheet</span
                        >
                        <p class="text-neutral-800">ddw</p>
                    </div>
                </div></li>
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
