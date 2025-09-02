<template>
  <div class="watch-container">
    <div class="watch-frame">
      <!-- Digital Crown -->
      <div class="digital-crown"></div>
      
      <!-- App Grid Container with Motion integration -->
      <motion.div
        ref="appContainer"
        class="app-container"
        :drag="isMobile ? false : 'x'"
        :dragConstraints="{ left: -350, right: 350 }"
        :dragElastic="0.1"
        :dragTransition="{ power: 0.2, timeConstant: 200 }"
        :style="{ y: verticalScroll }"
        @wheel="handleWheel"
        @touchstart="handleTouchStart"
        @touchmove.passive="handleTouchMove"
        @touchend="handleTouchEnd"
      >
        <motion.div
          v-for="app in apps"
          :key="app.id"
          :ref="el => { if (el) appRefs[app.id] = el }"
          class="app-icon"
          :style="getAppStyle(app)"
          @click="selectApp(app)"
          :title="app.name"
          :initial="{ scale: 0, opacity: 0 }"
          :animate="{
            scale: 1,
            opacity: getAppOpacity(app),
            transition: { 
              type: 'spring',
              stiffness: 300,
              damping: 20,
              delay: calculateStaggerDelay(app)
            }
          }"
          :whileHover="{ scale: 1.1, zIndex: 100 }"
          :whileTap="{ scale: 0.95 }"
          :layoutId="`app-${app.id}`"
        >
          {{ app.icon }}
        </motion.div>
      </motion.div>
      
      <!-- Page Indicators -->
      <div class="page-indicators">
        <div
          v-for="page in pageCount"
          :key="page"
          class="page-dot"
          :class="{ active: isActivePage(page - 3) }"
        ></div>
      </div>

      <!-- Vertical Scroll Indicator -->
      <motion.div 
        class="scroll-indicator"
        :animate="{ opacity: showScrollIndicator ? 1 : 0 }"
        transition={{ duration: 0.3 }}
      >
        <div class="scroll-dots">
          <div v-for="n in 3" :key="n" class="scroll-dot"></div>
        </div>
      </motion.div>
    </div>
    
    <!-- Instructions -->
    <div class="instructions">
      <p>Drag or scroll to navigate</p>
      <p>Icons scale based on distance from center</p>
    </div>
  </div>
</template>

<script>
import { ref, reactive, onMounted, onUnmounted, nextTick, computed } from 'vue'
import { motion, useMotionValue, useSpring, useTransform, useScroll, animate } from 'motion-v'

