import { createApp } from 'vue'
import Application from '@/components/user/ListUser.vue'
import app from "@/config/app.js"

// Vuetify
import { createVuetify } from 'vuetify'

//solo importamos los componenetes que utilizaremos para reducir el css 
import { VDialog, VTextField, VBtn, VSnackbar,VRadioGroup, VRadio,VIcon } from 'vuetify/components';
import 'vuetify/styles'

const vuetify = new  createVuetify({
  components: {
    VTextField,
    VDialog,
    VBtn,
    VSnackbar,
    VRadioGroup,
    VRadio,
    VIcon,
  },
 
});

const application = createApp(Application);
application.config.globalProperties.$app = app; // Agrega la configuración como propiedad global
application.use(vuetify).mount('#app');


