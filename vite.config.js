import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        host: '127.0.0.1', 
        port: 5173,
        strictPort: true,
        open: false,
        watch: {
            usePolling: true, // Forces manual checking, bypassing OS watcher bugs
            interval: 100,    // Checks every 100ms
            ignored: ['**/storage/framework/views/**'],
        },
        hmr: {
            host: '127.0.0.1',
        },
    },
});