export default {
  name: 'AppleWatchHomeScreen',
  components: {
    motion
  },
  setup() {
    const appContainer = ref(null)
    const appRefs = ref({})
    
    // Motion values for horizontal and vertical scrolling
    const horizontalScroll = useMotionValue(0)
    const verticalScroll = useMotionValue(0)
    const smoothHorizontalScroll = useSpring(horizontalScroll, {
      damping: 30,
      stiffness: 200
    })
    const smoothVerticalScroll = useSpring(verticalScroll, {
      damping: 30,
      stiffness: 200
    })
    
    const isDragging = ref(false)
    const startX = ref(0)
    const startY = ref(0)
    const showScrollIndicator = ref(true)
    
    const hexSpacing = 80
    const baseSize = 60
    const maxSize = 80
    const minSize = 30
    const pageCount = 5
    const isMobile = ref(window.innerWidth < 768)

    // Transform horizontal scroll to page index
    const currentPage = useTransform(
      smoothHorizontalScroll,
      [-350, 0, 350],
      [-2, 0, 2]
    )

    // App data arranged in hexagonal grid
    const apps = ref([
      // Center group (page 0)
      { id: 1, icon: '⏰', color: '#000000', gridX: 0, gridY: 0, name: 'Clock' },
      { id: 2, icon: '📱', color: '#007AFF', gridX: -1, gridY: -1, name: 'Phone' },
      { id: 3, icon: '💌', color: '#FF3B30', gridX: 0, gridY: -1, name: 'Messages' },
      { id: 4, icon: '🎵', color: '#FF9500', gridX: 1, gridY: -1, name: 'Music' },
      { id: 5, icon: '📊', color: '#34C759', gridX: -1, gridY: 0, name: 'Stocks' },
      { id: 6, icon: '📷', color: '#8E8E93', gridX: 1, gridY: 0, name: 'Camera' },
      { id: 7, icon: '⚙️', color: '#8E8E93', gridX: 0, gridY: 1, name: 'Settings' },
      
      // Additional apps for vertical scrolling
      { id: 8, icon: '🌤️', color: '#5AC8FA', gridX: -2, gridY: -1, name: 'Weather' },
      { id: 9, icon: '🗺️', color: '#007AFF', gridX: -2, gridY: 0, name: 'Maps' },
      { id: 10, icon: '📝', color: '#FFCC02', gridX: -2, gridY: 1, name: 'Notes' },
      { id: 11, icon: '🏃', color: '#FF3B30', gridX: -3, gridY: 0, name: 'Fitness' },
      { id: 12, icon: '💳', color: '#000000', gridX: 2, gridY: -1, name: 'Wallet' },
      { id: 13, icon: '📞', color: '#34C759', gridX: 2, gridY: 0, name: 'FaceTime' },
      { id: 14, icon: '🎮', color: '#FF3B30', gridX: 2, gridY: 1, name: 'Games' },
      { id: 15, icon: '📺', color: '#000000', gridX: 3, gridY: 0, name: 'TV' },
      { id: 16, icon: '📧', color: '#007AFF', gridX: -4, gridY: 0, name: 'Mail' },
      { id: 17, icon: '📖', color: '#FF9500', gridX: -3, gridY: -1, name: 'Books' },
      { id: 18, icon: '🎨', color: '#5AC8FA', gridX: -3, gridY: 1, name: 'Art' },
      { id: 19, icon: '🔒', color: '#8E8E93', gridX: 4, gridY: 0, name: 'Security' },
      { id: 20, icon: '📱', color: '#34C759', gridX: 3, gridY: -1, name: 'Apps' },
      { id: 21, icon: '🌐', color: '#007AFF', gridX: 3, gridY: 1, name: 'Safari' },
      
      // Additional apps for vertical content
      { id: 22, icon: '📅', color: '#FF2D55', gridX: 0, gridY: 2, name: 'Calendar' },
      { id: 23, icon: '⏱️', color: '#4CD964', gridX: -1, gridY: 2, name: 'Stopwatch' },
      { id: 24, icon: '🎤', color: '#FF3B30', gridX: 1, gridY: 2, name: 'Voice Memos' },
      { id: 25, icon: '🧠', color: '#5AC8FA', gridX: 0, gridY: 3, name: 'Mindfulness' },
      { id: 26, icon: '📻', color: '#FF9500', gridX: -1, gridY: 3, name: 'Podcasts' },
      { id: 27, icon: '🔍', color: '#8E8E93', gridX: 1, gridY: 3, name: 'Find My' }
    ])

    // Calculate app opacity based on distance from center
    const getAppOpacity = (app) => {
      const x = app.gridX * hexSpacing * 0.87 + horizontalScroll.get()
      const distanceFromCenter = Math.abs(x) / 120
      const sizeFactor = Math.max(0.3, 1 - Math.pow(distanceFromCenter, 1.5) * 0.4)
      return Math.max(0.2, sizeFactor)
    }

    // Calculate stagger delay for entrance animation
    const calculateStaggerDelay = (app) => {
      const distanceFromCenter = Math.sqrt(app.gridX ** 2 + app.gridY ** 2)
      return distanceFromCenter * 0.05
    }

    // Calculate app position and size based on distance from center
    const calculateAppTransform = (app) => {
      const x = app.gridX * hexSpacing * 0.87 + horizontalScroll.get()
      const y = app.gridY * hexSpacing * 0.75 + (app.gridX % 2 === 0 ? 0 : hexSpacing * 0.375) + verticalScroll.get()
      
      // Distance from screen center
      const distanceFromCenter = Math.abs(x) / 120
      const sizeFactor = Math.max(0.3, 1 - Math.pow(distanceFromCenter, 1.5) * 0.4)
      const size = minSize + (maxSize - minSize) * sizeFactor
      
      return {
        x,
        y,
        size,
        opacity: Math.max(0.2, sizeFactor),
        zIndex: Math.round(sizeFactor * 100)
      }
    }

    // Get app styles
    const getAppStyle = (app) => {
      const transform = calculateAppTransform(app)
      return {
        backgroundColor: app.color,
        width: `${transform.size}px`,
        height: `${transform.size}px`,
        transform: `translate(calc(-50% + ${transform.x}px), calc(-50% + ${transform.y}px)) scale(${transform.size / baseSize})`,
        opacity: transform.opacity,
        fontSize: `${Math.max(16, transform.size * 0.35)}px`,
        zIndex: transform.zIndex,
        boxShadow: `0 ${transform.size * 0.1}px ${transform.size * 0.3}px rgba(0,0,0,${0.3 * transform.opacity})`
      }
    }

    // Handle wheel events for vertical scrolling
    const handleWheel = (e) => {
      e.preventDefault()
      
      if (Math.abs(e.deltaY) > Math.abs(e.deltaX)) {
        // Vertical scrolling
        const newScrollY = verticalScroll.get() - e.deltaY * 0.5
        const maxVerticalScroll = 200
        verticalScroll.set(Math.max(-maxVerticalScroll, Math.min(maxVerticalScroll, newScrollY)))
      } else {
        // Horizontal scrolling
        const newScrollX = horizontalScroll.get() - e.deltaX * 0.5
        const maxScroll = 350
        horizontalScroll.set(Math.max(-maxScroll, Math.min(maxScroll, newScrollX)))
      }
    }

    // Touch event handlers for mobile devices
    const handleTouchStart = (e) => {
      isDragging.value = true
      startX.value = e.touches[0].clientX
      startY.value = e.touches[0].clientY
    }

    const handleTouchMove = (e) => {
      if (!isDragging.value) return
      
      const deltaX = e.touches[0].clientX - startX.value
      const deltaY = e.touches[0].clientY - startY.value
      
      // Determine scroll direction based on initial movement
      if (Math.abs(deltaX) > Math.abs(deltaY) * 1.5) {
        // Horizontal scrolling
        const newScrollX = horizontalScroll.get() + deltaX
        const maxScroll = 350
        horizontalScroll.set(Math.max(-maxScroll, Math.min(maxScroll, newScrollX)))
      } else if (Math.abs(deltaY) > Math.abs(deltaX) * 1.5) {
        // Vertical scrolling
        const newScrollY = verticalScroll.get() + deltaY
        const maxVerticalScroll = 200
        verticalScroll.set(Math.max(-maxVerticalScroll, Math.min(maxVerticalScroll, newScrollY)))
      }
      
      startX.value = e.touches[0].clientX
      startY.value = e.touches[0].clientY
    }

    const handleTouchEnd = () => {
      isDragging.value = false
      
      // Hide scroll indicator temporarily
      showScrollIndicator.value = false
      setTimeout(() => {
        showScrollIndicator.value = true
      }, 2000)
    }

    // Page indicator helpers
    const isActivePage = (pageIndex) => {
      const currentPageValue = Math.round(-horizontalScroll.get() / 100)
      return Math.abs(currentPageValue - pageIndex) < 0.5
    }

    // App selection with animation
    const selectApp = (app) => {
      const appEl = appRefs.value[app.id]
      if (appEl) {
        animate(appEl, 
          { 
            scale: [1, 1.3, 1],
            rotate: [0, 360, 0]
          }, 
          { 
            duration: 0.6,
            easing: [0.68, -0.55, 0.265, 1.55]
          }
        )
      }
    }

    // Lifecycle hooks
    onMounted(() => {
      // Hide scroll indicator after initial display
      setTimeout(() => {
        showScrollIndicator.value = false
      }, 3000)
      
      // Handle window resize
      window.addEventListener('resize', handleResize)
    })

    onUnmounted(() => {
      window.removeEventListener('resize', handleResize)
    })

    const handleResize = () => {
      isMobile.value = window.innerWidth < 768
    }

    return {
      appContainer,
      appRefs,
      apps,
      horizontalScroll,
      verticalScroll,
      pageCount,
      getAppStyle,
      getAppOpacity,
      calculateStaggerDelay,
      handleWheel,
      handleTouchStart,
      handleTouchMove,
      handleTouchEnd,
      isActivePage,
      selectApp,
      showScrollIndicator,
      isMobile
    }
  }
}
</script>

