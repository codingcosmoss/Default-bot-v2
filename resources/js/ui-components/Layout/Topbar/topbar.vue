<template>

    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">

        </div>

        <div class="topbar">


          <slot>

          </slot>

        </div>


    </div>
    <!--end::Container-->

</template>
<script >
    export default {
        name: 'topbar'
    }

</script>

<style scoped>
.container-fluid{
    box-shadow: 1px 1px 15px rgba(0, 0, 0, 0.12);
}

.topbar{
    width: 100% !important;
    display: flex ;
    justify-content: space-between !important;
    align-items: center;
}

</style>
