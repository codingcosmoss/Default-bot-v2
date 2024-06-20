<template>
    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="index.html" class="logo logo-dark">

                    </a>

                    <a href="index.html" class="logo logo-light">

                    </a>
                </div>

                <button @click="onMenu()" type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="menu_btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
                <button @click="onMenuMedia()" type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="menu_btn2">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

                <!-- App Search-->
                <form class="app-search d-none d-lg-block">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="bx bx-search-alt"></span>
                    </div>
                </form>

            </div>

            <div class="d-flex">


                <button @click="this.$router.push('/chat')" type="button" class="btn header-item noti-icon waves-effect" >
                    <i class="bx bx-chat"></i>
                </button>

                <NotificationBtn/>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="http://127.0.0.1:8000/assets/images/users/avatar-1.jpg"
                             alt="Header Avatar">
                        <span class="d-none d-xl-inline-block ms-1" key="t-henry">Henry</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                        <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle me-1"></i> <span key="t-my-wallet">My Wallet</span></a>
                        <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end">11</span><i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">Settings</span></a>
                        <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle me-1"></i> <span key="t-lock-screen">Lock screen</span></a>
                        <div class="dropdown-divider"></div>
                        <a @click="logout()" class="dropdown-item text-danger" ><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button @click="setting()" type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                        <i class="bx bx-cog bx-spin"></i>
                    </button>
                </div>

            </div>
        </div>
    </header>

</template>
<script>
import NotificationBtn from "@/ui-components/Items/AnimationButtons/NotificationBtn.vue";
import {Logout} from "@/Api.js";
    export default {
        components:{NotificationBtn},
        methods:{
            setting(){
                const app = document.getElementById('app');
                if (app.classList.contains('right-bar-enabled')){
                    app.classList.remove('right-bar-enabled');
                }else {
                    app.classList.add('right-bar-enabled');
                }
            },
            async logout(){
                const response = Logout();
                this.$router.push('/login');
            },
            onMenuMedia(){
                const body = document.getElementById('body');

                if (body.classList.contains('sidebar-enable')){
                    body.classList.remove('sidebar-enable');

                }else {
                    body.classList.add('sidebar-enable');

                }
            },
            onMenu(){

                const body = document.getElementById('body');
                const menuBox = document.querySelector('.vertical-menu');
                const menuBox2 = document.querySelector('.navbar-brand-box');
                const mainContent = document.querySelector('.main-content');
                const texts = document.querySelectorAll('.menu-text');
                const logo = document.querySelectorAll('.logo');

                if (menuBox.classList.contains('menuHidden')){
                    menuBox.classList.remove('menuHidden');
                    menuBox2.classList.remove('menuHidden');
                    mainContent.classList.remove('mainContent');
                    body.classList.remove('sidebar-enable');
                    texts.forEach((text)=>{
                        text.classList.remove('hidden');
                    })
                    logo.forEach((e)=>{
                            e.classList.remove('logo_hidden');
                    })
                }else {
                    body.classList.add('sidebar-enable');
                    menuBox.classList.add('menuHidden');
                    menuBox2.classList.add('menuHidden');
                    mainContent.classList.add('mainContent');
                    texts.forEach((text)=>{
                        text.classList.add('hidden');
                    })
                    logo.forEach((e)=>{
                        e.classList.add('logo_hidden');
                    })
                }
            }
        }
    }
</script>
