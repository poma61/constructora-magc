import { createApp } from 'vue'
import MainApplication from '@/components/disenio/ChartProcesoDisenio.vue'
import 'toastr/build/toastr.min.css';

const application = createApp(MainApplication);
application.mount('#app');

