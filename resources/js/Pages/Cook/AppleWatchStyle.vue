<template>
  <div class="watch-container">
    <div class="watch-frame">
      <!-- Digital Crown -->
      <!-- <div class="digital-crown"></div> -->
      
      App Grid Container
      <div 
        ref="appContainer"
        class="app-container"
        v-motion
        :style="containerStyle"
      >
        <div
          v-for="app in apps"
          :key="app.id"
          :ref="el => { if (el) appRefs[app.id] = el }"
          class="app-icon"
          v-motion
          :style="getAppMotionStyle(app)"
          @click="selectApp(app)"
          :title="app.name"
        >
          {{ app.icon }}
        </div>
      </div>
      
      <!-- Page Indicators -->
      <!-- <div class="page-indicators">
        <div
          v-for="pageX in pageCountX"
          :key="`x-${pageX}`"
          class="page-dot horizontal"
          v-motion
          :style="getPageDotStyle(pageX - Math.ceil(pageCountX/2), 'x')"
        ></div>
      </div> -->
      
      <!-- <div class="page-indicators vertical">
        <div
          v-for="pageY in pageCountY"
          :key="`y-${pageY}`"
          class="page-dot"
          v-motion
          :style="getPageDotStyle(pageY - Math.ceil(pageCountY/2), 'y')"
        ></div>
      </div> -->
    </div>
    
    <!-- Instructions -->
    <div class="instructions">
      <p>Drag horizontally & vertically • Icons scale from center</p>
      <p>Use Digital Crown or mouse wheel for precise navigation</p>
    </div>
  </div>
</template>

<script>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { 
  useMotionValue, 
  useTransform, 
  animate, 
  useSpring,
  useDragControls
} from 'motion-v'

