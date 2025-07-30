// vite.config.js
import { defineConfig } from "file:///C:/Users/akopr/OneDrive/Documents/codes/Laravel/cooking-app-1/node_modules/vite/dist/node/index.js";
import laravel from "file:///C:/Users/akopr/OneDrive/Documents/codes/Laravel/cooking-app-1/node_modules/laravel-vite-plugin/dist/index.mjs";
import vue from "file:///C:/Users/akopr/OneDrive/Documents/codes/Laravel/cooking-app-1/node_modules/@vitejs/plugin-vue/dist/index.mjs";
if (process.env.VITE_ENV_MODE === "production") {
  vue.config.devtools = false;
  vue.config.debug = false;
  vue.config.silent = true;
}
var vite_config_default = defineConfig({
  pwa: {
    workboxOptions: {
      swSrc: "public/service-worker.js"
    }
  },
  server: {
    proxy: {
      "/maps": {
        target: "https://maps.googleapis.com",
        changeOrigin: true,
        rewrite: (path) => path.replace(/^\/maps/, "")
      }
    }
  },
  define: {
    "import.meta.env.VITE_APP_NAME": JSON.stringify("Ounjemi"),
    "import.meta.env.VITE_APP_ENV": JSON.stringify("production")
    // Remove extra space
    // Other environment variables...
  },
  build: {
    manifest: true,
    outDir: "public/build",
    mode: "production",
    // Ensure the build mode is set to 'production'
    rollupOptions: {
      input: "resources/js/app.js"
    }
  },
  plugins: [
    laravel({
      input: "resources/js/app.js",
      refresh: true
    }),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false
        }
      }
    })
  ],
  resolve: {
    alias: {
      vue: "vue/dist/vue.esm-bundler.js"
    }
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJDOlxcXFxVc2Vyc1xcXFxha29wclxcXFxPbmVEcml2ZVxcXFxEb2N1bWVudHNcXFxcY29kZXNcXFxcTGFyYXZlbFxcXFxjb29raW5nLWFwcC0xXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ZpbGVuYW1lID0gXCJDOlxcXFxVc2Vyc1xcXFxha29wclxcXFxPbmVEcml2ZVxcXFxEb2N1bWVudHNcXFxcY29kZXNcXFxcTGFyYXZlbFxcXFxjb29raW5nLWFwcC0xXFxcXHZpdGUuY29uZmlnLmpzXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ltcG9ydF9tZXRhX3VybCA9IFwiZmlsZTovLy9DOi9Vc2Vycy9ha29wci9PbmVEcml2ZS9Eb2N1bWVudHMvY29kZXMvTGFyYXZlbC9jb29raW5nLWFwcC0xL3ZpdGUuY29uZmlnLmpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSBcInZpdGVcIjtcbmltcG9ydCBsYXJhdmVsIGZyb20gXCJsYXJhdmVsLXZpdGUtcGx1Z2luXCI7XG5pbXBvcnQgdnVlIGZyb20gXCJAdml0ZWpzL3BsdWdpbi12dWVcIjtcblxuaWYgKHByb2Nlc3MuZW52LlZJVEVfRU5WX01PREUgPT09IFwicHJvZHVjdGlvblwiKSB7XG4gICAgdnVlLmNvbmZpZy5kZXZ0b29scyA9IGZhbHNlO1xuICAgIHZ1ZS5jb25maWcuZGVidWcgPSBmYWxzZTtcbiAgICB2dWUuY29uZmlnLnNpbGVudCA9IHRydWU7XG59XG5cbmV4cG9ydCBkZWZhdWx0IGRlZmluZUNvbmZpZyh7XG4gICAgcHdhOiB7XG4gICAgICAgIHdvcmtib3hPcHRpb25zOiB7XG4gICAgICAgICAgICBzd1NyYzogXCJwdWJsaWMvc2VydmljZS13b3JrZXIuanNcIixcbiAgICAgICAgfSxcbiAgICB9LFxuICAgIHNlcnZlcjoge1xuICAgICAgICBwcm94eToge1xuICAgICAgICAgICAgXCIvbWFwc1wiOiB7XG4gICAgICAgICAgICAgICAgdGFyZ2V0OiBcImh0dHBzOi8vbWFwcy5nb29nbGVhcGlzLmNvbVwiLFxuICAgICAgICAgICAgICAgIGNoYW5nZU9yaWdpbjogdHJ1ZSxcbiAgICAgICAgICAgICAgICByZXdyaXRlOiAocGF0aCkgPT4gcGF0aC5yZXBsYWNlKC9eXFwvbWFwcy8sIFwiXCIpLFxuICAgICAgICAgICAgfSxcbiAgICAgICAgfSxcbiAgICB9LFxuICAgIGRlZmluZToge1xuICAgICAgICBcImltcG9ydC5tZXRhLmVudi5WSVRFX0FQUF9OQU1FXCI6IEpTT04uc3RyaW5naWZ5KFwiT3VuamVtaVwiKSxcbiAgICAgICAgXCJpbXBvcnQubWV0YS5lbnYuVklURV9BUFBfRU5WXCI6IEpTT04uc3RyaW5naWZ5KFwicHJvZHVjdGlvblwiKSwgLy8gUmVtb3ZlIGV4dHJhIHNwYWNlXG4gICAgICAgIC8vIE90aGVyIGVudmlyb25tZW50IHZhcmlhYmxlcy4uLlxuICAgIH0sXG4gICAgYnVpbGQ6IHtcbiAgICAgICAgbWFuaWZlc3Q6IHRydWUsXG4gICAgICAgIG91dERpcjogXCJwdWJsaWMvYnVpbGRcIixcbiAgICAgICAgbW9kZTogXCJwcm9kdWN0aW9uXCIsIC8vIEVuc3VyZSB0aGUgYnVpbGQgbW9kZSBpcyBzZXQgdG8gJ3Byb2R1Y3Rpb24nXG4gICAgICAgIHJvbGx1cE9wdGlvbnM6IHtcbiAgICAgICAgICAgIGlucHV0OiBcInJlc291cmNlcy9qcy9hcHAuanNcIixcbiAgICAgICAgfSxcbiAgICB9LFxuICAgIHBsdWdpbnM6IFtcbiAgICAgICAgbGFyYXZlbCh7XG4gICAgICAgICAgICBpbnB1dDogXCJyZXNvdXJjZXMvanMvYXBwLmpzXCIsXG4gICAgICAgICAgICByZWZyZXNoOiB0cnVlLFxuICAgICAgICB9KSxcbiAgICAgICAgdnVlKHtcbiAgICAgICAgICAgIHRlbXBsYXRlOiB7XG4gICAgICAgICAgICAgICAgdHJhbnNmb3JtQXNzZXRVcmxzOiB7XG4gICAgICAgICAgICAgICAgICAgIGJhc2U6IG51bGwsXG4gICAgICAgICAgICAgICAgICAgIGluY2x1ZGVBYnNvbHV0ZTogZmFsc2UsXG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIH0sXG4gICAgICAgIH0pLFxuICAgIF0sXG4gICAgcmVzb2x2ZToge1xuICAgICAgICBhbGlhczoge1xuICAgICAgICAgICAgdnVlOiBcInZ1ZS9kaXN0L3Z1ZS5lc20tYnVuZGxlci5qc1wiLFxuICAgICAgICB9LFxuICAgIH0sXG59KTtcbi8vIFwicHVzaGVyLWpzXCI6IFwiXjguNC4wLXJjMlwiLFxuLy8gXCJwdXNoZXIvcHVzaGVyLXBocC1zZXJ2ZXJcIjogXCJeNy4yXCIsXG4vLyBcImxhcmF2ZWwtbm90aWZpY2F0aW9uLWNoYW5uZWxzL3dlYnB1c2hcIjogXCJeOC4wXCIsIl0sCiAgIm1hcHBpbmdzIjogIjtBQUF5WCxTQUFTLG9CQUFvQjtBQUN0WixPQUFPLGFBQWE7QUFDcEIsT0FBTyxTQUFTO0FBRWhCLElBQUksUUFBUSxJQUFJLGtCQUFrQixjQUFjO0FBQzVDLE1BQUksT0FBTyxXQUFXO0FBQ3RCLE1BQUksT0FBTyxRQUFRO0FBQ25CLE1BQUksT0FBTyxTQUFTO0FBQ3hCO0FBRUEsSUFBTyxzQkFBUSxhQUFhO0FBQUEsRUFDeEIsS0FBSztBQUFBLElBQ0QsZ0JBQWdCO0FBQUEsTUFDWixPQUFPO0FBQUEsSUFDWDtBQUFBLEVBQ0o7QUFBQSxFQUNBLFFBQVE7QUFBQSxJQUNKLE9BQU87QUFBQSxNQUNILFNBQVM7QUFBQSxRQUNMLFFBQVE7QUFBQSxRQUNSLGNBQWM7QUFBQSxRQUNkLFNBQVMsQ0FBQyxTQUFTLEtBQUssUUFBUSxXQUFXLEVBQUU7QUFBQSxNQUNqRDtBQUFBLElBQ0o7QUFBQSxFQUNKO0FBQUEsRUFDQSxRQUFRO0FBQUEsSUFDSixpQ0FBaUMsS0FBSyxVQUFVLFNBQVM7QUFBQSxJQUN6RCxnQ0FBZ0MsS0FBSyxVQUFVLFlBQVk7QUFBQTtBQUFBO0FBQUEsRUFFL0Q7QUFBQSxFQUNBLE9BQU87QUFBQSxJQUNILFVBQVU7QUFBQSxJQUNWLFFBQVE7QUFBQSxJQUNSLE1BQU07QUFBQTtBQUFBLElBQ04sZUFBZTtBQUFBLE1BQ1gsT0FBTztBQUFBLElBQ1g7QUFBQSxFQUNKO0FBQUEsRUFDQSxTQUFTO0FBQUEsSUFDTCxRQUFRO0FBQUEsTUFDSixPQUFPO0FBQUEsTUFDUCxTQUFTO0FBQUEsSUFDYixDQUFDO0FBQUEsSUFDRCxJQUFJO0FBQUEsTUFDQSxVQUFVO0FBQUEsUUFDTixvQkFBb0I7QUFBQSxVQUNoQixNQUFNO0FBQUEsVUFDTixpQkFBaUI7QUFBQSxRQUNyQjtBQUFBLE1BQ0o7QUFBQSxJQUNKLENBQUM7QUFBQSxFQUNMO0FBQUEsRUFDQSxTQUFTO0FBQUEsSUFDTCxPQUFPO0FBQUEsTUFDSCxLQUFLO0FBQUEsSUFDVDtBQUFBLEVBQ0o7QUFDSixDQUFDOyIsCiAgIm5hbWVzIjogW10KfQo=
