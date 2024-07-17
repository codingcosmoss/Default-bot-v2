<template>

    <div class="main-content data_box">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">{{Title}}</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li v-for="(link , index) in Links" @click="!link['status'] && this.$router.push(link['path'])" :class="link['status'] ? 'link_active ' : ''" class="cursor-pointer">{{ link['name'] }} <span v-if="index != Links.length-1" >/&nbsp;</span> </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <slot>
                    <!--    Shu yerga import qilinadi    -->
                </slot>

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


<!--        <footer class="footer">-->
<!--            <div class="container-fluid">-->
<!--                <div class="row">-->

<!--                    <div class="col-sm-6">-->
<!--                        <div class="text-sm-end d-none d-sm-block">-->
<!--                            Design & Develop by Themesbrand-->
<!--                        </div>-->

<!--                    </div>-->
<!--                    <div class="col-sm-6">-->
<!--                        <div class="text-sm-end d-none d-sm-block">-->
<!--                            Design & Develop by Themesbrand-->
<!--                        </div>-->

<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </footer>-->

    </div>


</template>

<script>
    export default {
        props:{
            Title:{
                type: [String, Number],
                default: 'Main title'
            },
            Links:{
                type: [Array],
                default: [
                    {
                        path: '/',
                        name: 'Dashboard',
                        status: false
                    },
                    {
                        path: '/',
                        name: 'Menu',
                        status: true
                    }
                ]
            }
        },
        methods:{
            isMenuHidden(){
                const menuBox = document.querySelector('.vertical-menu');
                const mainContent = document.querySelector('.main-content');
                if (menuBox.classList.contains('menuHidden')){
                    mainContent.classList.add('mainContent');
                }else {
                    mainContent.classList.remove('mainContent');
                }
            }
        },
        mounted() {
            this.isMenuHidden()
        }
    }

</script>
<style>

</style>
