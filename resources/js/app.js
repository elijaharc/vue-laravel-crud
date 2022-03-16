import { createApp } from 'vue'

require('./bootstrap')
import App from './App.vue'
import axios from 'axios'
import router from './router'
import { plugin, defaultConfig } from '@formkit/vue'
import '@formkit/themes/genesis'
import BootstrapVue3 from "bootstrap-vue-3"
import "bootstrap/dist/css/bootstrap.css"
import "bootstrap-vue-3/dist/bootstrap-vue-3.css"

const app = createApp(App)
app.config.globalProperties.$axios = axios
app.use(router)
app.use(BootstrapVue3)
app.use(plugin, defaultConfig)
app.mount('#app')


