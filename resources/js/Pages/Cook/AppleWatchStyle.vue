<template>
  <div class="watch-container">
    <div class="watch-frame">
      <div class="digital-crown"></div>

      <div
        ref="appContainer"
        class="app-container"
        v-motion
        :style="{ x: motionX, y: motionY }"
        :drag="true"
        :drag-constraints="{ left: -350, right: 350, top: -200, bottom: 200 }"
        :drag-transition="{ bounceStiffness: 300, bounceDamping: 40 }"
      >
        <div
          v-for="app in apps"
          :key="app.id"
          :ref="el => { if (el) appRefs[app.id] = el }"
          class="app-icon"
          :style="appStyles[app.id]"
          @click="selectApp(app)"
          :title="app.name"
        >
          {{ app.icon }}
        </div>
      </div>
    </div>

    <div class="instructions">
      <p>Drag or scroll to navigate</p>
      <p>Icons scale based on distance from center</p>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, nextTick, computed } from 'vue';
import { useMotionValue, useTransform, animate, stagger } from 'motion-v';

export default {
  name: 'AppleWatchHomeScreen',
  setup() {
    const appContainer = ref(null);
    const appRefs = ref({});

    // --- MOTION ONE SETUP ---
    // 1. Use motion values to track the drag position.
    const motionX = useMotionValue(0);
    const motionY = useMotionValue(0);

    // --- CONFIGURATION ---
    const hexSpacing = 85;
    const baseSize = 60;

    // App data arranged in a hexagonal grid
    const apps = ref([
      // Center group
      { id: 1, icon: '⏰', color: '#000000', gridX: 0, gridY: 0, name: 'Clock' },
      { id: 2, icon: '📱', color: '#007AFF', gridX: -1, gridY: -0.5, name: 'Phone' },
      { id: 3, icon: '💌', color: '#FF3B30', gridX: 1, gridY: -0.5, name: 'Messages' },
      { id: 4, icon: '🎵', color: '#FF9500', gridX: 0, gridY: -1, name: 'Music' },
      { id: 5, icon: '📊', color: '#34C759', gridX: -1, gridY: 0.5, name: 'Stocks' },
      { id: 6, icon: '📷', color: '#8E8E93', gridX: 1, gridY: 0.5, name: 'Camera' },
      { id: 7, icon: '⚙️', color: '#8E8E93', gridX: 0, gridY: 1, name: 'Settings' },

      // Left group
      { id: 8, icon: '🌤️', color: '#5AC8FA', gridX: -2, gridY: 0, name: 'Weather' },
      { id: 9, icon: '🗺️', color: '#007AFF', gridX: -2, gridY: -1, name: 'Maps' },
      { id: 10, icon: '📝', color: '#FFCC02', gridX: -2, gridY: 1, name: 'Notes' },
      { id: 11, icon: '🏃', color: '#FF3B30', gridX: -3, gridY: -0.5, name: 'Fitness' },
      { id: 16, icon: '📧', color: '#007AFF', gridX: -3, gridY: 0.5, name: 'Mail' },

      // Right group
      { id: 12, icon: '💳', color: '#000000', gridX: 2, gridY: 0, name: 'Wallet' },
      { id: 13, icon: '📞', color: '#34C759', gridX: 2, gridY: -1, name: 'FaceTime' },
      { id: 14, icon: '🎮', color: '#FF3B30', gridX: 2, gridY: 1, name: 'Games' },
      { id: 15, icon: '📺', color: '#000000', gridX: 3, gridY: -0.5, name: 'TV' },
      { id: 21, icon: '🌐', color: '#007AFF', gridX: 3, gridY: 0.5, name: 'Safari' }
    ]);

    // Calculate initial static positions for each app in the hex grid
    const getInitialPosition = (app) => {
      const x = app.gridX * hexSpacing * 0.866; // 0.866 is ~sqrt(3)/2
      const y = app.gridY * hexSpacing;
      return { x, y };
    };

    // --- REACTIVE STYLES WITH USETRANSFORM ---
    const appStyles = computed(() => {
      const styles = {};
      apps.value.forEach(app => {
        const { x: initialX, y: initialY } = getInitialPosition(app);

        // This computed property will reactively update for each app
        const currentAppStyles = computed(() => {
          // Calculate the app's current position by adding drag offset to initial position
          const currentX = initialX + motionX.get();
          const currentY = initialY + motionY.get();

          // Calculate Euclidean distance from the center (0,0)
          const distanceFromCenter = Math.sqrt(currentX ** 2 + currentY ** 2);

          // 2. Use useTransform to map distance to scale and opacity
          const scale = useTransform(
            distanceFromCenter,
            [0, 150, 300], // Input distance range
            [1.3, 1, 0.5] // Output scale range
          );

          const opacity = useTransform(
            distanceFromCenter,
            [0, 150, 250], // Input distance range
            [1, 1, 0.3]  // Output opacity range
          );
          
          const size = scale.get() * baseSize;
          
          return {
            backgroundColor: app.color,
            width: `${size}px`,
            height: `${size}px`,
            transform: `translate(calc(-50% + ${initialX}px), calc(-50% + ${initialY}px))`,
            scale: scale.get(),
            opacity: opacity.get(),
            fontSize: `${Math.max(16, size * 0.35)}px`,
            zIndex: Math.round(scale.get() * 100),
            boxShadow: `0 ${size * 0.1}px ${size * 0.3}px rgba(0,0,0,${0.3 * opacity.get()})`
          };
        });
        styles[app.id] = currentAppStyles.value;
      });
      return styles;
    });


    // App selection with animation (remains the same)
    const selectApp = (app) => {
      const appEl = appRefs.value[app.id];
      if (appEl) {
        animate(
          appEl,
          { scale: [1, 1.3, 1] },
          { duration: 0.4, easing: [0.68, -0.55, 0.265, 1.55] }
        );
      }
    };

    // Entrance animation (remains the same)
    const entranceAnimation = () => {
      const appElements = Object.values(appRefs.value).filter(el => el);
      animate(
        appElements,
        { scale: [0, 1.2, 1], opacity: [0, 1] },
        { duration: 0.8, delay: stagger(0.04), easing: "ease-out" }
      );
    };

    onMounted(() => {
      nextTick(() => {
        setTimeout(entranceAnimation, 300);
      });
    });

    return {
      appContainer,
      appRefs,
      apps,
      appStyles,
      motionX,
      motionY,
      selectApp
    };
  }
};
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
  background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.1) 0%, rgba(0, 0, 0, 0.3) 100%);
  border-radius: 50%;
  box-shadow: inset 0 0 50px rgba(255, 255, 255, 0.05),
    0 20px 40px rgba(0, 0, 0, 0.3),
    0 0 0 4px rgba(255, 255, 255, 0.1);
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
  box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
  z-index: 10;
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
  cursor: grab;
  user-select: none;
  /* Let motion handle this */
  touch-action: none;
}
.app-container:active {
  cursor: grabbing;
}

.app-icon {
  position: absolute;
  left: 50%;
  top: 50%;
  border-radius: 22.5%; /* More accurate Apple Watch radius */
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-weight: 600;
  cursor: pointer;
  backdrop-filter: blur(1px);
  transform-origin: center;
  will-change: transform, opacity, width, height;
  /* Transition is handled by motion's spring physics */
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