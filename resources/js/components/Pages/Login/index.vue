<template>

<!--    Text, Logo , FormTitle , isError-->
  <Layout :isError = "isError" FormTitle = "Casmetologiya" >

      <Form >

        <!--     Label, Value, Icon | @Result     -->
          <Input
              Label = "Login"
              Plholder = "Enter your login"
              @onInput = "login = $event"
              :Value = "login"
          />

          <Input
              @onInput = "password = $event"
              Label = "Password"
              :Value = "password"
              Plholder = "Enter your password"
          />



          <PrimaryButton @click = "addForm" Title = "Sign in" ></PrimaryButton>
      </Form>

  </Layout>

</template>
<script >

    import Form from "./Form.vue";
    import Layout from "./Layout.vue";
    import InputText from "../../../ui-components/Form/InputText.vue";
    import PrimaryButton from "../../../ui-components/Form/PrimaryButton.vue";
    import {GetUser} from "../../../Api.js";
    import axios from "axios";
    import Input from "@/components/Pages/Diseases/EditPassword/Inputs/Input.vue";

    export default {
        components: {Input, PrimaryButton, InputText, Layout, Image, Form},
        data(){
            return{
                login: '',
                password: '',
                isError: false
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
                try {
                    let data = {
                        login : this.login,
                        password : this.password
                    }
                    const response = await axios.post('/login', data);

                    localStorage.setItem('lang', 'uz');
                    localStorage.setItem('0008a78764c2',  response.data.data);
                    console.log('Response',response)

                    if (response.data.success != undefined){
                        if (response.data.success == 200){

                            this.isError = false;
                            this.$router.push('/'); //  sizning hedef rout'ingiz nomi
                        }

                    }else {
                        this.isError = true;
                    }


                } catch (error) {
                    this.isError = true;
                }
            },

        },
        mounted() {
            this.getUser()
        }
    }
</script>
