<template >
    <div >
        <Topbar v-if="this.$route.path.split('/').includes('admin')" ></Topbar>
        <LeftMenu  v-if="this.$route.path.split('/').includes('admin')" ></LeftMenu>
        <router-view></router-view>
    </div>
</template>
<script>
    import {GetUser} from "@/Api.js";
    import Topbar from "@/components/Layout/Topbar.vue";
    import LeftMenu from "@/components/Layout/LeftMenu.vue";
    export default {
        components: {LeftMenu, Topbar},
        methods:{
            async getUser(){
                const response = await GetUser();
                console.log('User:', response)
            }
        },
        mounted() {
            // this.getUser()

        }
    }

</script>

