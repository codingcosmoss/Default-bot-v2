<template >
    <div x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
        x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
        :class="{ 'dark text-bodydark bg-boxdark-2': darkMode === true }">

        <!-- ===== Preloader Start ===== -->
<!--        <include src="./partials/preloader.html"></include>-->
<!--        <preloader></preloader>-->
        <!-- ===== Preloader End ===== -->

        <!-- ===== Page Wrapper Start ===== -->
        <div class="flex h-screen overflow-hidden">


            <!-- ===== Sidebar Start ===== -->
            <Sidebar :onSidebarToggle = "onSidebarToggle"  ></Sidebar>
            <!-- ===== Sidebar End ===== -->



            <!-- ===== Content Area Start ===== -->
            <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
                <!-- ===== Header Start ===== -->
                <Header @darkMode = "darkMode = $event"  @sidebarToggle = "onSidebarToggle = $event" ></Header>

                <!-- ===== Header End ===== -->

                <!-- ===== Main Content Start ===== -->
                <main>
                    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">

                        <Contents title="Page/ Contents" ></Contents>

                        <div class="mt-4 grid grid-cols-12 gap-4 md:mt-6 md:gap-6 2xl:mt-7.5 2xl:gap-7.5">

                            <slot>

                            </slot>

                        </div>
                    </div>
            </main>
            <!-- ===== Main Content End ===== -->
        </div>
        <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->
</div></template>
<script>
import Preloader from "../../ui-components/Element/preloader.vue";
import Sidebar from "../../ui-components/Element/Sidebar/sidebar.vue";
import Header from "../../ui-components/Element/header.vue";
import Chart01 from "../../ui-components/Element/chart-01.vue";
import Chart02 from "../../ui-components/Element/chart-02.vue";
import Chart03 from "../../ui-components/Element/chart-03.vue";
import Map01 from "../../ui-components/Element/map-01.vue";
import Table01 from "../../ui-components/Element/table-01.vue";
import Contents from "../../ui-components/Element/Contents.vue";

export default {
    components: {Contents, Table01, Map01, Chart03, Chart02, Chart01, Header, Sidebar, Preloader},
    data(){
        return{
            darkMode: true,
            onSidebarToggle: null
        }
    },
    methods:{
        log(e){
            console.log(e)
        }
    }
}
</script>
<style ></style>
