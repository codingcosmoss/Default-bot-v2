<template>
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <h1 class="display-2 fw-medium">4<i class="bx bx-buoy bx-spin text-primary display-3"></i>1</h1>
                        <h5 class="text-uppercase" >{{$t('ServerError')}}</h5>
                        <h5 class="d-flex justify-content-center align-items-center">
                            <i class="bx bx-envelope"></i>&nbsp;
                            {{$t('Email')}}: &nbsp;
                            <span class="text-info">codingcosmoss@gmail.com</span></h5>

                        <br>
                        <h5 class="text-danger d-flex justify-content-center align-items-center"><i class="bx bxs-error-alt"></i> &nbsp; {{this.$route.query.error}}</h5>

                        <div class="mt-5 text-center">
                            <a class="btn btn-primary waves-effect waves-light" @click="this.$router.push('/admin')">Back to Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-6">
                    <div>
                        <img :src="counterStore.baseUrl+'/assets/images/error-img.png'" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
    .account-pages{
        width: 100%;
        margin: 0 !important;
        height: 100vh;
        padding-top: 100px !important;
    }
</style>
<script>
import {useConterStore} from "@/store/counter.js";
export default
{
    setup(){
        const counterStore = useConterStore();
        return{counterStore}
    },
}
</script>
