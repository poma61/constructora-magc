import { createApp } from 'vue'
import MainApplication from '@/components/auth/ProfileUser.vue'
import 'toastr/build/toastr.min.css';

const application = createApp(MainApplication);
application.mount('#app');

