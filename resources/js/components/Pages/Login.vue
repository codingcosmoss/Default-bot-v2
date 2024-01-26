<template >
    <div class="d-flex flex-column flex-root AdminBox ">

		<login-box>
            <LoginForm Title = "Muhammadalidev.uz"/>
        </login-box>

        <!-- <alert-white :alert = "true" :title = "''" :desc = "'Xatolik yuz berdi'" :isActive = "showAlert" /> -->

	</div>
</template>
<script>

import axios from "axios";
import loginBox from '../../ui-components/Layout/login-box.vue';
import LoginForm from '../../ui-components/Form/LoginForm.vue';

export default {
    components: {loginBox, LoginForm},
    data(){
        return{
            showAlert: false
        }
    },
    
    methods:{
        async getUser(){

            try {
                const response = await axios.get('/test', {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}` // Tokenni Authorization sarlavhasi bilan yuborish
                    }
                });

                if (response.data.success == 200){
                    // this.$router.push('/login');
                    console.log('success');
                }

            } catch (error) {

            }
        }
    },
    mounted() {
        // this.getUser();
    }


}

</script>
<style scoped>

</style>
