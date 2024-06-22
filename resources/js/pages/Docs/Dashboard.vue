<template>
    <Page Title="Dashboard">

        <DocsRow>
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


    </Page>
</template>
<script>
import Page from "@/components/layout/Page.vue";
import CardBlock from "@/components/all/CardBlock.vue";
import DocsRow from "@/components/all/DocsRow.vue";
import PregBox from "@/components/all/PregBox.vue";
export default {
    components:{PregBox, Page, CardBlock, DocsRow},

}
</script>
