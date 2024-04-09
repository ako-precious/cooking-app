import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  mode: 'production', // Set the mode directly to 'production'
  build: {
    mode: 'production', // Ensure the build mode is also set to 'production'
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
});

// import { defineConfig } from "vite";
// import laravel from "laravel-vite-plugin";
// import vue from "@vitejs/plugin-vue";

// VITE_ENV_MODE = production;

// export default defineConfig({
//     mode: 'production',
    
//     build: {
//         mode: "production",
//         // mode: process.env.NODE_ENV === 'production' ? 'production' : 'development',
//     },
//     plugins: [
//         laravel({
//             input: "resources/js/app.js",
//             refresh: true,
//         }),

//         vue({
//             template: {
//                 transformAssetUrls: {
//                     base: null,
//                     includeAbsolute: false,
//                 },
//             },
//         }),
//     ],
// });
