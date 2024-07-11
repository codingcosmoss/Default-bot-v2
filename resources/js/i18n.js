// i18n.js
import { createI18n } from 'vue-i18n'
import EN from "@/locale/en.json"
import RU from "@/locale/ru.json"

const messages = {
    en: EN,
    ru: RU
}

const getLocaleFromCookie = () => {
    const cookie = document.cookie.split('; ').find(row => row.startsWith('locale='))
    return cookie ? cookie.split('=')[1] : 'en'
}

const i18n = createI18n({
    locale: getLocaleFromCookie(),
    fallbackLocale: 'en',
    messages
})

export default i18n
