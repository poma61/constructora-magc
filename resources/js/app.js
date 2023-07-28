import './bootstrap';



import { createApp } from 'vue'
import ExampleComponent from '@/components/ExampleComponent.vue';

window.app = createApp({
    setup() {
        return {
            message: 'Welcome to Your Vue.js App',
        };
    },
    components: {
        ExampleComponent
    },
}).mount('#app');