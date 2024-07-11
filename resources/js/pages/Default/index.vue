<template>
    <Page Title="">
        <div class="row"  >
            <h1>{{ $t('home') }} 2</h1>
        </div>
    </Page>
</template>
<script>
    import Page from "@/components/layout/Page.vue";
    import {ApiError} from "@/helpers/Config.js";
    import {userOrderBys} from "@/helpers/madel.js";
    import {Alert} from "@/helpers/Config.js";
    import {useConterStore} from "@/store/counter.js";
    export default {
        components: {Page},
        setup(){
            const counterStore = useConterStore();
            return{counterStore}
        },
        data(){return{
            items: [],
            item: [],
            paginateCount: 10,
            column: 'id',
            type: 'desc',
            errors: [],
        }},
        methods:{
            async index(){
                try {
                    const response = await myModels();
                    this.items = response.data;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async indexActives(){
                try {
                    const response = await myModelActives(this.paginateCount);
                    this.items = response.data;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async indexPaginates(){
                try {
                    const response = await myModelPaginates(this.paginateCount);
                    this.items = response.data;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async orderBys(){
                try {
                    const response = await myModelOrderBys(this.column, this.type);
                    this.items = response.data;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async show(id){
                try {
                    const response = await myModelShow(id);
                    this.item = response.data;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async create(){
                try {
                    let data = {
                        // ...
                    }
                    const response = await myModelCreate(data);
                    if (response.status){
                        Alert('success', this.$t('create'));
                        return true;
                    }
                    this.errors = response.errors;
                    Alert('error', this.$t('formError'));
                    return false;
                }catch(error){
                    ApiError(this, error);
                    return false;
                }
            },
            async update(){
                try {
                    let data = {
                        // ...
                    }
                    const response = await myModelUpdate(data);
                    if (response.status){
                        Alert('success', this.$t('update'));
                        return true;
                    }
                    this.errors = response.errors;
                    Alert('error', this.$t('formError'));
                    return false;
                }catch(error){
                    ApiError(this, error);
                    return false;
                }
            },
            async search(text = ''){
                try {
                    const response = await myModelSearch(text);
                    this.items = response.data;
                    if (!response.status){
                        Alert('error', this.$t('formError'));
                        return false;
                    }
                    return true;
                }catch(error){
                    ApiError(this, error);
                    return false;
                }
            },
            async delete(id){
                try {
                    const response = await myModelDelete(id);
                    this.items = response.data;
                    if (response.status){
                        Alert('success', this.$t('delete'));
                    }
                    Alert('error', this.$t('formError'));
                    return false;
                }catch(error){
                    ApiError(this, error);
                    return false;
                }
            },
        },
        mounted() {
            this.indexPaginates()
        }
    }
</script>
<style></style>
