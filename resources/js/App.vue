<template >
    <div >
        <Topbar v-if="this.$route.path.split('/').includes('admin')" ></Topbar>
        <LeftMenu  v-if="this.$route.path.split('/').includes('admin')" ></LeftMenu>
        <router-view></router-view>
    </div>
</template>
<script>
    import {GetUser, roleNotification} from "./helpers/api.js";
    import Topbar from "@/components/Layout/Topbar.vue";
    import LeftMenu from "@/components/Layout/LeftMenu.vue";
    import {useConterStore} from "@/store/counter.js";
    export default {
        components: {LeftMenu, Topbar},
        setup(){
            const counterStore = useConterStore();
            return{counterStore}
        },
        methods:{
            async getUser(){
                const response = await GetUser();
                console.log('User:', response)
            },
            fon(){
                let fon = localStorage.getItem('fon');
                let locale = localStorage.getItem('locale');
                if (fon != null && fon == 'dark'){
                    document.documentElement.setAttribute("data-bs-theme","dark");
                }
                if (!locale || locale == null){
                    localStorage.setItem('locale', 'EN');
                }
            },
            async changeRole(){
                const response = await roleNotification(this.counterStore.user.role_id);
                localStorage.setItem('token', response.data.token);
            }
        },
        mounted() {
            // this.getUser()
            this.fon()
            this.changeRole();
        }
    }

</script>

