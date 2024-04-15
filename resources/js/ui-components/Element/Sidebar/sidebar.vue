<template >

  <aside  :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'"
    class="absolute  aside01 left-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-hidden bg-black duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0"
    >
    <!-- SIDEBAR HEADER -->
    <div class="flex items-center justify-between gap-2 px-6 my-logo " :style="'background-image: url(' + Image + ')'" >
      <a href="#">
      </a>

      <button class="block lg:hidden" @click.outside="sidebarToggle = false">
        <svg class="fill-current" width="20" height="18" viewBox="0 0 20 18" fill="none"
          xmlns="http://www.w3.org/2000/svg">
          <path
            d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.55 19.45 8.175 19 8.175Z"
            fill="" />
        </svg>
      </button>

    </div>


    <!-- SIDEBAR HEADER -->

    <div class="no-scrollbar  flex flex-col overflow-y-auto duration-300 ease-linear" >
      <!-- Sidebar Menu -->
      <nav class=" sidebar01 mt-5 py-4  lg:mt-9 " x-data="{selected: $persist('Dashboard')}" >

        <!-- Menu Group -->
        <div>
          <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">MENU</h3>

         <navbar></navbar>

        </div>


      </nav>
      <!-- Sidebar Menu -->
    </div>
  </aside>
</template>
<script>
import {useConterStore} from "../../../store/counter.js";
import axios from "axios";
import Navbar from "./navbar.vue";
export default {
    components: {Navbar},


    data(){
        return{
            selected: '',
            page: '',
            sidebarToggle: true,
            baseURL: window.location.origin,
            Image: ''
        }
    },

    props:{
        onSidebarToggle:{
            type: Boolean,
            default: false ,
            required: false
        },
        navbarAnime:{
            type: Boolean,
            default:true,
        },
        MyLogo:{
            type: String,
            default: function () {
                return window.location.origin + '/images/logo/logo.svg';
            },
            required: false
        },
    },
    watch: {
        onSidebarToggle: function(newVal, oldVal) { // watch it
            console.log('ok')
            this.sidebarToggle = true;
        }
    },



      methods:{
        onMenu(e){
            if (e ==1){
                console.log(1)
            }else{
                console.log(0)
            }
        },
        animation(){
            const aside = document.querySelector('.aside01');
            if (this.navbarAnime){
                if(aside.classList.contains("navbar02")){
                    aside.classList.remove('navbar02')

                }
                aside.classList.add('navbar01')
            }else {
                if(aside.classList.contains("navbar01")){
                    aside.classList.remove('navbar01')
                }
                aside.classList.add('navbar02')
            }
        },
        getUserImage(){
            this.user =JSON.parse(localStorage.getItem('user'));
            this.Image =  this.user.image[0] != null ? this.user.image[0].url : 'https://demo.tailadmin.com/src/images/logo/logo.svg';
            console.log(this.Image);
        }
      },

    mounted() {
        this.animation()
        this.getUserImage()
    }


}
</script>
<style >
.navbar01{
    position: fixed;
}
.navbar02{
    position: fixed;
}
.navbar02:hover{
    position: fixed;

}

@media (min-width: 1024px) {
    .navbar01{
        width: 80px;
        animation: box-nav 0.5s linear alternate;
    }
    .navbar02{
        width: 80px ;
    }
    .sidebar01{
        //padding:0 10px;
    }
    .navbar01:hover{
        width: 280px;

        .text01{
            display: block !important;
        }
    }
    .text01{
        display: none;
    }

}
@keyframes box-nav {
    from{
        width: 280px;
    }to{
         width: 80px;
     }

}
</style>
