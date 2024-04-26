import { createApp } from 'vue';
import MainApplication from '@/components/user/ListUser.vue';


// Vuetify
import { createVuetify } from 'vuetify';
//solo importamos los componenetes que utilizaremos para reducir el css 
import { VDialog, VTextField, VBtn, VSnackbar,VRadioGroup, VRadio, VIcon, VSwitch } from 'vuetify/components';
import 'vuetify/styles';

//para traducciones
import { createVueI18nAdapter } from 'vuetify/locale/adapters/vue-i18n';
import { createI18n, useI18n } from 'vue-i18n';
// Importa las traducciones desde node_modules  de vuetify
import esTranslations from 'vuetify/lib/locale/es.mjs';
import enTranslations from 'vuetify/lib/locale/en.mjs';



const messages = {
  es: {
    $vuetify: {
      ...esTranslations,
    },
    10: '10',   // Forzar traducción (aunque no sea necesaria)
    25: '25',   // Forzar traducción (aunque no sea necesaria)
    50: '50',   // Forzar traducción (aunque no sea necesaria)
    100: '100', // Forzar traducción (aunque no sea necesaria)
  },
  en: { //cargamos idioma ingles como idioma secundario
    $vuetify: {
      ...enTranslations,
    },
    10: '10',   // Forzar traducción (aunque no sea necesaria)
    25: '25',   // Forzar traducción (aunque no sea necesaria)
    50: '50',   // Forzar traducción (aunque no sea necesaria)
    100: '100', // Forzar traducción (aunque no sea necesaria)
  },
}

const i18n = new createI18n({
  legacy: false, // Vuetify does not support the legacy mode of vue-i18n
  locale: 'es',
  fallbackLocale: 'en',
  messages,
})


const vuetify = new  createVuetify({
  locale: {
    adapter: createVueI18nAdapter({ i18n, useI18n }),
  },
  components: {
    VTextField,
    VDialog,
    VBtn,
    VSnackbar,
    VRadioGroup,
    VRadio,
    VIcon,
    VSwitch,
  },
 
});

const application = createApp(MainApplication);
application.use(vuetify)
application.mount('#app');


