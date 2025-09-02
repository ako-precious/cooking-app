<template>
  <div class="watch-container">
    <div class="watch-frame">
      <!-- Digital Crown -->
      <div class="digital-crown"></div>
      
      <!-- App Grid Container -->
      <div 
        ref="appContainer"
        class="app-container"
        @mousedown="startDrag"
        @wheel="handleWheel"
        @touchstart="startDrag"
        :style="{ cursor: isDragging ? 'grabbing' : 'grab' }"
      >
        <div
          v-for="app in apps"
          :key="app.id"
          :ref="el => { if (el) appRefs[app.id] = el }"
          class="app-icon"
          :style="getAppStyle(app)"
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
          :class="{ active: isActivePage(page - 3) }"
        ></div>
      </div>
    </div>
    
    <!-- Instructions -->
    <div class="instructions">
      <p>Drag or scroll horizontally to navigate</p>
      <p>Icons scale based on distance from center</p>
    </div>
  </div>
</template>

<script>
import { ref, reactive, onMounted, onUnmounted, nextTick } from 'vue'
import { animate, stagger } from 'motion-v'

export default {
  name: 'AppleWatchHomeScreen',
  setup() {
    const appContainer = ref(null)
    const appRefs = ref({})
    const isDragging = ref(false)
    const startX = ref(0)
    const currentTranslateX = ref(0)
    const velocity = ref(0)
    const lastMoveTime = ref(0)
    const animationId = ref(null)
    
    const hexSpacing = 80
    const baseSize = 60
    const maxSize = 80
    const minSize = 30
    const pageCount = 5

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
      
      // Left group (page -1)
      { id: 8, icon: '🌤️', color: '#5AC8FA', gridX: -2, gridY: -1, name: 'Weather' },
      { id: 9, icon: '🗺️', color: '#007AFF', gridX: -2, gridY: 0, name: 'Maps' },
      { id: 10, icon: '📝', color: '#FFCC02', gridX: -2, gridY: 1, name: 'Notes' },
      { id: 11, icon: '🏃', color: '#FF3B30', gridX: -3, gridY: 0, name: 'Fitness' },
      
      // Right group (page +1)
      { id: 12, icon: '💳', color: '#000000', gridX: 2, gridY: -1, name: 'Wallet' },
      { id: 13, icon: '📞', color: '#34C759', gridX: 2, gridY: 0, name: 'FaceTime' },
      { id: 14, icon: '🎮', color: '#FF3B30', gridX: 2, gridY: 1, name: 'Games' },
      { id: 15, icon: '📺', color: '#000000', gridX: 3, gridY: 0, name: 'TV' },
      
      // Far left (page -2)
      { id: 16, icon: '📧', color: '#007AFF', gridX: -4, gridY: 0, name: 'Mail' },
      { id: 17, icon: '📖', color: '#FF9500', gridX: -3, gridY: -1, name: 'Books' },
      { id: 18, icon: '🎨', color: '#5AC8FA', gridX: -3, gridY: 1, name: 'Art' },
      
      // Far right (page +2)
      { id: 19, icon: '🔒', color: '#8E8E93', gridX: 4, gridY: 0, name: 'Security' },
      { id: 20, icon: '📱', color: '#34C759', gridX: 3, gridY: -1, name: 'Apps' },
      { id: 21, icon: '🌐', color: '#007AFF', gridX: 3, gridY: 1, name: 'Safari' }
    ])

    // Calculate app position and size based on distance from center
    const calculateAppTransform = (app) => {
      const x = app.gridX * hexSpacing * 0.87 + currentTranslateX.value
      const y = app.gridY * hexSpacing * 0.75 + (app.gridX % 2 === 0 ? 0 : hexSpacing * 0.375)
      
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

    // Touch and mouse event handlers
    const startDrag = (e) => {
      isDragging.value = true
      const clientX = e.touches ? e.touches[0].clientX : e.clientX
      startX.value = clientX
      velocity.value = 0
      lastMoveTime.value = Date.now()
      
      // Stop any ongoing momentum animation
      if (animationId.value) {
        cancelAnimationFrame(animationId.value)
        animationId.value = null
      }
    }

    const handleMove = (e) => {
      if (!isDragging.value) return
      
      e.preventDefault()
      const clientX = e.touches ? e.touches[0].clientX : e.clientX
      const deltaX = clientX - startX.value
      const currentTime = Date.now()
      const deltaTime = currentTime - lastMoveTime.value
      
      // Calculate velocity for momentum
      if (deltaTime > 0) {
        velocity.value = deltaX / deltaTime * 16 // Convert to pixels per frame
      }
      
      // Update position with constraints
      const newTranslateX = currentTranslateX.value + deltaX
      const maxScroll = 350
      const minScroll = -350
      
      // Apply elastic resistance at edges
      let clampedX
      if (newTranslateX > maxScroll) {
        const overshoot = newTranslateX - maxScroll
        clampedX = maxScroll + overshoot * 0.3
      } else if (newTranslateX < minScroll) {
        const overshoot = minScroll - newTranslateX
        clampedX = minScroll - overshoot * 0.3
      } else {
        clampedX = newTranslateX
      }
      
      currentTranslateX.value = clampedX
      startX.value = clientX
      lastMoveTime.value = currentTime
    }

    const endDrag = () => {
      if (!isDragging.value) return
      
      isDragging.value = false
      
      // Apply momentum with deceleration
      const applyMomentum = () => {
        if (Math.abs(velocity.value) > 0.1) {
          currentTranslateX.value += velocity.value
          velocity.value *= 0.95 // Deceleration factor
          
          // Bounce back from edges
          const maxScroll = 350
          const minScroll = -350
          
          if (currentTranslateX.value > maxScroll) {
            currentTranslateX.value = maxScroll
            velocity.value = 0
          } else if (currentTranslateX.value < minScroll) {
            currentTranslateX.value = minScroll
            velocity.value = 0
          }
          
          animationId.value = requestAnimationFrame(applyMomentum)
        } else {
          // Snap to nearest page
          const pageWidth = 100
          const nearestPage = Math.round(currentTranslateX.value / pageWidth)
          const targetX = nearestPage * pageWidth
          
          animate(
            (progress) => {
              currentTranslateX.value = currentTranslateX.value + (targetX - currentTranslateX.value) * progress
            },
            { duration: 0.3, easing: [0.25, 0.1, 0.25, 1] }
          )
        }
      }
      
      applyMomentum()
    }

    const handleWheel = (e) => {
      e.preventDefault()
      const deltaX = e.deltaX || e.deltaY
      const newTranslateX = currentTranslateX.value - deltaX * 0.5
      
      const maxScroll = 350
      const minScroll = -350
      currentTranslateX.value = Math.max(minScroll, Math.min(maxScroll, newTranslateX))
    }

    // Page indicator helpers
    const isActivePage = (pageIndex) => {
      const currentPage = Math.round(-currentTranslateX.value / 100)
      return Math.abs(currentPage - pageIndex) < 0.5
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

    // Entrance animation
    const entranceAnimation = () => {
      const appElements = Object.values(appRefs.value).filter(el => el)
      
      animate(appElements, 
        { 
          scale: [0, 1.2, 1],
          opacity: [0, 1],
          rotate: [180, 0]
        }, 
        { 
          duration: 0.8,
          delay: stagger(0.05),
          easing: [0.68, -0.55, 0.265, 1.55]
        }
      )
    }

    // Lifecycle hooks
    onMounted(() => {
      // Add global event listeners
      document.addEventListener('mousemove', handleMove, { passive: false })
      document.addEventListener('mouseup', endDrag)
      document.addEventListener('touchmove', handleMove, { passive: false })
      document.addEventListener('touchend', endDrag)
      
      // Trigger entrance animation
      nextTick(() => {
        setTimeout(entranceAnimation, 300)
      })
    })

    onUnmounted(() => {
      // Cleanup
      document.removeEventListener('mousemove', handleMove)
      document.removeEventListener('mouseup', endDrag)
      document.removeEventListener('touchmove', handleMove)
      document.removeEventListener('touchend', endDrag)
      
      if (animationId.value) {
        cancelAnimationFrame(animationId.value)
      }
    })

    return {
      appContainer,
      appRefs,
      apps,
      isDragging,
      currentTranslateX,
      pageCount,
      getAppStyle,
      startDrag,
      handleWheel,
      isActivePage,
      selectApp
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
  touch-action: pan-y;
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
  transition: all 0.1s ease-out;
  backdrop-filter: blur(1px);
  transform-origin: center;
}

.app-icon:hover {
  filter: brightness(1.1);
}

.app-icon:active {
  transform: scale(0.95);
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
</style>