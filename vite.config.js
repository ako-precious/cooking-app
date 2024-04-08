import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

if (process.env.MIX_ENV_MODE === "production") {
    vue.config.devtools = false;
    vue.config.debug = false;
    vue.config.silent = true;
}

export default defineConfig({
    mode: "production",
    build: {
        env: {
            NODE_ENV: "production",
        },
        mode: "production",
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
});
