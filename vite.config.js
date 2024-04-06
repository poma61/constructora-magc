import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/clienteBoard.js',
                'resources/js/clienteCalendar.js',
                'resources/js/clienteChart.js',
                'resources/js/clienteGantt.js',
                
                'resources/js/contratistaBoard.js',
                'resources/js/contratistaCalendar.js',
                'resources/js/contratistaChart.js',
                'resources/js/contratistaGantt.js',

                'resources/js/contratoBoard.js',
                'resources/js/contratoCalendar.js',
                'resources/js/contratoGantt.js',
    
                'resources/js/disenioBoard.js',
                'resources/js/disenioCalendar.js',
                'resources/js/disenioChart.js',

                'resources/js/inventarioBoard.js',
                'resources/js/inventarioCalendar.js',
                'resources/js/inventarioChart.js',
                'resources/js/inventarioGantt.js',

                'resources/js/obraBoard.js',
                'resources/js/obraCalendar.js',
                'resources/js/obraChart.js',
                'resources/js/obraGantt.js',

                'resources/js/operationCCD.js',

                'resources/js/userBoard.js',
                'resources/js/authUserProfile.js',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            'vue': 'vue/dist/vue.esm-bundler.js',
            'vue-i18n': 'vue-i18n/dist/vue-i18n.esm-bundler.js', // Agrega esta línea
           // 'es': 'vuetify/lib/locale/es.mjs', // Agrega esta línea
        },
    },
 
});

