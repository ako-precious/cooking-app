<template>
  <div class="watch-container">
    <div class="watch-frame">
      <!-- Digital Crown -->
      <div class="digital-crown"></div>
      
      <!-- App Grid Container -->
      <div 
        ref="appContainer"
        class="app-container"
        v-motion
        :style="{
          x: x,
          cursor: isDragging ? 'grabbing' : 'grab'
        }"
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
      <div class="page-indicators">
        <div
          v-for="page in pageCount"
          :key="page"
          class="page-dot"
          v-motion
          :style="getPageDotStyle(page - 3)"
        ></div>
      </div>
    </div>
    
    <!-- Instructions -->
    <div class="instructions">
      <p>Drag horizontally to navigate • Icons scale from center</p>
    </div>
  </div>
</template>

<script>
import { ref, reactive, onMounted, computed, watch } from 'vue'
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
    
    // Motion values for smooth animations
    const x = useMotionValue(0)
    const dragControls = useDragControls()
    
    // Spring configuration for smooth movements
    const springConfig = { 
      stiffness: 300, 
      damping: 30, 
      mass: 0.8 
    }
    
    // Transform x position to constrained values with elastic boundaries
    const constrainedX = useTransform(x, (value) => {
      const maxScroll = 320
      const minScroll = -320
      
      if (value > maxScroll) {
        const overshoot = value - maxScroll
        return maxScroll + overshoot * 0.3 // Elastic resistance
      } else if (value < minScroll) {
        const overshoot = minScroll - value  
        return minScroll - overshoot * 0.3
      }
      return value
    })
    
    // Create springs for smooth page transitions
    const springX = useSpring(constrainedX, springConfig)
    
    const hexSpacing = 85
    const baseSize = 55
    const maxSize = 75
    const minSize = 28
    const pageCount = 5

    // App data arranged in hexagonal grid
    const apps = ref([
      // Center cluster (page 0)
      { id: 1, icon: '⏰', color: '#1C1C1E', gridX: 0, gridY: 0, name: 'Clock' },
      { id: 2, icon: '📱', color: '#007AFF', gridX: -1, gridY: -1, name: 'Phone' },
      { id: 3, icon: '💬', color: '#34C759', gridX: 0, gridY: -1, name: 'Messages' },
      { id: 4, icon: '🎵', color: '#FF3B30', gridX: 1, gridY: -1, name: 'Music' },
      { id: 5, icon: '📊', color: '#5856D6', gridX: -1, gridY: 0, name: 'Stocks' },
      { id: 6, icon: '📷', color: '#8E8E93', gridX: 1, gridY: 0, name: 'Camera' },
      { id: 7, icon: '⚙️', color: '#8E8E93', gridX: 0, gridY: 1, name: 'Settings' },
      
      // Left cluster (page -1)
      { id: 8, icon: '🌤️', color: '#30B0C7', gridX: -2.2, gridY: -1, name: 'Weather' },
      { id: 9, icon: '🗺️', color: '#007AFF', gridX: -2.2, gridY: 0, name: 'Maps' },
      { id: 10, icon: '📝', color: '#FFD60A', gridX: -2.2, gridY: 1, name: 'Notes' },
      { id: 11, icon: '🏃', color: '#FF453A', gridX: -3.5, gridY: 0, name: 'Fitness' },
      { id: 12, icon: '📧', color: '#007AFF', gridX: -3.5, gridY: -1, name: 'Mail' },
      { id: 13, icon: '🎨', color: '#FF9F0A', gridX: -3.5, gridY: 1, name: 'Art' },
      
      // Right cluster (page +1)  
      { id: 14, icon: '💳', color: '#1C1C1E', gridX: 2.2, gridY: -1, name: 'Wallet' },
      { id: 15, icon: '📞', color: '#32D74B', gridX: 2.2, gridY: 0, name: 'FaceTime' },
      { id: 16, icon: '🎮', color: '#5E5CE6', gridX: 2.2, gridY: 1, name: 'Games' },
      { id: 17, icon: '📺', color: '#1C1C1E', gridX: 3.5, gridY: 0, name: 'TV' },
      { id: 18, icon: '🌐', color: '#007AFF', gridX: 3.5, gridY: -1, name: 'Safari' },
      { id: 19, icon: '🔒', color: '#8E8E93', gridX: 3.5, gridY: 1, name: 'Security' },
      
      // Far left (page -2)
      { id: 20, icon: '📖', color: '#FF9F0A', gridX: -4.8, gridY: 0, name: 'Books' },
      { id: 21, icon: '🎯', color: '#FF453A', gridX: -4.8, gridY: -1, name: 'Target' },
      { id: 22, icon: '💊', color: '#32D74B', gridX: -4.8, gridY: 1, name: 'Health' },
      
      // Far right (page +2)
      { id: 23, icon: '☁️', color: '#007AFF', gridX: 4.8, gridY: 0, name: 'iCloud' },
      { id: 24, icon: '🛒', color: '#FF9F0A', gridX: 4.8, gridY: -1, name: 'Store' },
      { id: 25, icon: '🎪', color: '#AF52DE', gridX: 4.8, gridY: 1, name: 'Fun' }
    ])

    // Transform functions for each app based on scroll position
    const createAppTransforms = (app) => {
      // Calculate base position
      const baseX = app.gridX * hexSpacing * 0.85
      const baseY = app.gridY * hexSpacing * 0.7 + (app.gridX % 2 === 0 ? 0 : hexSpacing * 0.35)
      
      // Transform final position based on scroll
      const finalX = useTransform(springX, (scrollX) => baseX + scrollX)
      
      // Calculate distance from center for scaling
      const distanceFromCenter = useTransform(finalX, (pos) => Math.abs(pos) / 110)
      
      // Transform size based on distance
      const scale = useTransform(distanceFromCenter, 
        [0, 0.5, 1, 1.5, 2], 
        [1, 0.9, 0.65, 0.45, 0.35]
      )
      
      // Transform opacity
      const opacity = useTransform(distanceFromCenter,
        [0, 0.8, 1.2, 2],
        [1, 0.8, 0.5, 0.3]
      )
      
      // Transform blur for depth effect
      const blur = useTransform(distanceFromCenter,
        [0, 1, 2],
        [0, 1, 2]
      )
      
      return {
        x: finalX,
        y: baseY,
        scale,
        opacity,
        blur,
        zIndex: useTransform(scale, s => Math.round(s * 100))
      }
    }

    // Get motion style for each app
    const getAppMotionStyle = (app) => {
      const transforms = createAppTransforms(app)
      return {
        x: transforms.x,
        y: transforms.y,
        scale: transforms.scale,
        opacity: transforms.opacity,
        filter: useTransform(transforms.blur, blur => `blur(${blur}px)`),
        zIndex: transforms.zIndex,
        backgroundColor: app.color,
        width: `${baseSize}px`,
        height: `${baseSize}px`,
        fontSize: useTransform(transforms.scale, s => `${Math.max(14, baseSize * s * 0.4)}px`)
      }
    }

    // Page indicator animation
    const getPageDotStyle = (pageIndex) => {
      const currentPage = useTransform(springX, x => -x / 100)
      const isActive = useTransform(currentPage, page => 
        Math.abs(page - pageIndex) < 0.6
      )
      
      return {
        scale: useTransform(isActive, active => active ? 1.3 : 1),
        opacity: useTransform(isActive, active => active ? 1 : 0.4),
        backgroundColor: useTransform(isActive, active => 
          active ? 'rgba(255,255,255,0.9)' : 'rgba(255,255,255,0.3)'
        )
      }
    }

    // Drag functionality
    const startDrag = () => {
      isDragging.value = true
    }

    const onDrag = (event, info) => {
      // Motion handles the dragging automatically through v-motion
      x.set(x.get() + info.delta.x)
    }

    const endDrag = (event, info) => {
      isDragging.value = false
      
      // Snap to nearest page
      const velocity = info.velocity.x
      const currentX = x.get()
      const pageWidth = 100
      
      let targetPage = Math.round(-currentX / pageWidth)
      
      // Adjust based on velocity for natural feel
      if (Math.abs(velocity) > 500) {
        targetPage += velocity > 0 ? -1 : 1
      }
      
      // Constrain to valid pages
      targetPage = Math.max(-2, Math.min(2, targetPage))
      const targetX = -targetPage * pageWidth
      
      // Animate to target with spring
      animate(x, targetX, {
        type: "spring",
        stiffness: 300,
        damping: 30,
        mass: 0.8
      })
    }

    // App selection with bounce animation
    const selectApp = (app) => {
      const appEl = appRefs.value[app.id]
      if (appEl) {
        animate(appEl, 
          { 
            scale: [1, 1.4, 1],
            rotate: [0, 360, 0]
          }, 
          { 
            duration: 0.7,
            ease: [0.68, -0.55, 0.265, 1.55]
          }
        )
      }
    }

    // Entrance animation
    const entranceAnimation = () => {
      apps.value.forEach((app, index) => {
        const appEl = appRefs.value[app.id]
        if (appEl) {
          animate(appEl, 
            { 
              scale: [0, 1.3, 1],
              opacity: [0, 1],
              rotate: [180, 0]
            }, 
            { 
              duration: 0.9,
              delay: index * 0.04,
              ease: [0.68, -0.55, 0.265, 1.55]
            }
          )
        }
      })
    }

    onMounted(() => {
      // Setup drag controls
      if (appContainer.value) {
        dragControls.start(appContainer.value, {
          axis: "x",
          onDragStart: startDrag,
          onDrag: onDrag,
          onDragEnd: endDrag
        })
      }
      
      // Trigger entrance animation
      setTimeout(entranceAnimation, 400)
    })

    return {
      appContainer,
      appRefs,
      apps,
      isDragging,
      x: springX,
      pageCount,
      getAppMotionStyle,
      getPageDotStyle,
      selectApp,
      dragControls
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
  background: radial-gradient(ellipse at center, #1a1a1a 0%, #000000 70%);
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  padding: 2rem;
}

.watch-frame {
  position: relative;
  width: 420px;
  height: 420px;
  background: 
    radial-gradient(circle at 35% 25%, rgba(255,255,255,0.08) 0%, transparent 50%),
    radial-gradient(circle at center, rgba(20,20,20,1) 0%, rgba(0,0,0,1) 100%);
  border-radius: 50%;
  box-shadow: 
    inset 0 0 60px rgba(255,255,255,0.03),
    inset 0 0 2px rgba(255,255,255,0.1),
    0 25px 50px rgba(0,0,0,0.4),
    0 0 0 3px rgba(255,255,255,0.08);
  overflow: hidden;
}

.digital-crown {
  position: absolute;
  right: -14px;
  top: 45%;
  transform: translateY(-50%);
  width: 28px;
  height: 65px;
  background: linear-gradient(90deg, #555, #aaa, #777, #555);
  border-radius: 14px;
  box-shadow: 
    2px 0 15px rgba(0,0,0,0.4),
    inset 0 0 3px rgba(255,255,255,0.2);
}

.digital-crown::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 18px;
  height: 18px;
  background: radial-gradient(circle, #ccc, #888);
  border-radius: 50%;
  box-shadow: inset 0 1px 3px rgba(0,0,0,0.3);
}

.app-container {
  position: absolute;
  inset: 0;
  user-select: none;
  touch-action: pan-y;
}

.app-icon {
  position: absolute;
  left: 50%;
  top: 50%;
  border-radius: 22%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-weight: 700;
  cursor: pointer;
  transition: filter 0.2s ease;
  transform-origin: center;
  box-shadow: 
    0 4px 12px rgba(0,0,0,0.25),
    inset 0 1px 0 rgba(255,255,255,0.1);
}

.app-icon:hover {
  filter: brightness(1.15) !important;
}

.app-icon:active {
  filter: brightness(0.95) !important;
}

.page-indicators {
  position: absolute;
  bottom: 25px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  gap: 10px;
  z-index: 100;
}

.page-dot {
  width: 7px;
  height: 7px;
  border-radius: 50%;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.instructions {
  margin-top: 2.5rem;
  text-align: center;
  color: #999;
  font-size: 0.9rem;
  font-weight: 400;
  opacity: 0.8;
}
</style>