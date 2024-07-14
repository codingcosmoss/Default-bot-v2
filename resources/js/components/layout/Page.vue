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
    <ModalCentered
        ModalName="changeRole"
        :isModalFooter="false"
        :Title="$t('Alert')"
    >
       <AlertContainer/>
    </ModalCentered>

</template>
<script >
    import Topbar from "@/components/Layout/Topbar.vue";
    import LeftMenu from "@/components/Layout/LeftMenu.vue";
    import RightBar from "@/components/Layout/RightBar.vue";
    import MainContent from "@/ui-components/Containers/MainContent.vue";
    import {roleShow, roleNotification} from "@/helpers/api.js";
    import {useConterStore} from "@/store/counter.js";
    import ModalCentered from "@/components/all/ModalCentered.vue";
    import AlertContainer from "@/ui-components/Containers/AlertContainer.vue";

    export default {
        components:{AlertContainer, ModalCentered, MainContent, RightBar, LeftMenu, Topbar},
        setup(){
            const counterStore = useConterStore();
            return{counterStore}
        },
        props:{
            Title:{
                type: [String, Number],
                default: 'Main title'
            },
            Links:{
                type: [Array],
                default: []
            }
        },
        methods:{
            isToken(){
                let token = localStorage.getItem('0008a78764c2');
                if (!token || token == undefined || token == null){
                    this.$router.push('/login');
                }
            },
            async isChangeRole(){

               try {
                   let token = localStorage.getItem('token');
                   if (!token || token == null){
                       localStorage.setItem('token', '');
                       token = '';
                   }

                   const response = await roleNotification(this.counterStore.user.role_id);
                   if (response.data.user_id == this.counterStore.user.id || response.data.user_id == 0 ){
                       if ( response.status && response.data.token != token){
                           const myModal = new bootstrap.Modal(document.getElementById('changeRole'));
                           myModal.show();
                       }
                   }

               }catch (error){
                   this.$router.push('/login');
               }

            }
        },
        mounted() {
            setTimeout(()=>{
                this.isChangeRole()
            }, 500)
            this.isToken();
        }

    }
</script>
