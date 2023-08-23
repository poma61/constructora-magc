import { createApp } from 'vue'
import Application from '@/components/cliente/CalendarCliente.vue'
import 'vue-cal/dist/vuecal.css';
import 'toastr/build/toastr.min.css';

const application = createApp(Application);
application.mount('#app');

