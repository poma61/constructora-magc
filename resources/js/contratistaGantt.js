import { createApp } from 'vue';
import MainApplication from '@/components/finanzas-de-construccion/GanttContratista.vue';
import 'toastr/build/toastr.min.css';

const application = createApp(MainApplication);
application.mount('#app');

