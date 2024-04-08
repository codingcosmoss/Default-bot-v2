<template >
    <div >
        <router-view></router-view>
    </div>
</template>
<script>
    import {GetUser} from "@/Api.js";

    export default {
        methods:{
            async getUser(){
                let user = localStorage.getItem('user');

                if (user == null){
                    const response = await GetUser();
                    localStorage.setItem('user', JSON.stringify(response.data));
                }

            },
        },
        mounted() {
            this.getUser()
        }
    }

</script>

