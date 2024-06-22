<template>
    <Page Title="">

        <div class="row">
        </div>

    </Page>
</template>
<script>
    import Page from "@/components/Layout/Page.vue";
    import DashboardBox from "@/ui-components/Items/Box/DashboardBox.vue";
    import {useConterStore} from "@/store/counter.js";

    export default {
        components:{Page, DashboardBox},
        data(){return{
            items: [{name:'Darak gap',words_count:0 },{name:'So\'roq gap',words_count:0 },{name:'Buyruq gap',words_count:0 },{name:'Istak gap',words_count:0 },{name:'His hayajon gap',words_count:0 },],
            wordsCount: 0
        }},

        mounted(){
        }
    }
</script>
<style>
    .test:hover{
        background: aquamarine;
    }
</style>
