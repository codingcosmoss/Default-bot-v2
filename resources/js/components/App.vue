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
                const response = await GetUser();
                console.log('User:', response)
            }


        },
        mounted() {
            // this.getUser()
        }
    }

</script>

