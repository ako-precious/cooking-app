import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

if (process.env.VITE_ENV_MODE === 'production') {
  Vue.config.devtools = false;
  Vue.config.debug = false;
  Vue.config.silent = true;
}


export default defineConfig({
  define: {
    'import.meta.env.VITE_APP_NAME': JSON.stringify('Ounjemi'),
    'import.meta.env.VITE_APP_ENV': JSON.stringify('production'), // Remove extra space
    // Other environment variables...
  },
  build: {
    manifest: true,
    outDir: 'public/build',
    mode: 'production', // Ensure the build mode is set to 'production'
    rollupOptions: {
      input: 'resources/js/app.js',
    },
  },
  plugins: [
    laravel({
      input: 'resources/js/app.js',
      refresh: true,
    }),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
    }),
  ],
  resolve: { 
    alias: {
        vue: 'vue/dist/vue.esm-bundler.js',
    },
},
});
