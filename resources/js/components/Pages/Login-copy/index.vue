<template>

<!--    Text, Logo , FormTitle , isError-->
  <Layout :isError = "isError" FormTitle = "Casmetologiya" >

      <Form >

          <Input
              Label = "Login"
              Pholder = "Enter your login"
              @onInput = "login = $event"
              :Value = "login"

          />

          <Input
              @onInput = "password = $event"
              Label = "Password"
              :Value = "password"
              Pholder = "Enter your password"
              Type = 'password'
          />

          <span style="display: flex; justify-content: center">
                   <loader-spinning v-if="Loader" style="margin: 0 auto; " />
          </span>
          <PrimaryButton v-if="!Loader" @click = "addForm" Title = "Sign in" ></PrimaryButton>
      </Form>

  </Layout>

</template>
<script >

    import Form from "./Form.vue";
    import Layout from "./Layout.vue";
    import InputText from "../../../ui-components/Form/InputText.vue";
    import PrimaryButton from "../../../ui-components/Form/PrimaryButton.vue";
    import {GetUser} from "../../../Api.js";
    import {Alert} from "@/Config.js";
    import axios from "axios";
    import Input from "../../../ui-components/Form/Input.vue";



    export default {
        components: {Input, PrimaryButton, InputText, Layout, Image, Form},
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
                    this.$router.push('/');
                }
            },
            async addForm(){
                localStorage.removeItem('0008a78764c2');
                localStorage.removeItem('roles');
                localStorage.removeItem('user');
                localStorage.removeItem('reload');
                try {
                    this.Loader = true;
                    let data = {
                        login : this.login,
                        password : this.password
                    }
                    const response = await axios.post('/login', data);

                    localStorage.setItem('lang', 'uz');
                    localStorage.setItem('0008a78764c2',  response.data.data);
                    if ( localStorage.getItem('darkMode' ) == null){
                        localStorage.setItem('darkMode', true );
                    }

                    if (response.data.success != undefined){
                        if (response.data.success == 200){
                            this.isError = false;
                            Alert('success', 'Login successfully !')
                            this.getUserLocal()
                        }else {
                            this.Loader = false;
                        }

                    }else {
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
                localStorage.setItem('user', JSON.stringify(response.data));
                this.$router.push('/'); //  sizning hedef rout'ingiz nomi
            },

        },
        mounted() {
            this.getUser()
        }
    }
</script>
