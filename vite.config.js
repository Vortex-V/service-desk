import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        https: false,
        host: '0.0.0.0',
        port: 3000,
        hmr: {
            host: 'localhost',
        },
        strictPort: true,
        usePolling: true
    }
});
