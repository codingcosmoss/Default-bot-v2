<template >

    <Page>

        <chart01 title="chart-01" ></chart01>
        <chart02 title="chart-02" ></chart02>
        <chart03 title="chart-03" ></chart03>
        <Table01 title="table-01"></Table01>
        <Chat01 title="chat-01"></Chat01>

    </Page>

</template>
<script>
import Preloader from "../../ui-components/Element/preloader.vue";
import Sidebar from "../../ui-components/Element/Sidebar/sidebar.vue";
import Header from "../../ui-components/Element/header.vue";
import Chart01 from "../../ui-components/Element/chart-01.vue";
import Chart02 from "../../ui-components/Element/chart-02.vue";
import Chart03 from "../../ui-components/Element/chart-03.vue";
import Map01 from "../../ui-components/Element/map-01.vue";
import Table01 from "../../ui-components/Element/table-01.vue";
import Chat01 from "../../ui-components/Element/chat-01.vue";
import Page from "../Layout/Page.vue";
import Contents from "../../ui-components/Element/Contents.vue";

export default {
    components: {Contents, Page, Table01, Map01, Chart03, Chart02, Chart01, Header, Sidebar, Preloader, Chat01},
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
