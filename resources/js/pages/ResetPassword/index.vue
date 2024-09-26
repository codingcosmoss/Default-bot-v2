<template>

    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" >
                    <div v-if="!isSuccess" class="text-center mb-5">
                        <LoaderSpinning></LoaderSpinning>
                    </div>
                    <div v-if="isSuccess" class="text-center mb-5">
                        <i class="bx bx-key text-success bx-tada" style="font-size: 60px"></i>
                        <h4 class=" text404">{{message}}</h4>
                        <p class="text-primary" >{{output}}</p>
                        <div class="mt-5 text-center">
                            <a class=" btn btn-primary waves-effect waves-light" href="/" >Back to Login</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-6">
                    <div>
                        <img :src="url + 'assets/images/error-img.png'" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import {resetPassword} from "@/helpers/api.js";
import {Alert} from "@/helpers/Config.js"
import Swal from 'sweetalert2'

export default
{
    data(){
        return{
            url: location.origin,
            isSuccess: false,
            message: '',
            output: ''
        }
    },
    methods:{
        async index(){
            try {
                const response = await resetPassword();
                if (response.status != null && response.status == true){
                    this.message = response.message;
                    this.output = response.output;
                    this.isSuccess = true;
                    return true;
                }else{
                    Swal.fire({
                        title: "Not allowed",
                        text: "",
                        icon: "error"
                    });
                }
            }catch(error){
                Swal.fire({
                    title: "Not allowed",
                    text: "",
                    icon: "error"
                });
            }
        },
    },
    mounted() {
        this.index();
    }
}
</script>

<style scoped lang="scss">
.account-pages{
    width: 100%;
    margin: 0 !important;
    height: 100vh;
    padding-top: 100px !important;
    z-index: 99999 !important;
    position: absolute;
    background: white;
}
.text404{
    color: #495057;
    }
</style>
