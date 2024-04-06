import { createApp } from 'vue'
import MainApplication from '@/components/cliente/CalendarCliente.vue'
import 'vue-cal/dist/vuecal.css';
import 'toastr/build/toastr.min.css';

const application = createApp(MainApplication);
application.mount('#app');

