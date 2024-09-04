<template>

    <Layout>

        <DefaultInput
            :Label = "$t('PharmacyName')"
            :Pholder="$t('PharmacyName')"
            Name="name"
            Type="text"
            :Validated="errors"
            :Value="name"
            @onInput="name = $event,  delete this.errors.name"
        />

        <DefaultInput
            :Label = "$t('Username')"
            :Pholder="$t('Username')"
            Name="login"
            Type="text"
            :Validated="errors"
            :Value="login"
            @onInput="login = $event,  delete this.errors.login"
        />

        <DefaultInput
            :Label = "$t('Password')"
            :Pholder="$t('Password')"
            Name="password"
            Type="password"
            :Validated="errors"
            :Value="password"
            @onInput="password = $event,  delete this.errors.password"
        />

        <DefaultInput
            :Label = "$t('ReturnedPassword')"
            :Pholder="$t('ReturnedPassword')"
            Name="reset_password"
            Type="password"
            :Validated="errors"
            :Value="reset_password"
            @onInput="reset_password = $event,  delete this.errors.reset_password"
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
    import {GetUser, Login, Logout, Register} from "../../helpers/api.js";
    import {Alert} from "@/helpers/Config.js"
    import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
    import {useConterStore} from "@/store/counter.js";
    export default {
        components:{DefaultInput, LoginInput, Layout, Page},
        setup(){
            const counterStore = useConterStore();
            return{counterStore}
        },
        data(){
            return{
                login: '',
                password: '',
                name: '',
                reset_password: '',
                isError: false,
                Loader: false,
                errors: []
            }
        },
       methods:{
           // async getUser(){
           //     const response = await GetUser();
           //     console.log(response)
           //     if (response.success == 200){
           //         this.$router.push('/admin');
           //     }
           // },
           async addForm(){
               try {
                   // this.Loader = true;
                   this.errors = [];

                   if (this.reset_password != this.password){
                       this.errors['password'] = this.$t('PasswordError2');
                       this.errors['reset_password'] = this.$t('PasswordError2');
                   }else if(this.password.length < 5){
                       this.errors['password'] = this.$t('PasswordError');
                   }

                   if (this.login.length < 5){
                       this.errors['login'] = this.$t('UsernameError');
                   }

                   if (this.errors.length != 0){
                       this.isError = true;
                       this.Loader = false;
                       console.log('false');
                       return false;
                   }

                   let data = {
                       login : this.login,
                       name : this.name,
                       password : this.password
                   }
                   const response = await Register(data);
                   console.log(response);
                   if (response.success != undefined){
                       if (response.success == 200){
                           localStorage.setItem('token', response.data['token']);
                           localStorage.setItem('user', JSON.stringify(response.data['user']));
                           this.counterStore.updateUser(response.data['user']);
                           const logout = await Logout();
                           Alert('success', this.$t("AccauntCreated"))
                           this.isError = false;
                           this.Loader = false;
                           this.$router.push('/login');
                           return;
                       }else if (response.success == 203){
                           this.errors['login'] = this.$t('UsernameError2')
                           this.isError = true;
                           this.Loader = false;
                           return;
                       }

                   }{
                       Alert('error', this.$t('formError'));
                       this.isError = true;
                       this.Loader = false;
                       return;
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
            // this.getUser()
        }

    }
</script>
