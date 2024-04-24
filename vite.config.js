import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
// import vueJsx from '@vitejs/plugin-vue-jsx';
export default defineConfig({
  define: {
    'import.meta.env.VITE_APP_NAME': JSON.stringify('Ounjemi'),
    'import.meta.env.VITE_APP_ENV': JSON.stringify('production'), 
    // Other environment variables...
  },
  build: {
    manifest: true,
    outDir: 'public/build',
    emptyOutDir: true, // Ensure the output directory is emptied before rebuilding
    minify: 'terser', // Use terser for minification
    cssCodeSplit: true, // Split CSS code into separate files
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
    // vueJsx()
  ],
  // resolve: { 
  //   alias: {
  //     'vue': 'vue/dist/vue.esm-bundler.js', // Ensure you are using the correct Vue version
  //   },
  // },
});
