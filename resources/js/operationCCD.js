import { createApp } from 'vue'
import MainApplication from '@/components/operation/CalculeCCD.vue'

// Vuetify
import { createVuetify } from 'vuetify'
//solo importamos los componenetes que utilizaremos para reducir el css 
import {  VTextField, VBtn,  } from 'vuetify/components';
import 'vuetify/styles'
import 'toastr/build/toastr.min.css';

const vuetify = createVuetify({
  components: {
    VTextField,
    VBtn,
  },
})

const application = createApp(MainApplication);
application.use(vuetify);
application.mount('#app');



