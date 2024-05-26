<template>

    <!-- Begin page -->
    <div id="layout-wrapper">


<!--        <Topbar></Topbar>-->
<!--        <LeftMenu></LeftMenu>-->

        <MainContent :Title="Title" :Links="Links">
            <slot></slot>
        </MainContent>



    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <RightBar></RightBar>
    <!-- /Right-bar -->

</template>
<script >
    import Topbar from "@/components/Layout/Topbar.vue";
    import LeftMenu from "@/components/Layout/LeftMenu.vue";
    import RightBar from "@/components/Layout/RightBar.vue";
    import MainContent from "@/ui-components/Containers/MainContent.vue";
    export default {
        components:{MainContent, RightBar, LeftMenu, Topbar},
        props:{
            Title:{
                type: [String, Number],
                default: 'Main title'
            },
            Links:{
                type: [Array],
                default: []
            }
        }
    }
</script>
