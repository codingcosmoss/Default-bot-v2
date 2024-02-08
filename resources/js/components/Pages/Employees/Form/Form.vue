<template>

    <Page :Classes = "false">
        <FormLayouts></FormLayouts>
    </Page>

</template>
<script >

import Page from "../../../Layout/Page.vue";
import FormLayouts from "./Form-layouts.vue";
export default {
    components:{FormLayouts, Page,}
}
</script>
