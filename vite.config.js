import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    server: {
        host: '0.0.0.0', // permite acesso externo
        port: 5174,
        hmr: {
            host: 'localhost', // <-- browser vai usar localhost
        },
    },

    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
