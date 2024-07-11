<template >
    <div >
        <Topbar v-if="this.$route.path.split('/').includes('admin')" ></Topbar>
        <LeftMenu  v-if="this.$route.path.split('/').includes('admin')" ></LeftMenu>
        <router-view></router-view>
    </div>
</template>
<script>
    import {GetUser} from "./helpers/api.js";
    import Topbar from "@/components/Layout/Topbar.vue";
    import LeftMenu from "@/components/Layout/LeftMenu.vue";
    export default {
        components: {LeftMenu, Topbar},
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
            }
        },
        mounted() {
            // this.getUser()
            this.fon()
        }
    }

</script>

