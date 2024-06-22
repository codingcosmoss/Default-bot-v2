<template >
    <div >
        <Topbar v-if="this.$route.path.split('/').includes('admin')" ></Topbar>
        <LeftMenu  v-if="this.$route.path.split('/').includes('admin')" ></LeftMenu>
        <router-view></router-view>
    </div>
</template>
<script>
    import {GetUser} from "./helpers/Api.js";
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
                if (fon != null && fon == 'dark'){
                    document.documentElement.setAttribute("data-bs-theme","dark");
                }
            }
        },
        mounted() {
            // this.getUser()
            this.fon()
            document.cookie = 'locale=EN'
        }
    }

</script>

