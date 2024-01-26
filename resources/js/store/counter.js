import {defineStore} from 'pinia';

export const useConterStore = defineStore({

    id: 'counter',

    state: () => ({
        activePage: 'Home',
        sidebarToggle: '',
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

    }

})
