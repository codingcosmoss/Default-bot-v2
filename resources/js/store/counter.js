import {defineStore} from 'pinia';
import {Languages} from "../Localization.js";

export const useConterStore = defineStore({

    id: 'counter',

    state: () => ({
        activePage: 'Home',
        sidebarToggle: '',
        Localization: Languages,
        Lang: '',
    }),

    getters: {
        doubleCount: (state) => state.activePage
    },

    actions:{

        updatePage(val){
            this.activePage = val;
        },
        updateSidebarToggle(val){
            this.sidebarToggle = val;
        },
        updateLang(val){
            this.Lang = val;
        },
        getName(val){
            return  this.Localization[localStorage.getItem('lang')][val];
        },

    }

})
