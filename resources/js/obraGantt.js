import { createApp } from 'vue';
import MainApplication from '@/components/control-de-obra/GanttObra.vue';
import 'toastr/build/toastr.min.css';
import XGantt from "@xpyjs/gantt";
import "@xpyjs/gantt/dist/style.css";


const application = createApp(MainApplication);
application.use(XGantt);
application.mount('#app');