<style scoped>
.watch-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  background: radial-gradient(circle at center, #1a1a1a 0%, #000000 100%);
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  padding: 2rem;
  overflow: hidden;
}

.watch-frame {
  position: relative;
  width: 400px;
  height: 400px;
  background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.1) 0%, rgba(0,0,0,0.3) 100%);
  border-radius: 50%;
  box-shadow: 
    inset 0 0 50px rgba(255,255,255,0.05),
    0 20px 40px rgba(0,0,0,0.3),
    0 0 0 4px rgba(255,255,255,0.1);
  overflow: hidden;
}

.digital-crown {
  position: absolute;
  right: -12px;
  top: 50%;
  transform: translateY(-50%);
  width: 24px;
  height: 60px;
  background: linear-gradient(90deg, #666, #999, #666);
  border-radius: 12px;
  box-shadow: 2px 0 10px rgba(0,0,0,0.3);
}

.digital-crown::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 16px;
  height: 16px;
  background: radial-gradient(circle, #bbb, #777);
  border-radius: 50%;
}

.app-container {
  position: absolute;
  inset: 0;
  user-select: none;
  touch-action: pan-y pinch-zoom;
}

.app-icon {
  position: absolute;
  left: 50%;
  top: 50%;
  border-radius: 20%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-weight: 600;
  cursor: pointer;
  transition: filter 0.2s ease;
  backdrop-filter: blur(1px);
  transform-origin: center;
}

.app-icon:hover {
  filter: brightness(1.1);
}

.page-indicators {
  position: absolute;
  bottom: 20px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  gap: 8px;
  z-index: 100;
}

.page-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.3);
  transition: all 0.3s ease;
}

.page-dot.active {
  background: rgba(255, 255, 255, 0.9);
  transform: scale(1.2);
}

.scroll-indicator {
  position: absolute;
  right: 15px;
  top: 50%;
  transform: translateY(-50%);
  z-index: 100;
}

.scroll-dots {
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.scroll-dot {
  width: 4px;
  height: 4px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.5);
}

.instructions {
  margin-top: 2rem;
  text-align: center;
  color: #888;
}

.instructions p {
  margin: 0.25rem 0;
  font-size: 0.875rem;
}

.instructions p:first-child {
  color: #aaa;
}

.instructions p:last-child {
  font-size: 0.75rem;
  color: #666;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .watch-frame {
    width: 350px;
    height: 350px;
  }
  
  .digital-crown {
    right: -10px;
    width: 20px;
    height: 50px;
  }
}
</style>