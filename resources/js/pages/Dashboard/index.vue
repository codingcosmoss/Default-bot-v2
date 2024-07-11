<template>
    <Page Title="">
        <div class="row"  >
            <h1>{{ $t('home') }}</h1>
        </div>
    </Page>
</template>
<script>
    import Page from "@/components/layout/Page.vue";
    export default {
        components: {Page},
        data(){return{
        }},
        methods:{
            async index(){
                try {
                }catch(error){
                    console.log(error);
                }
            }
        },
        mounted() {
            this.index()
        }
    }
</script>
<style></style>
