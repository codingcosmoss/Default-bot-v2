import './bootstrap';
import App from './components/App.vue';
import { createApp } from 'vue'
import router from './router/index.js'
import { createPinia } from 'pinia';
import './axios.js';
import "vue-awesome-paginate/dist/style.css";
import ToastPlugin from 'vue-toast-notification';
// Import one of the available themes
//import 'vue-toast-notification/dist/theme-default.css';
import 'vue-toast-notification/dist/theme-bootstrap.css';

import 'vuesalize/dist/vuesalize.css'
import Vuesalize from 'vuesalize'


const app = createApp(App);
const pinia = createPinia();
// Global verebles
app.config.globalProperties.$BaseUrl = window.location.origin;

// import the package
import VueAwesomePaginate from "vue-awesome-paginate";
// import the necessary css file


app.use(router)
    .use(pinia)
    .use(Vuesalize)
    .use(VueAwesomePaginate)
    .use(ToastPlugin)
    .mount('#app');
