<template >
    <div class="d-flex flex-column flex-root AdminBox ">

		<login-box>
            <LoginForm Title = "Muhammadalidev.uz"/>
        </login-box>

	</div>
</template>
<script>

import axios from "axios";
import loginBox from '../../../ui-components/Layout/login-box.vue';
import LoginForm from '../../../ui-components/Form/LoginForm.vue';
import {GetUser} from "../../../Api.js";

export default {
    components: {loginBox, LoginForm},
    methods:{
        async getUser(){

            const response = await GetUser();
            if (response.success == 200){
                this.$router.push('/');
            }
        },

    },
    mounted() {
        this.getUser()
    }


}

</script>
<style scoped>

</style>
