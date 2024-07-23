import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import mkcert from 'vite-plugin-mkcert';

export default defineConfig({
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
            'resources/js/carousel.js',
        ]),
        mkcert({
            savePath: './certs'
        })
    ],
    server: {
        host: true,
        https: true,
        port: 5173,
    },
});
