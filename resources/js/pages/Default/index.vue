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
    import {Alert} from "@/helpers/Config.js";
    import {useConterStore} from "@/store/counter.js";
    import {myModels, myModelCreate, myModelSearch, myModelUpdate, myModelShow, myModelDelete, myModelPaginates, myModelActives, myModelOrderBys} from "@/helpers/api.js";
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
            last_page: 1,
            current_page: 1,
            column: 'id',
            type: 'desc',
            errors: [],
            headers: [],
            loader: false
        }},
        methods:{
            async index(){
                try {
                    this.loader = true;
                    const response = await myModels();
                    this.items = response.data;
                    this.loader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async indexActives(){
                try {
                    this.loader = true;
                    const response = await myModelActives(this.paginateCount);
                    this.items = response.data;
                    this.loader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async indexPaginates(page=1){
                try {
                    this.loader = true;
                    const response = await myModelPaginates(this.paginateCount, page);
                    this.current_page = response.data.pagination.current_page;
                    this.last_page = response.data.pagination.last_page;
                    this.items = response.data.items;
                    this.loader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async orderBys(){
                try {
                    this.loader = true;
                    const response = await myModelOrderBys(this.column, this.type);
                    this.items = response.data;
                    this.loader = false;
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
                    this.loader = true;
                    let data = {
                        // ...
                    }
                    const response = await myModelCreate(data);
                    if (response.status){
                        Alert('success', this.$t('create'));
                        this.loader = false;
                        return true;
                    }
                    this.errors = response.errors;
                    Alert('error', this.$t('formError'));
                    this.loader = false;
                    return false;
                }catch(error){
                    ApiError(this, error);
                    this.loader = false;
                    return false;
                }
            },
            async update(){
                try {
                    this.loader = true;
                    let data = {
                        // ...
                    }
                    const response = await myModelUpdate(this.$route.id, data);
                    if (response.status){
                        Alert('success', this.$t('update'));
                        this.loader = false;
                        return true;
                    }
                    this.errors = response.errors;
                    Alert('error', this.$t('formError'));
                    this.loader = false;
                    return false;
                }catch(error){
                    ApiError(this, error);
                    this.loader = false;
                    return false;
                }
            },
            async search(text = ''){
                try {
                    this.loader = true;
                    if (text == ''){
                        this.indexPaginates();
                        return true;
                    }
                    const response = await myModelSearch(text);
                    this.items = response.data;
                    this.loader = false;
                    if (!response.status){
                        Alert('error', this.$t('formError'));
                        this.loader = false;
                        return false;
                    }
                    this.loader = false;
                    return true;
                }catch(error){
                    ApiError(this, error);
                    this.loader = false;
                    return false;
                }
            },
            async delete(id){
                try {
                    if (!confirm(this.$t('DeleteAlert'))){
                        return false;
                    }
                    const response = await myModelDelete(id);
                    this.items = response.data;
                    if (response.status){
                        this.indexPaginates()
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
