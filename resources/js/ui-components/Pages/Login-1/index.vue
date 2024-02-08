<template>

<!--    Text, Logo , FormTitle , isError-->
  <Layout :isError = "isError" >

      <Form>

        <!--     Label, Value, Icon | @Result     -->
          <InputText
              @Result = "login = $event"
              :Value = "login"
              Icon = "fa-solid fa-right-to-bracket"
          />
          <InputText
              @Result = "password = $event"
              :Value = "password"
              Icon = "fa-solid fa-lock"
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
                login:'user@gmail.com',
                password: 'user',
                isError: false
            }
        },
        methods:{
            async getUser(){

                const response = await GetUser();
                if (response.success == 200){
                    this.$router.push('/');
                }
            },
            async addForm(){
                try {

                    const response = await axios.post('/login', {
                        email : this.login,
                        password : this.password
                    });

                    localStorage.setItem('0008a78764c2',  response.data.data);

                    if (response.data.success == 200){
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
