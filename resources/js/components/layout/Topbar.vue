<template>
    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">

                    <a :style="'background-image: url('+ counterStore.user.logo[0].url +');'" href="/" class="logo logo-light company_logo">

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
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img id="header-lang-img" :src="getLocale()" alt="Header Language" height="16">
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a :class="local.type == locale ? 'localActive' : '' " v-for="local in locales" @click="saveLocal(local.type)" class="dropdown-item notify-item language" data-lang="en">
                            <img :src="local.img" alt="user-image" class="me-1" height="12"> <span class="align-middle">{{$t(local.title)}}</span>
                        </a>
                    </div>
                </div>

                <NotificationBtn/>

                <div class="dropdown d-inline-block">



                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" :src="counterStore.user.image != null ? counterStore.user.image[0].url : '' "
                             alt="Header Avatar">
                        <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{counterStore.user.name}}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>

                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a class="dropdown-item" @click="this.$router.push('/admin/profile')" ><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
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
import {Logout} from "../../helpers/api.js";
import {useConterStore} from "@/store/counter.js";

export default {
        components:{NotificationBtn},
        setup(){
            const counterStore = useConterStore();
            return{counterStore}
        },
        data(){return{
            locale: localStorage.getItem('locale'),
            logo: '',
            locales:[
                {
                    title: 'English',
                    type: 'EN',
                    img: location.origin + '/assets/images/flags/us.jpg'
                },
                {
                    title: 'Russian',
                    type: 'RU',
                    img: location.origin + '/assets/images/flags/russia.jpg'
                },
                {
                    title: 'Uzbek',
                    type: 'UZ',
                    img: location.origin + '/assets/images/flags/uz.jpg'
                }

            ]
        }},
        methods:{
            saveLocal(type){
                this.$i18n.locale = type;
                localStorage.setItem('locale', type);
                this.locale = type;
            },
            getLocale(){
                let locale = this.locales.find(local => local.type == localStorage.getItem('locale'));
                if (locale){
                    return locale.img;
                }
            },
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
                localStorage.removeItem('0008a78764c2');
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
                const accordions = document.querySelectorAll('.accordion');


                if (menuBox.classList.contains('menuHidden')){
                    menuBox.classList.remove('menuHidden');
                    menuBox2.classList.remove('menuHidden-copy');
                    mainContent.classList.remove('mainContent');
                    body.classList.remove('sidebar-enable');
                    texts.forEach((text)=>{
                        text.classList.remove('hidden');
                    })
                    accordions.forEach((e)=>{
                        e.classList.remove('accordion-hidden');
                    })
                    logo.forEach((e)=>{
                            e.classList.remove('logo_hidden');
                    })
                }else {
                    body.classList.add('sidebar-enable');
                    menuBox.classList.add('menuHidden');
                    menuBox2.classList.add('menuHidden-copy');
                    mainContent.classList.add('mainContent');
                    texts.forEach((text)=>{
                        text.classList.add('hidden');
                    })
                    logo.forEach((e)=>{
                        e.classList.add('logo_hidden');
                    })
                    accordions.forEach((e)=>{
                        e.classList.add('accordion-hidden');
                    })
                }
            }
        },

        mounted() {

        }
}
</script>
