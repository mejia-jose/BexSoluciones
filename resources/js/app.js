import './bootstrap';

import { createApp } from 'vue'
import '@fortawesome/fontawesome-free/css/all.css';
import Mapa from '../views/components/mapa.vue';

// Sea crea una instancia de la aplicación para el componente Mapa y rendirizarlo
const mapaApp = createApp(Mapa);
mapaApp.mount('#app');

