import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import { VitePWA } from 'vite-plugin-pwa'

export default defineConfig({
    plugins: [

        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),

        VitePWA({
            registerType: 'autoUpdate',

            devOptions: {
                enabled: true,
            },

            manifest: {
                name: 'ChurchHub',

                short_name: 'ChurchHub',

                description: 'Church member management platform',

                theme_color: '#2563eb',

                background_color: '#ffffff',

                display: 'standalone',

                scope: '/',

                start_url: '/dashboard',

                icons: [
                    {
                        src: '/pwa-192x192.png',
                        sizes: '192x192',
                        type: 'image/png',
                    },

                    {
                        src: '/pwa-512x512.png',
                        sizes: '512x512',
                        type: 'image/png',
                    },
                ],
            },
        }),

    ],
})