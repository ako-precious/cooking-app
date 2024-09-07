import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

if (process.env.VITE_ENV_MODE === "production") {
    vue.config.devtools = false;
    vue.config.debug = false;
    vue.config.silent = true;
}

export default defineConfig({
    pwa: {
        workboxOptions: {
            swSrc: "public/service-worker.js",
        },
    },
    server: {
        proxy: {
            "/maps": {
                target: "https://maps.googleapis.com",
                changeOrigin: true,
                rewrite: (path) => path.replace(/^\/maps/, ""),
            },
        },
    },
    define: {
        "import.meta.env.VITE_APP_NAME": JSON.stringify("Ounjemi"),
        "import.meta.env.VITE_APP_ENV": JSON.stringify("production"), // Remove extra space
        // Other environment variables...
    },
    build: {
        manifest: true,
        outDir: "public/build",
        mode: "production", // Ensure the build mode is set to 'production'
        rollupOptions: {
            input: "resources/js/app.js",
        },
    },
    plugins: [
        laravel({
            input: "resources/js/app.js",
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
            vue: "vue/dist/vue.esm-bundler.js",
        },
    },
});
// "pusher-js": "^8.4.0-rc2",
// "pusher/pusher-php-server": "^7.2",
// "laravel-notification-channels/webpush": "^8.0",