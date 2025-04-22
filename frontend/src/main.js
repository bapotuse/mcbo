import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './style.css'
import axios from 'axios';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faArrowDown } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faArrowDown)
axios.defaults.withCredentials = true
const app = createApp(App)
app.component('font-awesome-icon', FontAwesomeIcon)
app.use(router)
app.mount('#app')
