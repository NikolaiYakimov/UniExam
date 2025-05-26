import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'; // ако използваш Vue
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js', 'resources/sass/app.scss'],
            refresh: true,
        }),
        vue(), // ако ползваш Vue
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './resources/js'),
        },
    },
});
