<template>
    <Page :Classes = "false" >

        <CreateForm></CreateForm>

    </Page>
</template>
<script >
import Page from "../../Layout/Page.vue";
import CreateForm from "./SettingForms.vue";
    export default {
        components:{CreateForm, Page},

    }

</script>
