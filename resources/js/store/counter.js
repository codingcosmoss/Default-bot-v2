import {defineStore} from 'pinia';

export const useConterStore = defineStore({

    id: 'counter',

    state: () => ({
        activePage: 'Home',
    }),

    getters: {
        doubleCount: (state) => state.activePage
    },

    actions:{

        updatePage(val){
            this.activePage = val;
        },
      
    }

})
