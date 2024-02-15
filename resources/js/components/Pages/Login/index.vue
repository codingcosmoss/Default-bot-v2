<template>

<!--    Text, Logo , FormTitle , isError-->
  <Layout :isError = "isError" FormTitle = "Casmetologiya" >

      <Form >

        <!--     Label, Value, Icon | @Result     -->
          <InputText
              @result = "login = $event"
              :Value = "login"
              Icon = "fa-solid fa-right-to-bracket"
              Plholder = "Enter your login"
              Label = "Login"
          />
          <InputText
              @result = "password = $event"
              :Value = "password"
              Icon = "fa-solid fa-lock"
              Plholder = "Enter your password"
              Label = "Password"

          />

          <PrimaryButton @click = "addForm" ></PrimaryButton>
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

    export default {
        components: {PrimaryButton, InputText, Layout, Image, Form},
        data(){
            return{
                login:'admin',
                password: '121212',
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

                    const response = await axios.post('/login', {
                        login : this.login,
                        password : this.password
                    });

                    localStorage.setItem('lang', 'uz');
                    localStorage.setItem('0008a78764c2',  response.data.data);

                    if (response.status == 200){
                        this.isError = false;
                        this.$router.push('/'); //  sizning hedef rout'ingiz nomi
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
