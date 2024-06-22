<template>

    <Layout>
        <LoginInput
            Label = "Username"
            Pholder="username"
            :Value="login"
            @onInput="login = $event"
        />

        <LoginInput
            Label = "Parol"
            Pholder="password"
            :Value="password"
            @onInput="password = $event"
            Type="password"
        />

        <LoginInput
            Label = "Parolni takrorlang"
            Pholder="password"
            :Value="reset_password"
            @onInput="reset_password = $event"
            Type="password"
        />

        <br>
        <div class="mt-3 d-grid">
            <button :class="Loader && 'disabled' " @click="addForm" class="btn btn-primary waves-effect waves-light" type="submit">Ro'yxatdan o'tish</button>
        </div>

    </Layout>

</template>
<script>
    import Page from "@/components/Layout/Page.vue";
    import Layout from "./layout.vue";
    import LoginInput from "@/ui-components/Forms/LoginInput.vue";
    import {GetUser, Login, Register} from "../../helpers/Api.js";
    import axios from "axios";
    import {Alert} from "@/Config.js";
    export default {
        components:{LoginInput, Layout, Page},
        data(){
            return{
                login: '',
                password: '',
                reset_password: '',
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
                   if ((this.reset_password != this.password) || this.password.length < 5 ){
                       this.isError = true;
                       this.Loader = false;
                       Alert('error', 'Parolni kiritishda xatolik bor, parol eng kami 5ta harfdan iboratbolishi kerak')
                       return true;
                   }
                   if (this.login.length < 5){
                       Alert('error', "Formadagi barcha maydonlar eng kami 5ta harf va sonlar bilan toldirilishi kerak ")
                       return true;
                   }
                   let data = {
                       login : this.login,
                       password : this.password
                   }
                   const response = await Register(data);
                   console.log(response);
                   if (response.success != undefined){
                       if (response.success == 200){
                           this.isError = false;
                           this.Loader = false;
                           localStorage.setItem('0008a78764c2', response.data['token']);
                           localStorage.setItem('user', JSON.stringify(response.data['user']));
                           this.$router.push('/');
                           Alert('success', 'Muvoffaqiyatli kirdingiz !')
                       }else {
                           this.Loader = false;
                           Alert('error', "Bunday username mavjud !")
                       }

                   }else {
                       Alert('error', "Bunday username mavjud")
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
