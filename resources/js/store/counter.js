import {defineStore} from 'pinia';
import {Languages} from "../Localization.js";

export const useConterStore = defineStore({

    id: 'counter',

    state: () => ({
        activePage: 'Home',
        sidebarToggle: '',
        Localization: Languages,
        Lang: '',
        roles: []
    }),

    getters: {
        doubleCount: (state) => state.activePage
    },

    actions:{

        updatePage(val){
            this.activePage = val;
        },
        updateRoles(val){
            this.roles = val;
        },
        updateSidebarToggle(val){
            this.sidebarToggle = val;
        },
        updateLang(val){
            this.Lang = val;
        },
        getName(val){
            if (localStorage.getItem('lang') == null){
                localStorage.setItem('lang', 'uz');
            }
            return  this.Localization[localStorage.getItem('lang')][val];
        },
        formatNumber(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        },
        formatPhoneNumber(input) {
            // Telefon raqamini faqat raqamlarini qabul qilish uchun formatlab
            let cleaned = ('' + input).replace(/\D/g, '');

            // Formatni bo'lish uchun belgilash
            let match = cleaned.match(/^(\d{3})(\d{2})(\d{3})(\d{2})(\d{2})$/);

            if (match) {
                // Formatli raqamni qaytarish
                return '(' + match[1] + ') ' + match[2] + ' ' + match[3] + ' ' + match[4] + ' ' + match[5];
            }

            // Agar raqamni formatlab bo'lmagan bo'lsa, asl raqamni qaytarish
            return input;
        },
        formatDate(datetime) {
            const date = new Date(datetime);
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');
            const seconds = String(date.getSeconds()).padStart(2, '0');

            const formattedDate = `${year}-${month}-${day} ${hours}:${minutes}`;
            return formattedDate;
        }




}

})
