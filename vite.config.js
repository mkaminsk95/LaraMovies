import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import mkcert from'vite-plugin-mkcert';

export default defineConfig({
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
        ]),
        mkcert()
    ],
    server: {
        host: true,
        https: true
    },
});
