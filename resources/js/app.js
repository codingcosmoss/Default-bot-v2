import './bootstrap';
import 'vue-toast-notification/dist/theme-bootstrap.css';
import "vue-awesome-paginate/dist/style.css";
import 'vuesalize/dist/vuesalize.css'

import App from './App.vue';
import { createApp } from 'vue'
import { createPinia } from 'pinia';
import { createI18n } from 'vue-i18n'
import router from './router/index.js'
import './axios.js';

import ToastPlugin from 'vue-toast-notification';
import Vuesalize from 'vuesalize'

import EN from "@/locale/en.json"
import RU from "@/locale/ru.json"

const i18n = createI18n({
    locale: localStorage.getItem('locale'),
    messages: {
        EN: EN,
        RU: RU
    }
    // change @click="$i18.locale = `EN`"
    // view $t('name)
})

const app = createApp(App);
const pinia = createPinia();

// Global verebles
app.config.globalProperties.$BaseUrl = window.location.origin;
// import the package
import VueAwesomePaginate from "vue-awesome-paginate";

import * as components from "./components/global/components.js"
// Barcha componentlarni ro'hatga olish
for (const [name, component] of Object.entries(components)) {
    app.component(name, component);
}

app.use(router)
    .use(pinia)
    .use(Vuesalize)
    .use(VueAwesomePaginate)
    .use(ToastPlugin)
    .use(i18n)
    .mount('#app');
