import { createApp } from 'vue'
import MainApplication from '@/components/control-de-obra/ChartObra.vue'
import 'toastr/build/toastr.min.css';

const application = createApp(MainApplication);
application.mount('#app');

