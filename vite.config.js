import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/sweetalert2.js',
                'resources/js/bootstrap5.js',
                'resources/js/web-app.js',
            ],
            refresh: true,
        }),
    ],
});
