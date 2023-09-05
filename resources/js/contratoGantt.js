import { createApp } from 'vue';
import Application from '@/components/contrato/GanttContrato.vue';
import 'toastr/build/toastr.min.css';

const application = createApp(Application);
application.mount('#app');

