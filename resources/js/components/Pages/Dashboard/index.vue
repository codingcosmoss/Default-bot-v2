<template>
    <Page Title="">

        <div class="row">

            <DashboardBox
                v-for="item in items"
                :Title="item.name"
                :Number="item.words_count"
            />

        </div>

    </Page>
</template>
<script>
    import Page from "@/components/Layout/Page.vue";
    import DashboardBox from "@/ui-components/Items/Box/DashboardBox.vue";
    import {phrases} from "@/Api.js";
    import {useConterStore} from "@/store/counter.js";

    export default {
        components:{Page, DashboardBox},
        data(){return{
            items: []
        }},
        methods:{
            async getItems(){
                try {
                    const response = await phrases();
                    this.items = response.data;
                }catch (e){
                    useConterStore().sendError(this, e);
                }
            }
        },
        mounted(){
            this.getItems()
        }
    }
</script>
