<template>
    <Page>
        <Table>

        </Table>

    </Page>
</template>
<script>


import {defineComponent} from "vue";
import Page from "@/components/Layout/Page.vue";
import Table from "./Table.vue";

export default defineComponent({
    components: {Table, Page}
})
</script>