export default {
  name: 'AppleWatchHomeScreen',
  setup() {
    const appContainer = ref(null)
    const appRefs = ref({})
    const isDragging = ref(false)
    
    // Motion values for 2D scrolling
    const x = useMotionValue(0)
    const y = useMotionValue(0)
    const dragControls = useDragControls()
    
    // Spring configuration for natural feel
    const springConfig = { 
      stiffness: 400, 
      damping: 35, 
      mass: 0.8 
    }
    
    // Transform positions with elastic boundaries
    const constrainedX = useTransform(x, (value) => {
      const maxScroll = 400
      const minScroll = -400
      
      if (value > maxScroll) {
        const overshoot = value - maxScroll
        return maxScroll + overshoot * 0.25
      } else if (value < minScroll) {
        const overshoot = minScroll - value  
        return minScroll - overshoot * 0.25
      }
      return value
    })
    
    const constrainedY = useTransform(y, (value) => {
      const maxScroll = 300
      const minScroll = -300
      
      if (value > maxScroll) {
        const overshoot = value - maxScroll
        return maxScroll + overshoot * 0.25
      } else if (value < minScroll) {
        const overshoot = minScroll - value  
        return minScroll - overshoot * 0.25
      }
      return value
    })
    
    // Create springs for smooth movement
    const springX = useSpring(constrainedX, springConfig)
    const springY = useSpring(constrainedY, springConfig)
    
    const hexSpacing = 75
    const verticalSpacing = 85
    const baseSize = 52
    const maxSize = 72
    const minSize = 26
    const pageCountX = 7
    const pageCountY = 5

    // Enhanced app data with 2D grid positioning
    const apps = ref([
      // Center cluster (0, 0)
      { id: 1, icon: '⏰', color: '#1C1C1E', gridX: 0, gridY: 0, name: 'Clock' },
      { id: 2, icon: '📱', color: '#007AFF', gridX: -1, gridY: -1, name: 'Phone' },
      { id: 3, icon: '💬', color: '#34C759', gridX: 0, gridY: -1, name: 'Messages' },
      { id: 4, icon: '🎵', color: '#FF3B30', gridX: 1, gridY: -1, name: 'Music' },
      { id: 5, icon: '📊', color: '#5856D6', gridX: -1, gridY: 0, name: 'Stocks' },
      { id: 6, icon: '📷', color: '#8E8E93', gridX: 1, gridY: 0, name: 'Camera' },
      { id: 7, icon: '⚙️', color: '#8E8E93', gridX: 0, gridY: 1, name: 'Settings' },
      
      // Left cluster (-1, 0)
      { id: 8, icon: '🌤️', color: '#30B0C7', gridX: -2.5, gridY: -1, name: 'Weather' },
      { id: 9, icon: '🗺️', color: '#007AFF', gridX: -2.5, gridY: 0, name: 'Maps' },
      { id: 10, icon: '📝', color: '#FFD60A', gridX: -2.5, gridY: 1, name: 'Notes' },
      { id: 11, icon: '🏃', color: '#FF453A', gridX: -4, gridY: 0, name: 'Fitness' },
      
      // Right cluster (1, 0)
      { id: 12, icon: '💳', color: '#1C1C1E', gridX: 2.5, gridY: -1, name: 'Wallet' },
      { id: 13, icon: '📞', color: '#32D74B', gridX: 2.5, gridY: 0, name: 'FaceTime' },
      { id: 14, icon: '🎮', color: '#5E5CE6', gridX: 2.5, gridY: 1, name: 'Games' },
      { id: 15, icon: '📺', color: '#1C1C1E', gridX: 4, gridY: 0, name: 'TV' },
      
      // Top cluster (0, -1)
      { id: 16, icon: '📧', color: '#007AFF', gridX: -1, gridY: -2.5, name: 'Mail' },
      { id: 17, icon: '📖', color: '#FF9F0A', gridX: 0, gridY: -2.5, name: 'Books' },
      { id: 18, icon: '🎨', color: '#5AC8FA', gridX: 1, gridY: -2.5, name: 'Art' },
      { id: 19, icon: '🌟', color: '#FFCC02', gridX: 0, gridY: -4, name: 'Favorites' },
      
      // Bottom cluster (0, 1)
      { id: 20, icon: '🔒', color: '#8E8E93', gridX: -1, gridY: 2.5, name: 'Security' },
      { id: 21, icon: '🌐', color: '#007AFF', gridX: 0, gridY: 2.5, name: 'Safari' },
      { id: 22, icon: '💊', color: '#32D74B', gridX: 1, gridY: 2.5, name: 'Health' },
      { id: 23, icon: '🎪', color: '#AF52DE', gridX: 0, gridY: 4, name: 'Entertainment' },
      
      // Diagonal clusters
      { id: 24, icon: '🛒', color: '#FF9F0A', gridX: -3.5, gridY: -2, name: 'Shopping' },
      { id: 25, icon: '☁️', color: '#007AFF', gridX: 3.5, gridY: -2, name: 'iCloud' },
      { id: 26, icon: '🎯', color: '#FF453A', gridX: -3.5, gridY: 2, name: 'Focus' },
      { id: 27, icon: '🚗', color: '#34C759', gridX: 3.5, gridY: 2, name: 'Travel' },
      
      // Far corners
      { id: 28, icon: '📐', color: '#5856D6', gridX: -5, gridY: -3, name: 'Utilities' },
      { id: 29, icon: '🎸', color: '#FF3B30', gridX: 5, gridY: -3, name: 'Music Pro' },
      { id: 30, icon: '🧠', color: '#AF52DE', gridX: -5, gridY: 3, name: 'Mind' },
      { id: 31, icon: '🚀', color: '#FFD60A', gridX: 5, gridY: 3, name: 'Launch' }
    ])

    // Create transforms for each app based on scroll position
    const createAppTransforms = (app) => {
      // Calculate base position with hexagonal offset
      const baseX = app.gridX * hexSpacing * 0.85
      const baseY = app.gridY * verticalSpacing * 0.75 + (app.gridX % 2 === 0 ? 0 : verticalSpacing * 0.35)
      
      // Transform final position based on scroll
      const finalX = useTransform(springX, (scrollX) => baseX + scrollX)
      const finalY = useTransform(springY, (scrollY) => baseY + scrollY)
      
      // Calculate distance from center (2D distance)
      const distanceFromCenter = useTransform([finalX, finalY], ([posX, posY]) => {
        return Math.sqrt(posX * posX + posY * posY) / 120
      })
      
      // Transform scale based on distance with more dramatic falloff
      const scale = useTransform(distanceFromCenter, 
        [0, 0.4, 0.8, 1.2, 1.8, 2.5], 
        [1, 0.92, 0.75, 0.55, 0.35, 0.25]
      )
      
      // Transform opacity with smooth falloff
      const opacity = useTransform(distanceFromCenter,
        [0, 0.6, 1, 1.5, 2.2],
        [1, 0.9, 0.7, 0.4, 0.2]
      )
      
      // Transform blur for depth effect
      const blur = useTransform(distanceFromCenter,
        [0, 0.8, 1.5, 2.5],
        [0, 0.5, 1.5, 3]
      )
      
      // Transform brightness for depth
      const brightness = useTransform(distanceFromCenter,
        [0, 1, 2],
        [1, 0.9, 0.7]
      )
      
      return {
        x: finalX,
        y: finalY,
        scale,
        opacity,
        blur,
        brightness,
        zIndex: useTransform(scale, s => Math.round(s * 100))
      }
    }

    // Container style with cursor
    const containerStyle = computed(() => ({
      cursor: isDragging.value ? 'grabbing' : 'grab'
    }))

    // Get motion style for each app
    const getAppMotionStyle = (app) => {
      const transforms = createAppTransforms(app)
      return {
        x: transforms.x,
        y: transforms.y,
        scale: transforms.scale,
        opacity: transforms.opacity,
        filter: useTransform([transforms.blur, transforms.brightness], 
          ([blur, brightness]) => `blur(${blur}px) brightness(${brightness})`
        ),
        zIndex: transforms.zIndex,
        backgroundColor: app.color,
        width: `${baseSize}px`,
        height: `${baseSize}px`,
        fontSize: useTransform(transforms.scale, s => `${Math.max(12, baseSize * s * 0.38)}px`)
      }
    }

    // Page indicator animations
    const getPageDotStyle = (pageIndex, axis) => {
      const currentPage = useTransform(
        axis === 'x' ? springX : springY, 
        pos => -pos / (axis === 'x' ? 100 : 80)
      )
      
      const isActive = useTransform(currentPage, page => 
        Math.abs(page - pageIndex) < 0.7
      )
      
      const distance = useTransform(currentPage, page => 
        Math.abs(page - pageIndex)
      )
      
      return {
        scale: useTransform(distance, dist => 
          dist < 0.7 ? 1.4 : (dist < 1.2 ? 1.1 : 0.8)
        ),
        opacity: useTransform(distance, dist => 
          dist < 0.7 ? 1 : (dist < 1.5 ? 0.6 : 0.3)
        ),
        backgroundColor: useTransform(isActive, active => 
          active ? 'rgba(255,255,255,0.95)' : 'rgba(255,255,255,0.4)'
        )
      }
    }

    // Drag functionality
    const startDrag = () => {
      isDragging.value = true
    }

    const onDrag = (event, info) => {
      x.set(x.get() + info.delta.x)
      y.set(y.get() + info.delta.y)
    }

    const endDrag = (event, info) => {
      isDragging.value = false
      
      const velocityX = info.velocity.x
      const velocityY = info.velocity.y
      const currentX = x.get()
      const currentY = y.get()
      
      // Snap to nearest page with velocity consideration
      const pageWidthX = 100
      const pageWidthY = 80
      
      let targetPageX = Math.round(-currentX / pageWidthX)
      let targetPageY = Math.round(-currentY / pageWidthY)
      
      // Adjust based on velocity for natural feel
      if (Math.abs(velocityX) > 400) {
        targetPageX += velocityX > 0 ? -1 : 1
      }
      if (Math.abs(velocityY) > 400) {
        targetPageY += velocityY > 0 ? -1 : 1
      }
      
      // Constrain to valid pages
      targetPageX = Math.max(-3, Math.min(3, targetPageX))
      targetPageY = Math.max(-2, Math.min(2, targetPageY))
      
      const targetX = -targetPageX * pageWidthX
      const targetY = -targetPageY * pageWidthY
      
      // Animate to target with spring
      animate(x, targetX, {
        type: "spring",
        stiffness: 350,
        damping: 32,
        mass: 0.8
      })
      
      animate(y, targetY, {
        type: "spring",
        stiffness: 350,
        damping: 32,
        mass: 0.8
      })
    }

    // Enhanced wheel handling for 2D navigation
    const handleWheel = (e) => {
      e.preventDefault()
      
      const deltaX = e.deltaX
      const deltaY = e.deltaY
      const sensitivity = 0.6
      
      // Update both axes
      if (Math.abs(deltaX) > Math.abs(deltaY)) {
        // Primarily horizontal scroll
        const newX = x.get() - deltaX * sensitivity
        x.set(newX)
      } else {
        // Primarily vertical scroll
        const newY = y.get() - deltaY * sensitivity
        y.set(newY)
      }
    }

    // App selection with enhanced animation
    const selectApp = (app) => {
      const appEl = appRefs.value[app.id]
      if (appEl) {
        // Create ripple effect on other nearby apps
        apps.value.forEach((otherApp, index) => {
          if (otherApp.id === app.id) return
          
          const distance = Math.sqrt(
            Math.pow(otherApp.gridX - app.gridX, 2) + 
            Math.pow(otherApp.gridY - app.gridY, 2)
          )
          
          if (distance < 2.5) {
            const otherEl = appRefs.value[otherApp.id]
            if (otherEl) {
              animate(otherEl, 
                { 
                  scale: [1, 0.9, 1],
                  rotate: [0, distance > 1.5 ? 5 : -5, 0]
                }, 
                { 
                  duration: 0.4,
                  delay: distance * 0.1,
                  ease: "easeOut"
                }
              )
            }
          }
        })
        
        // Main app animation
        animate(appEl, 
          { 
            scale: [1, 1.5, 1],
            rotate: [0, 720, 0],
            filter: ['brightness(1)', 'brightness(1.3)', 'brightness(1)']
          }, 
          { 
            duration: 0.8,
            ease: [0.68, -0.55, 0.265, 1.55]
          }
        )
      }
    }

    // Enhanced entrance animation with wave effect
    const entranceAnimation = () => {
      apps.value.forEach((app, index) => {
        const appEl = appRefs.value[app.id]
        if (appEl) {
          const distance = Math.sqrt(app.gridX * app.gridX + app.gridY * app.gridY)
          animate(appEl, 
            { 
              scale: [0, 1.4, 1],
              opacity: [0, 1],
              rotate: [270, 0],
              filter: ['blur(4px)', 'blur(0px)']
            }, 
            { 
              duration: 1,
              delay: distance * 0.08,
              ease: [0.68, -0.55, 0.265, 1.55]
            }
          )
        }
      })
    }

    onMounted(() => {
      // Setup drag controls for 2D dragging
      if (appContainer.value) {
        dragControls.start(appContainer.value, {
          onDragStart: startDrag,
          onDrag: onDrag,
          onDragEnd: endDrag
        })
      }
      
      // Add wheel handler
      if (appContainer.value) {
        appContainer.value.addEventListener('wheel', handleWheel, { passive: false })
      }
      
      // Trigger entrance animation
      setTimeout(entranceAnimation, 500)
    })

    onUnmounted(() => {
      if (appContainer.value) {
        appContainer.value.removeEventListener('wheel', handleWheel)
      }
    })

    return {
      appContainer,
      appRefs,
      apps,
      isDragging,
      pageCountX,
      pageCountY,
      containerStyle,
      getAppMotionStyle,
      getPageDotStyle,
      selectApp,
      handleWheel
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
  background: 
    radial-gradient(ellipse at 30% 20%, rgba(30,30,60,0.3) 0%, transparent 50%),
    radial-gradient(ellipse at 70% 80%, rgba(60,30,30,0.2) 0%, transparent 50%),
    radial-gradient(ellipse at center, #0f0f0f 0%, #000000 100%);
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  padding: 2rem;
  overflow: hidden;
}

.watch-frame {
  position: relative;
  width: 440px;
  height: 440px;
  background: 
    radial-gradient(circle at 35% 25%, rgba(255,255,255,0.12) 0%, transparent 40%),
    radial-gradient(circle at 65% 75%, rgba(100,100,150,0.08) 0%, transparent 40%),
    radial-gradient(circle at center, rgba(15,15,15,1) 0%, rgba(0,0,0,1) 100%);
  border-radius: 30%;
  box-shadow: 
    inset 0 0 80px rgba(255,255,255,0.04),
    inset 0 0 3px rgba(255,255,255,0.15),
    0 30px 60px rgba(0,0,0,0.5),
    0 0 0 4px rgba(255,255,255,0.08),
    0 0 0 8px rgba(0,0,0,0.1);
  overflow: hidden;
}

.digital-crown {
  position: absolute;
  right: -16px;
  top: 42%;
  transform: translateY(-50%);
  width: 32px;
  height: 70px;
  background: linear-gradient(90deg, #444, #bbb, #888, #444);
  border-radius: 16px;
  box-shadow: 
    3px 0 20px rgba(0,0,0,0.5),
    inset 0 0 4px rgba(255,255,255,0.3),
    inset 2px 0 2px rgba(255,255,255,0.1);
  cursor: pointer;
  transition: all 0.2s ease;
}

.digital-crown:hover {
  background: linear-gradient(90deg, #555, #ccc, #999, #555);
}

.digital-crown::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 20px;
  height: 20px;
  background: radial-gradient(circle, #ddd 30%, #999 70%);
  border-radius: 50%;
  box-shadow: 
    inset 0 2px 4px rgba(0,0,0,0.3),
    0 1px 2px rgba(255,255,255,0.2);
}

.app-container {
  position: absolute;
  inset: 0;
  user-select: none;
  touch-action: none;
}

.app-icon {
  position: absolute;
  left: 50%;
  top: 50%;
  border-radius: 24%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-weight: 700;
  cursor: pointer;
  transition: filter 0.15s ease;
  transform-origin: center;
  box-shadow: 
    0 6px 16px rgba(0,0,0,0.35),
    inset 0 1px 0 rgba(255,255,255,0.15),
    0 1px 3px rgba(0,0,0,0.2);
}

.app-icon:hover {
  filter: brightness(1.2) saturate(1.1) !important;
}

.app-icon:active {
  filter: brightness(0.9) !important;
}

.page-indicators {
  position: absolute;
  bottom: 30px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  gap: 12px;
  z-index: 100;
}

.page-indicators.vertical {
  bottom: auto;
  right: 30px;
  top: 50%;
  left: auto;
  transform: translateY(-50%);
  flex-direction: column;
  gap: 8px;
}

.page-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 
    0 2px 6px rgba(0,0,0,0.3),
    inset 0 1px 1px rgba(255,255,255,0.1);
}

.page-dot.horizontal {
  width: 10px;
  height: 6px;
  border-radius: 3px;
}

.instructions {
  margin-top: 3rem;
  text-align: center;
  color: #aaa;
  font-size: 0.9rem;
  font-weight: 400;
  opacity: 0.9;
  line-height: 1.5;
}

.instructions p {
  margin: 0.5rem 0;
}

.instructions p:last-child {
  font-size: 0.8rem;
  color: #777;
  margin-top: 0.3rem;
}
</style>