<template >
    <form class="form" @submit.prevent >
        <!--begin::Title-->
        <div class="pb-13 pt-lg-0 pt-5 mb-4">
            <h3 class="title-box font-weight-bolder text-dark title font-size-h4 font-size-h1-lg ">{{Title}}</h3>
            <span class="text-muted font-weight-bold font-size-h4 d-flex" style="flex-direction: column;;">
                <!-- <a class="text-danger font-weight-bolder" >Malumotlarini o'zgartirish taqiqlanadi !</a> -->
                <a v-if="isError"   class="text-danger error-text font-weight-bolder">Login yoki parol noto'g'ri !</a></span>
        </div>
        <!--begin::Title-->
        <!--begin::Form group-->
        <div class="form-group">
            <label class="font-size-h6 font-weight-bolder text-white ">Login</label>
            <input class="form-control form-control-solid h-auto py-3 px-6 rounded-lg" type="text" :value="email" @input = "email = $event.target.value" name="username"
                autocomplete="off" />
        </div>

        <!--end::Form group-->
        <!--begin::Form group-->
        <div class="form-group">

            <label class="font-size-h6 font-weight-bolder text-white pt-5">Password</label>


            <input class="form-control h-auto py-3 px-6 mb-5 rounded-lg bg-dark" type="password" :value="password"
                   @input = "password = $event.target.value" name="password"
                autocomplete="off" />
        </div>
        <!--end::Form group-->
        <!--begin::Action-->

        <div class="pb-lg-0 pb-5">
            <button @click="this.addForm()" type="button"
                class="btn btn-primary font-weight-bolder font-size-h6 px-8 w-100 py-3 my-3 mr-3">Sign In</button>

        </div>

        <!--end::Action-->
    </form>
</template>

<script>
 import axios from "axios";

    export default {
        name: 'LoginForm',
        props:{
            Title:{
                type: String,
                default: 'Welcome to Metronic'
            },
        },
        data(){
            return{
                email:'user@gmail.com',
                password: 'user',
                isError: false
            }
        },

        methods:{
            async addForm(){
                try {

                    const response = await axios.post('/login', {
                        email : this.email,
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

    }

</script>


<style scoped>

.title {
    color: white !important;
}

input {
    font-size: 15px ;
    font-weight: 500 !important;
    border-radius: 0 !important;
    border: none;
	background-color: #262747 !important;
    color: white !important;
}
.form{
    width: 100%;
}
.title-box{
    font-size: 27px;
    font-weight: bold;
    margin-bottom: 10px;
}
.error-text{
    font-size: 17px;
    font-weight: bold;
    height: 30px;
}
.form-group{
    display: flex;
    flex-direction: column;
    margin: 30px 0;
}
label{
    margin-bottom: 10px;
    font-weight: bold;
}
input{
    height: 60px;
    font-size: 18px;
}
button{
    width: 100%;
    background: #029af8;
    font-weight: bold;
    color: white;
}






</style>
