<template>
    <Page Title="">

        <div class="row">

            <DashboardBox
                :Title="items[0].name"
                :Number="items[0].words_count + ' ta'"
            />
            <DashboardBox
                :Title="items[1].name"
                :Number="items[1].words_count + ' ta'"
            />
            <DashboardBox
                :Title="items[2].name"
                :Number="items[2].words_count + ' ta'"
            />
            <DashboardBox
                :Title="items[3].name"
                :Number="items[3].words_count + ' ta'"
            />
            <DashboardBox
                :Title="items[4].name"
                :Number="items[4].words_count + ' ta'"
            />

            <DashboardBox
                Title="Jami so'zlar"
                :Number="wordsCount + ' ta'"
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
            items: [{name:'Darak gap',words_count:0 },{name:'So\'roq gap',words_count:0 },{name:'Buyruq gap',words_count:0 },{name:'Istak gap',words_count:0 },{name:'His hayajon gap',words_count:0 },],
            wordsCount: 0
        }},
        methods:{
            async getItems(){
                try {
                    const response = await phrases();
                    this.items = response.data;
                    let count = 0;
                    response.data.forEach((e)=>{
                        count += e.words_count;
                    })
                    this.wordsCount = count;
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
