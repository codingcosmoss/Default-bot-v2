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
        },
        hasRole(role){
            if (this.user.permissions == null){
                return false;
            }
            if (this.user.permissions.includes(role) || role == 'public'){
                return true;
            }
            return false;
        },
        hiddenModal(id){
            const modalElement = document.getElementById(id);
            if (modalElement) {
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                if (modalInstance) {
                    modalInstance.hide();
                } else {
                    console.error('Modal instance not found.');
                }
            } else {
                console.error('Modal element not found.');
            }
        },
        inputNumberFormat(inputClass, defaultAmount, val ) {
            const format_input = document.querySelector('.'+inputClass);
            let numbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', ' ', ''];
            if (numbers.includes(val.slice(val.length - 1, val.length)) == true) {
                format_input.value = this.formatNumber(val.replace(/\s+/g, ''));
                console.log(this.formatNumber(val))
                return Number(val.replace(/\s+/g, ''))
            } else {
                format_input.value = this.formatNumber(defaultAmount);
                return defaultAmount;
            }
        },
        currentDate(){
            const today = new Date();

            const month = String(today.getMonth() + 1).padStart(2, '0'); // getMonth() 0 dan boshlanadi, shuning uchun 1 qo'shish kerak
            const day = String(today.getDate()).padStart(2, '0');
            const year = today.getFullYear();
            console.log(`${month}-${day}-${year}`)
            return `${year}-${month}-${day}`;
        },
        updateCurrency(val){
            this.user.currency = val;
            this.user.currency_id = val.id;
        }


}

})
