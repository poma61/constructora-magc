import { createApp } from 'vue'
import MainApplication from '@/components/control-de-obra/CalendarObra.vue'
import 'vue-cal/dist/vuecal.css';
import 'toastr/build/toastr.min.css';

const application = createApp(MainApplication);
application.mount('#app');

