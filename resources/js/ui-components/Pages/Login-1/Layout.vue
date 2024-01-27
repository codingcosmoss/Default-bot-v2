<template>

    <div
        x-data="{ page: 'signin', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
        x-init="
          darkMode = JSON.parse(localStorage.getItem('darkMode'));
          $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
        :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">


        <!-- ====== Forms Section Start -->
        <div style="height: 100vh" class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="flex flex-wrap items-center">
                <div class="hidden w-full xl:block xl:w-1/2">
                    <div class="py-17.5 px-26 text-center">
                        <a class="mb-5.5 inline-block" href="index.html">
                            <img class="hidden dark:block" :src="Logo" alt="Logo" />
                        </a>

                        <p class="font-medium 2xl:px-20">
                           {{Text}}
                        </p>
                        <Image >

                        </Image>

                    </div>
                </div>
                <div class="w-full border-stroke dark:border-strokedark xl:w-1/2 xl:border-l-2">
                    <div class="w-full p-4 sm:p-12.5 xl:p-17.5">
                        <span class="mb-1.5 block font-medium"> </span>
                        <h2 class="mb-2 text-2xl font-bold text-black dark:text-white sm:text-title-xl2">
                            {{FormTitle}}
                        </h2>
                        <a v-if="isError" style="font-weight: bold"  class=" text-danger error-text font-weight-bolder">Login yoki parol noto'g'ri !</a>
                        <br>
                        <br>
                        <slot>

                        </slot>


                    </div>
                </div>
            </div>
        </div>
        <!-- ====== Forms Section End -->
    </div>

</template>
<script >
import Image from "./Image.vue";

export default {
    components: { Image},

    data(){
        return{
            darkMode: true
        }
    },
    props:{
        Text:{
            type: String,
            default: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit suspendisse.'
        },
        Logo:{
            type: String,
            default: function (){
                return window.location.origin + '/images/logo/logo.svg';
            }
        },
        FormTitle:{
            type: String,
            default: 'Form title'
        },

        isError:{
            type: Boolean,
            default: false
        },
    }
}
</script>
