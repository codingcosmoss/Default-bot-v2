<template>
    <Page Title="Tables">

        <DocsRow Title="1. Input">
            <BaseBox Col="col-xl-12" >
                <DefaultInput
                    v-for="i in 2"
                    Label="Input label"
                    Name="InputName"
                    Type="text"
                    :Validated="[]"
                    @onInput="$event"
                />
            </BaseBox>
            <PregBox No="1"
                     Codes=" &lt;BaseBox Col=&quot;col-xl-12&quot; &gt;
                &lt;DefaultInput
                    v-for=&quot;i in 2&quot;
                    Label=&quot;Input label&quot;
                    Name=&quot;InputName&quot;
                    Type=&quot;text&quot;
                    :Validated=&quot;[]&quot;
                    @onInput=&quot;$event&quot;
                /&gt;
            &lt;/BaseBox&gt;"
            />

        </DocsRow>

    </Page>
</template>
<script>
import Page from "@/components/layout/Page.vue";
import CardBlock from "@/components/all/CardBlock.vue";
import DocsRow from "@/components/all/DocsRow.vue";
import PregBox from "@/components/all/PregBox.vue";
import CardClassicBlock from "@/components/all/CardClassicBlock.vue";
import BasicTable from "@/components/all/BasicTable.vue";
import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";

export default {
    components: {DefaultInput, BasicTable, PregBox, Page,DocsRow},
    data(){return{
        tableItems3:[
            {
                id: 1,
                name: 'Neal Matthews',
                date: '2023-21-21',
                total: '100,00 uzs',
                status: 'active'
            },
            {
                id: 2,
                name: 'Neal Matthews',
                date: '2023-21-21',
                total: '100,00 uzs',
                status: 'active'
            }
        ]
    }}
}
</script>
