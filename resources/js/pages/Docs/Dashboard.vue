<template>
    <Page Title="Dashboard">

        <DocsRow Title="1. d_card_block">
            <div v-for="i in 4" class="col-md-3">
                <CardBlock
                    Title="Card block title"
                    Number="$1,200"
                    Icon="bx bx-copy-alt font-size-24"
                />
            </div>
            <PregBox No="1"
                     Codes=" &lt;div v-for=&quot;i in 4&quot; class=&quot;col-md-3&quot;&gt;
                &lt;CardBlock
                    Title=&quot;Card block title&quot;
                    Number=&quot;$1,200&quot;
                    Icon=&quot;bx bx-copy-alt font-size-24&quot;
                /&gt;
             &lt;/div&gt;"
            />
        </DocsRow>

        <DocsRow Title="2. classic_card_block">

            <CardClassicBlock
                v-for="i in 3"
                Icon="bx bx-copy-alt"
                Title="Card block title"
                Number="$1,200"
                Share="12.3 %"
                Text="Skote Saas Dashboard"
            />

            <PregBox No="2"
                     Codes="&lt;CardClassicBlock
                v-for=&quot;i in 3&quot;
                Icon=&quot;bx bx-copy-alt&quot;
                Title=&quot;Card block title&quot;
                Number=&quot;$1,200&quot;
                Share=&quot;12.3 %&quot;
                Text=&quot;Skote Saas Dashboard&quot;
            /&gt;"
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

export default {
    components: {BasicTable, CardClassicBlock, PregBox, Page, CardBlock, DocsRow},

}
</script>
