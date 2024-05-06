<template>

    <Layout>
        <LoginInput
            Label = "Username"
            Pholder="username"
            :Value="login"
            @onInput="login = $event"
        />
        <LoginInput
            Label = "Password"
            Pholder="password"
            :Value="password"
            @onInput="password = $event"
            Type="password"
        />

        <br>
        <div class="mt-3 d-grid">
            <button :class="Loader && 'disabled' " @click="addForm" class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
        </div>
    </Layout>

</template>
<script>
    import Page from "@/components/Layout/Page.vue";
    import Layout from "./layout.vue";
    import LoginInput from "@/ui-components/Forms/LoginInput.vue";
    import {GetUser, Login} from "@/Api.js";
    import axios from "axios";
    import {Alert} from "@/Config.js";
    export default {
        components:{LoginInput, Layout, Page},
        data(){
            return{
                login: '',
                password: '',
                isError: false,
                Loader: false,
            }
        },
       methods:{
           async getUser(){
               const response = await GetUser();
               console.log(response)
               if (response.success == 200){
                   this.$router.push('/admin');
               }
           },
           async addForm(){
               try {
                   this.Loader = true;
                   let data = {
                       login : this.login,
                       password : this.password
                   }
                   const response = await Login(data);
                   console.log(response);
                   if (response.success != undefined){
                       if (response.success == 200){
                           this.isError = false;
                           this.Loader = false;
                           localStorage.setItem('0008a78764c2', response.data['token']);
                           localStorage.setItem('user', JSON.stringify(response.data['user']));
                           this.$router.push('/admin');
                           Alert('success', 'Tizimga muvoffaqiyatli kirdingiz !')
                       }else {
                           this.Loader = false;
                           Alert('error', "Login yoki parol noto'g'ri")
                       }

                   }else {
                       Alert('error', "Login yoki parol noto'g'ri")
                       this.isError = true;
                       this.Loader = false;
                   }


               } catch (error) {
                   this.Loader = false;
                   this.isError = true;
               }

           },
           async getUserLocal(){
               const response = await GetUser();
               this.$router.push('/'); //  sizning hedef rout'ingiz nomi
           }

       },
        mounted() {
            this.getUser()
        }

    }
</script>
