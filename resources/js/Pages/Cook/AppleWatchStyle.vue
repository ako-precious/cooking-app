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
        @touchstart="startDrag"
        @wheel="handleWheel"
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
      
      
    </div>
    
    <!-- Instructions -->
    <div class="instructions">
      <p>Drag horizontally to navigate between app clusters</p>
      <p>Center apps are largest, outer ring apps are smallest</p>
    </div>
  </div>
</template>

<script>
import { ref, computed, onMounted, onBeforeUnmount, nextTick } from 'vue'
import { animate } from 'motion-v'

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
    
    const clusterSpacing = 220  // Distance between cluster centers
    const pageCountX = 5

    // App clusters following the honeycomb pattern
    const apps = ref([
      // CENTER CLUSTER (Page 0) - Exact honeycomb layout
      { id: 1, icon: '⏰', color: '#1C1C1E', clusterX: 0, ring: 'center', position: 'center', name: 'Clock' },
      { id: 18, icon: '📖', color: '#FF9F0A', clusterX: 0, ring: 'outer', position: 'top-left-2', name: 'Books' },
      { id: 10, icon: '📝', color: '#FFD60A', clusterX: 0, ring: 'outer', position: 'top-right-2', name: 'Notes' },
      
      // Inner ring (6 apps around center)
      { id: 2, icon: '📱', color: '#007AFF', clusterX: 0, ring: 'inner', position: 'top', name: 'Phone' },
      { id: 3, icon: '💬', color: '#34C759', clusterX: 0, ring: 'inner', position: 'top-right', name: 'Messages' },
      { id: 4, icon: '📷', color: '#8E8E93', clusterX: 0, ring: 'inner', position: 'bottom-right', name: 'Camera' },
      { id: 5, icon: '⚙️', color: '#8E8E93', clusterX: 0, ring: 'inner', position: 'bottom', name: 'Settings' },
      { id: 6, icon: '🎵', color: '#FF3B30', clusterX: 0, ring: 'inner', position: 'bottom-left', name: 'Music' },
      { id: 7, icon: '📊', color: '#5856D6', clusterX: 0, ring: 'inner', position: 'top-left', name: 'Stocks' },
      
      // Outer ring (12 apps on outer edge)
      { id: 8, icon: '🌤️', color: '#30B0C7', clusterX: 0, ring: 'outer', position: 'top', name: 'Weather' },
      { id: 9, icon: '🗺️', color: '#007AFF', clusterX: 0, ring: 'outer', position: 'top-right-1', name: 'Maps' },
      { id: 11, icon: '💳', color: '#1C1C1E', clusterX: 0, ring: 'outer', position: 'right', name: 'Wallet' },
      { id: 12, icon: '📞', color: '#32D74B', clusterX: 0, ring: 'outer', position: 'bottom-right-2', name: 'FaceTime' },
      { id: 13, icon: '🎮', color: '#5E5CE6', clusterX: 0, ring: 'outer', position: 'bottom-right-1', name: 'Games' },
      { id: 14, icon: '📧', color: '#007AFF', clusterX: 0, ring: 'outer', position: 'bottom', name: 'Mail' },
      { id: 15, icon: '🌐', color: '#007AFF', clusterX: 0, ring: 'outer', position: 'bottom-left-1', name: 'Safari' },
      { id: 16, icon: '💊', color: '#32D74B', clusterX: 0, ring: 'outer', position: 'bottom-left-2', name: 'Health' },
      { id: 17, icon: '🔒', color: '#8E8E93', clusterX: 0, ring: 'outer', position: 'left', name: 'Security' },
      { id: 19, icon: '🎨', color: '#5AC8FA', clusterX: 0, ring: 'outer', position: 'top-left-1', name: 'Art' },

      // LEFT CLUSTER (Page -1)
      { id: 20, icon: '🏃', color: '#FF453A', clusterX: -1, ring: 'center', position: 'center', name: 'Fitness' },
      { id: 21, icon: '🎯', color: '#FF453A', clusterX: -1, ring: 'inner', position: 'top', name: 'Focus' },
      { id: 22, icon: '☁️', color: '#007AFF', clusterX: -1, ring: 'inner', position: 'top-right', name: 'iCloud' },
      { id: 23, icon: '🛒', color: '#FF9F0A', clusterX: -1, ring: 'inner', position: 'bottom-right', name: 'Shopping' },
      { id: 24, icon: '🚗', color: '#34C759', clusterX: -1, ring: 'inner', position: 'bottom', name: 'Travel' },
      { id: 25, icon: '🎪', color: '#AF52DE', clusterX: -1, ring: 'inner', position: 'bottom-left', name: 'Fun' },
      { id: 26, icon: '🧠', color: '#AF52DE', clusterX: -1, ring: 'inner', position: 'top-left', name: 'Mind' },

      // RIGHT CLUSTER (Page +1)
      { id: 27, icon: '📺', color: '#1C1C1E', clusterX: 1, ring: 'center', position: 'center', name: 'TV' },
      { id: 28, icon: '🚀', color: '#FFD60A', clusterX: 1, ring: 'inner', position: 'top', name: 'Launch' },
      { id: 29, icon: '🎸', color: '#FF3B30', clusterX: 1, ring: 'inner', position: 'top-right', name: 'Music Pro' },
      { id: 30, icon: '📐', color: '#5856D6', clusterX: 1, ring: 'inner', position: 'bottom-right', name: 'Utilities' },
      { id: 31, icon: '🌟', color: '#FFCC02', clusterX: 1, ring: 'inner', position: 'bottom', name: 'Favorites' },
      { id: 32, icon: '🎭', color: '#AF52DE', clusterX: 1, ring: 'inner', position: 'bottom-left', name: 'Theater' },
      
      // FAR LEFT CLUSTER (Page -2)
      { id: 34, icon: '🎲', color: '#FF9F0A', clusterX: -2, ring: 'center', position: 'center', name: 'Games' },
      { id: 35, icon: '🎨', color: '#5AC8FA', clusterX: -2, ring: 'inner', position: 'top', name: 'Art' },
      { id: 36, icon: '📚', color: '#FF3B30', clusterX: -2, ring: 'inner', position: 'top-right', name: 'Library' },
      { id: 37, icon: '🔧', color: '#8E8E93', clusterX: -2, ring: 'inner', position: 'bottom-right', name: 'Tools' },
      
      // FAR RIGHT CLUSTER (Page +2)
      { id: 33, icon: '🔬', color: '#32D74B', clusterX: 1, ring: 'inner', position: 'top-left', name: 'Science' },
      { id: 38, icon: '💎', color: '#AF52DE', clusterX: 2, ring: 'center', position: 'center', name: 'Premium' },
      { id: 39, icon: '🌟', color: '#FFD60A', clusterX: 2, ring: 'inner', position: 'top', name: 'Star' },
      { id: 40, icon: '🔥', color: '#FF453A', clusterX: 2, ring: 'inner', position: 'top-right', name: 'Hot' },
      { id: 41, icon: '⚡', color: '#FFCC02', clusterX: 2, ring: 'inner', position: 'bottom-right', name: 'Power' }
    ])

    // Position mapping for honeycomb layout
    const getAppPosition = (app) => {
      const clusterCenterX = app.clusterX * clusterSpacing
      
      // Define ring sizes and positions
      const ringConfig = {
        center: { radius: 0, size: 75 },
        inner: { radius: 85, size: 60 },
        outer: { radius: 140, size: 35 }
      }
      
      const config = ringConfig[app.ring]
      let angle = 0
      
      // Calculate angle based on position
      switch (app.position) {
        case 'center': return { x: clusterCenterX, y: 0, size: config.size }
        
        // Inner ring positions (6 positions)
        case 'top': angle = -Math.PI/2; break
        case 'top-right': angle = -Math.PI/6; break
        case 'bottom-right': angle = Math.PI/6; break
        case 'bottom': angle = Math.PI/2; break
        case 'bottom-left': angle = 5*Math.PI/6; break
        case 'top-left': angle = -5*Math.PI/6; break
        
        // Outer ring positions (12 positions)
        case 'top-right-1': angle = -Math.PI/3; break
        case 'top-right-2': angle = 0; break
        case 'right': angle = Math.PI/3; break
        case 'bottom-right-2': angle = 2*Math.PI/3; break
        case 'bottom-right-1': angle = Math.PI/3; break
        case 'bottom-left-1': angle = 2*Math.PI/3; break
        case 'bottom-left-2': angle = Math.PI; break
        case 'left': angle = -2*Math.PI/3; break
        case 'top-left-2': angle = -Math.PI; break
        case 'top-left-1': angle = -2*Math.PI/3; break
        
        default: angle = 0
      }
      
      const x = clusterCenterX + Math.cos(angle) * config.radius
      const y = Math.sin(angle) * config.radius
      
      return { x, y, size: config.size }
    }

    // Calculate app transform based on current scroll position
    const calculateAppTransform = (app) => {
      const position = getAppPosition(app)
      const finalX = position.x + currentTranslateX.value
      const finalY = position.y
      
      // Calculate distance from screen center for scaling
      const distanceFromCenter = Math.abs(finalX) / 150
      
      // Scale based on distance
      const scaleFactor = Math.max(0.25, 1 - Math.pow(distanceFromCenter, 1.2) * 0.6)
      const finalSize = position.size * scaleFactor
      
      // Opacity falloff
      const opacity = Math.max(0.3, 1 - distanceFromCenter * 0.4)
      
      // Blur for depth
      const blur = Math.min(2.5, distanceFromCenter * 1.2)
      
      return {
        x: finalX,
        y: finalY,
        size: finalSize,
        opacity,
        blur,
        zIndex: Math.round(scaleFactor * 100)
      }
    }

    // Get computed style for each app
    const getAppStyle = (app) => {
      const transform = calculateAppTransform(app)
      return {
        backgroundColor: app.color,
        width: `${transform.size}px`,
        height: `${transform.size}px`,
        transform: `translate(calc(-50% + ${transform.x}px), calc(-50% + ${transform.y}px))`,
        opacity: transform.opacity,
        fontSize: `${Math.max(12, transform.size * 0.4)}px`,
        zIndex: transform.zIndex,
        filter: `blur(${transform.blur}px)`,
        boxShadow: `0 ${transform.size * 0.08}px ${transform.size * 0.25}px rgba(0,0,0,${0.3 * transform.opacity})`
      }
    }

    // Page indicator helper
    const isActivePage = (pageIndex) => {
      const currentPage = Math.round(-currentTranslateX.value / clusterSpacing)
      return Math.abs(currentPage - pageIndex) < 0.5
    }

    // Touch and mouse event handlers
    const startDrag = (e) => {
      isDragging.value = true
      const clientX = e.touches ? e.touches[0].clientX : e.clientX
      startX.value = clientX
      velocity.value = 0
      lastMoveTime.value = Date.now()
      
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
      
      if (deltaTime > 0) {
        velocity.value = deltaX / deltaTime * 16
      }
      
      const newTranslateX = currentTranslateX.value + deltaX
      const maxScroll = 500
      const minScroll = -500
      
      // Apply elastic resistance
      let clampedX
      if (newTranslateX > maxScroll) {
        const overshoot = newTranslateX - maxScroll
        clampedX = maxScroll + overshoot * 0.2
      } else if (newTranslateX < minScroll) {
        const overshoot = minScroll - newTranslateX
        clampedX = minScroll - overshoot * 0.2
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
      
      // Apply momentum
      const applyMomentum = () => {
        if (Math.abs(velocity.value) > 0.1) {
          currentTranslateX.value += velocity.value
          velocity.value *= 0.95
          
          const maxScroll = 500
          const minScroll = -500
          
          if (currentTranslateX.value > maxScroll) {
            currentTranslateX.value = maxScroll
            velocity.value = 0
          } else if (currentTranslateX.value < minScroll) {
            currentTranslateX.value = minScroll
            velocity.value = 0
          }
          
          animationId.value = requestAnimationFrame(applyMomentum)
        } else {
          // Snap to nearest cluster
          const nearestCluster = Math.round(currentTranslateX.value / clusterSpacing)
          const targetX = nearestCluster * clusterSpacing
          
          animate(
            (progress) => {
              currentTranslateX.value = currentTranslateX.value + (targetX - currentTranslateX.value) * progress
            },
            { duration: 0.4, ease: [0.25, 0.1, 0.25, 1] }
          )
        }
      }
      
      applyMomentum()
    }

    const handleWheel = (e) => {
      e.preventDefault()
      const deltaX = e.deltaX || e.deltaY
      const newTranslateX = currentTranslateX.value - deltaX * 0.8
      
      const maxScroll = 500
      const minScroll = -500
      currentTranslateX.value = Math.max(minScroll, Math.min(maxScroll, newTranslateX))
    }

    // App selection
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

    // Entrance animation with honeycomb wave
    const entranceAnimation = () => {
      const rings = ['center', 'inner', 'outer']
      
      rings.forEach((ring, ringIndex) => {
        const ringApps = apps.value.filter(app => app.ring === ring)
        
        ringApps.forEach((app, appIndex) => {
          const appEl = appRefs.value[app.id]
          if (appEl) {
            animate(appEl, 
              { 
                scale: [0, 1.3, 1],
                opacity: [0, 1],
                rotate: [180, 0]
              }, 
              { 
                duration: 0.8,
                delay: ringIndex * 0.15 + appIndex * 0.06,
                ease: [0.68, -0.55, 0.265, 1.55]
              }
            )
          }
        })
      })
    }

    // Event listeners
    let mouseMoveHandler, mouseUpHandler, touchMoveHandler, touchEndHandler

    onMounted(() => {
      mouseMoveHandler = handleMove
      mouseUpHandler = endDrag
      touchMoveHandler = handleMove
      touchEndHandler = endDrag
      
      document.addEventListener('mousemove', mouseMoveHandler, { passive: false })
      document.addEventListener('mouseup', mouseUpHandler)
      document.addEventListener('touchmove', touchMoveHandler, { passive: false })
      document.addEventListener('touchend', touchEndHandler)
      
      nextTick(() => {
        setTimeout(entranceAnimation, 400)
      })
    })

    onBeforeUnmount(() => {
      document.removeEventListener('mousemove', mouseMoveHandler)
      document.removeEventListener('mouseup', mouseUpHandler)
      document.removeEventListener('touchmove', touchMoveHandler)
      document.removeEventListener('touchend', touchEndHandler)
      
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
      pageCountX,
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
  background: radial-gradient(ellipse at center, #1a1a1a 0%, #000000 100%);
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
  border-radius: 35%;
  box-shadow: 
    inset 0 0 60px rgba(255,255,255,0.03),
    inset 0 0 2px rgba(255,255,255,0.1),
    0 25px 50px rgba(0,0,0,0.4),
    0 0 0 3px rgba(255,255,255,0.08);
  overflow: hidden;
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
  transition: all 0.1s ease;
  transform-origin: center;
}

.app-icon:hover {
  filter: brightness(1.15) !important;
}

.app-icon:active {
  transform: scale(0.95) !important;
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
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.3);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.page-dot.active {
  background: rgba(255, 255, 255, 0.95);
  transform: scale(1.4);
}

.instructions {
  margin-top: 2.5rem;
  text-align: center;
  color: #999;
  font-size: 0.9rem;
  line-height: 1.6;
}

.instructions p {
  margin: 0.3rem 0;
}

.instructions p:last-child {
  font-size: 0.8rem;
  color: #777;
}
</style>