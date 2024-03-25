<template>
    <Page :Classes="false">
        <Table2></Table2>
    </Page>
</template>
<script>


import {defineComponent} from "vue";
import Page from "@/components/Layout/Page.vue";
import Table from "./Table.vue";
import Table2 from "./table-03.vue";

export default defineComponent({
    components: {Table, Page, Table2}
})
</script>
