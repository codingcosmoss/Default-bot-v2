import './bootstrap';
import App from './components/App.vue';
import { createApp } from 'vue'
import router from './router/index.js'
import { createPinia } from 'pinia';
import './axios.js';

const app = createApp(App);
const pinia = createPinia();

app.use(router)
    .use(pinia)
    .mount('#app');
