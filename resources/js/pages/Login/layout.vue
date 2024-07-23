<template>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary-subtle">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">{{$t('WelcomeBack')}}</h5>
                                        <p>{{$t('EnterLogin')}}</p>
                                    </div>
                                </div>
                                {{}}
                                <div class="col-5 align-self-end">
                                    <img :src="counterStore.baseUrl + '/assets/images/profile-img.png'" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="auth-logo">
                                <a  class="auth-logo-light">
                                    <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img :src="counterStore.baseUrl + '/assets/images/logo-light.svg'" alt="" class="rounded-circle" height="34">
                                            </span>
                                    </div>
                                </a>

                                <a href="index.html" class="auth-logo-dark">
                                    <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img :src="counterStore.baseUrl +'/assets/images/logo.svg'" alt="" class="rounded-circle" height="34">
                                            </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                                    <slot>

                                    </slot>
                            </div>
                            <div class="mt-5 text-center">
                                <div>
<!--                                    <p>Hisobingiz yo‘qmi ? <a @click="this.$router.push('/register')" class="fw-medium text-primary"> Ro'yxatdan o'tish </a> </p>-->
                                    <p>© {{$t('PoweredByCodingCosmos')}}</p>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</template>
<script >
import {useConterStore} from "@/store/counter.js";
export default
{
    setup(){
        const counterStore = useConterStore();
        return{counterStore}
    },
}
</script>
