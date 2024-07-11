<template>
    <Page Title="Tables">

        <DocsRow Title="1. Input">
            <BaseBox Col="col-xl-12" >
                <DefaultInput
                    v-for="i in 2"
                    Label="Input name"
                    Name="name"
                    Type="text"
                    :Validated="errors"
                    :Value="name"
                    @onInput="name = $event,  delete this.errors.name"
                />
            </BaseBox>
            <PregBox No="1"
                     Codes="    &lt;DefaultInput
                    v-for=&quot;i in 2&quot;
                    Label=&quot;Input name&quot;
                    Name=&quot;name&quot;
                    Type=&quot;text&quot;
                    :Validated=&quot;errors&quot;
                    :Value=&quot;name&quot;
                    @onInput=&quot;name = $event,  delete this.errors.name&quot;
                /&gt;"
            />

        </DocsRow>

        <DocsRow Title="2. Image Input">
            <BaseBox Col="col-xl-12" >
                <ImageInput
                    Title="Image input"
                    Name="image"
                    @onImage="image = $event,  delete this.errors.image"
                    :Image="image"
                    :Validated="errors"
                />
            </BaseBox>
            <PregBox No="2"
                     Codes="&lt;BaseBox Col=&quot;col-xl-12&quot; &gt;
                &lt;ImageInput
                    Title=&quot;Image input&quot;
                    Name=&quot;image&quot;
                    @onImage=&quot;image = $event,  delete this.errors.image&quot;
                    :Image=&quot;image&quot;
                    :Validated=&quot;errors&quot;
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
import ImageInput from "@/components/all/ImageInput.vue";

export default {
    components: {ImageInput, DefaultInput, BasicTable, PregBox, Page,DocsRow},
    data(){return{
        errors: [],
        image: location.origin + '/Photos/file.png',
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
