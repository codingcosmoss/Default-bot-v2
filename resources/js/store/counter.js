import {defineStore} from 'pinia';

export const useConterStore = defineStore({

    id: 'counter',

    state: () => ({
        activePage: 'Home',
        baseUrl: location.origin,
        sidebarToggle: '',
        Lang: '',
        roles: [],
        user: localStorage.getItem('user') != null ? JSON.parse(localStorage.getItem('user')) : []
    }),

    getters: {
        doubleCount: (state) => state.activePage
    },

    actions:{

        updatePage(val){
            this.activePage = val;
        },
        updateUser(val){
            this.user = val;
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
        },
        caesarDecipher(input, shift) {
            let result = '';
            for (let i = 0; i < input.length; i++) {
                let charCode = input.charCodeAt(i);
                if (charCode >= 65 && charCode <= 90) {
                    result += String.fromCharCode(((charCode - 65 - shift + 26) % 26) + 65);
                } else if (charCode >= 97 && charCode <= 122) {
                    result += String.fromCharCode(((charCode - 97 - shift + 26) % 26) + 97);
                } else {
                    result += input[i];
                }
            }
            return result;
        },
        sendError(model, error){
            console.log('Error:', error)
            // model.$router.push('/login');
        }






}

})
