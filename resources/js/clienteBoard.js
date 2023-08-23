import { createApp } from 'vue'
import Application from '@/components/cliente/ListCliente.vue'
import app from "@/config/app.js"

// Vuetify
import { createVuetify } from 'vuetify'
//solo importamos los componenetes que utilizaremos para reducir el css 
import { VDialog, VTextField, VBtn, VSnackbar,VIcon,VTextarea, VAutocomplete } from 'vuetify/components';
import 'vuetify/styles'

const vuetify = new  createVuetify({
  components: {
    VTextField,
    VDialog,
    VBtn,
    VSnackbar,
    VAutocomplete,
    VIcon,
    VTextarea,
  },
 
});

const application = createApp(Application);
application.config.globalProperties.$app = app; // Agrega la configuración como propiedad global
application.use(vuetify).mount('#app');



