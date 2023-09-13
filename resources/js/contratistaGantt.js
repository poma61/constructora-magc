import { createApp } from 'vue';
import MainApplication from '@/components/finanzas-de-construccion/GanttContratista.vue';
import 'toastr/build/toastr.min.css';
import XGantt from "@xpyjs/gantt";
import "@xpyjs/gantt/dist/style.css";


const application = createApp(MainApplication);
application.use(XGantt);
application.mount('#app');

