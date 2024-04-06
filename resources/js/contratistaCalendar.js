import { createApp } from 'vue'
import MainApplication from '@/components/finanzas-de-construccion/CalendarContratista.vue'
import 'vue-cal/dist/vuecal.css';
import 'toastr/build/toastr.min.css';

const application = createApp(MainApplication);
application.mount('#app');

