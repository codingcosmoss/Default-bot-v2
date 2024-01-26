<template>

    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
        <!--begin::Menu Container-->
        <div class="aside-menu my-4" >

            <!--begin::Menu Nav-->
            <ul class="menu-nav" >

<!--                <li class="menu-section">-->
<!--                    <h4 class="menu-text">Custom</h4>-->
<!--                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>-->
<!--                </li>-->
                <slot>

                </slot>


            </ul>
            <!--end::Menu Nav-->

        </div>
        <!--end::Menu Container-->
    </div>
    <!--end::Aside Menu-->

</template>
<script >
    import MenuList from "./MenuList.vue";

    export default {
        name: 'AsideMenu',
        components: {MenuList},
        props: {
            MenuIcon:String,
            Title: String

        }
    }
</script>

<style scoped>

    .menu-nav{
        //padding: 0 ;
        overflow: scroll !important;
        height: 100vh !important;
        padding-bottom: 100px;
        padding-top: 0px !important;


    }
    .menu-nav::-webkit-scrollbar {
        width: 5px;
        background-color: rgba(211, 206, 206, 0);
    }

    .menu-nav::-webkit-scrollbar-thumb {
        background-color: rgba(235, 148, 8, 0.45); /* Scroll chizigi rangi */
        border-radius: 20px;
    }
</style>
