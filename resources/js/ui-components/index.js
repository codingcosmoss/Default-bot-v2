// Barcha componentlarni globallashtrish
import loginBox from './Layout/login-box.vue';
import LoginForm from './Form/LoginForm.vue';

// Elements
import alert from './Element/Alerts/alert-white.vue'

// ...

// [ ] massiv ishiga barcha import qilingan componentlar nomi kiritiladi
export default [
    loginBox,
    LoginForm,
    alert
];
// export default [DangerButton, BlackButton, Box, ...]

/*
    So'ng index.js ni main.js fayilimizda import qilib qoyamiz
    -- import qilishda index.js joylashgan papkaning o'zi import qilinadi index.jsni esa avtomatik topib oladi
*/
