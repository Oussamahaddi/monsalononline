import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './axios'

// SweetAlert2
import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'

/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faUserSecret } from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(faUserSecret)

import './assets/style.css'

const app = createApp(App);

app.use(VueSweetalert2);
app.component('font-awesome-icon', FontAwesomeIcon);
app.use(router);
app.mount('#app');

