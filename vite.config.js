import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/living-office/main.jsx'],
            refresh: true,
        }),
        react(),
    ],
    server: {
        // Pakai port dari env PORT (diberikan preview), fallback ke 5173
        port: Number(process.env.PORT) || 5173,
    },
});
