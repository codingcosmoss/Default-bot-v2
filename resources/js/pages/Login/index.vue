<template>

    <Layout @onCopy="login = 'admin', password = '12345678adc', addForm() " >
        <LoginInput
            Label = "Username"
            Pholder="username"
            :Value="login"
            @onInput="login = $event"
            @keyup.enter="addForm()"
            :isError="'login' in errors"
        />
        <LoginInput
            Label = "Password"
            Pholder="password"
            :Value="password"
            @onInput="password = $event"
            Type="password"
            @keyup.enter="addForm()"
            :isError="'password' in errors"
        />

        <br>

        <div class=" d-grid">
            <button :class="Loader && 'disabled' "  @click="addForm()" class="btn btn-primary waves-effect waves-light" type="submit">Tizimga kirish</button>
        </div>
    </Layout>


</template>
<script>
    import Page from "@/components/Layout/Page.vue";
    import Layout from "./layout.vue";
    import LoginInput from "@/ui-components/Forms/LoginInput.vue";
    import {GetUser, Login} from "../../helpers/api.js";
    import axios from "axios";
    import {Alert} from "../../helpers/Config.js";
    import {useConterStore} from "@/store/counter.js";

    export default {
        setup(){
            const counterStore = useConterStore();
            return{counterStore}
        },
        components:{LoginInput, Layout, Page},
        data(){
            return{
                login: '',
                password: '',
                isError: false,
                Loader: false,
                errors: []
            }
        },
       methods:{
           async getUser(){
               const response = await GetUser();
               console.log(response)
               if (response.success == 200){
                   Alert('info', this.$t('youlogged'));
                   localStorage.setItem('user', JSON.stringify(response.data));
                   localStorage.setItem('token', response.data.role_token);
                   this.counterStore.updateUser(response.data);
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
                   if (response.success != undefined){
                       if (response.success == 200){
                           this.isError = false;
                           this.Loader = false;
                           localStorage.setItem('0008a78764c2', response.data['token']);
                           localStorage.setItem('user', JSON.stringify(response.data['user']));
                           localStorage.setItem('token', response.data['user']['role_token']);
                           localStorage.setItem('reload', true);
                           this.counterStore.updateUser(response.data['user']);
                           this.$router.push('/redirect');
                           Alert('success', this.$t('loginSuccess'));
                           return true;
                       }else {
                           this.Loader = false;
                           Alert('error', this.$t("loginPasswordError"))
                           return false;
                       }

                   }else {
                       this.errors = response.data;
                       Alert('error', this.$t("loginPasswordError"))
                       this.isError = true;
                       this.Loader = false;
                       return false;
                   }

               } catch (error) {
                   Alert('error', this.$t("loginPasswordError"))
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
