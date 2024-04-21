import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    define: {
        'import.meta.env.VITE_APP_NAME': JSON.stringify('Ounjemi'),
        'import.meta.env.VITE_APP_ENV ': JSON.stringify('production'),
        // Other environment variables...
      },
  mode: 'production', // Set the mode directly to 'production'
  build: {
    manifest: true,
    outDir: 'public/build',
    mode: 'production', // Ensure the build mode is also set to 'production'
    rollupOptions: {
        input: 'resources/js/app.js',
    }
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

// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';
// import vue from '@vitejs/plugin-vue';

// export default defineConfig({
//     define: {
//         'import.meta.env.VITE_APP_NAME': JSON.stringify('Ounjemi'),
//         'import.meta.env.VITE_APP_ENV ': JSON.stringify('production'),
//         // Other environment variables...
//       },
//   mode: 'production', // Set the mode directly to 'production'
//   build: {
//     manifest: true,
//     outDir: 'public/build',
//     mode: 'production', // Ensure the build mode is also set to 'production'
//     rollupOptions: {
//         input: 'resources/js/app.js',
//     }
//   },
//   plugins: [
//     laravel({
//       input: 'resources/js/app.js',
//       refresh: true,
//     }),
//     vue({
//       template: {
//         transformAssetUrls: {
//           base: null,
//           includeAbsolute: false,
//         },
//       },
//     }),
//   ],
// });
