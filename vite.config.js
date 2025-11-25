import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import {nativephpMobile} from './vendor/nativephp/mobile/resources/inertia/nativephp-vite.js';



export default defineConfig(() => {
    const mobileConfig = nativephpMobile();

    return {
        ...nativephpMobile(),
        plugins: [
            ...(mobileConfig.plugins || []),
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.js'],
                refresh: true,
            }),
            tailwindcss(),
        ],
    };
});
