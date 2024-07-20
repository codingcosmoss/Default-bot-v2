<template>
    <Page Title="">
        <div class="row"  >
            <BasicTable
                :Th="headers"
                :Title="$t('ExpenseCategories')"
                Col="col-lg-12"
            >
                <template v-slot:inputs>
                    <DefaultInput
                        Class="col-lg-3 col-sm-2 search_input"
                        Label=""
                        Name="name"
                        Type="text"
                        Pholder="Search..."
                        @onInput="search($event)"
                    />

                    <DefaultSelect
                        Label=""
                        Class="col-lg-2 col-sm-2"
                        @onInput="this.paginateCount = $event, this.indexPaginates()"
                    >
                        <option value="10" selected >{{$t('NumberDownloads')}}</option>
                        <option value="10" >10</option>
                        <option value="20" >20</option>
                        <option value="50" >50</option>
                        <option value="100" >100</option>
                    </DefaultSelect>
                </template>

                <template v-slot:buttons>
                    <PrimaryBtn v-if="counterStore.hasRole('ExpenseCategories-create')" role="button" data-bs-toggle="modal" data-bs-target="#expense_categoryCreate" >{{$t('Create')}}</PrimaryBtn>
                </template>

                <tr v-for="item in items" >
                    <td>
                        #{{ item.id }}
                    </td>
                    <td>
                        {{ item.name }}
                    </td>
                    <td>{{ item.description }}</td>
                    <td @click="this.$router.push({path:'/admin/expense/categories/show', query:{id: item.id}})" :class="item.expenses_count > 0 ? 'cursor-pointer text-info' : '' ">{{ item.expenses_count }}</td>
                    <td>
                        <PrimaryIconBtn v-if="counterStore.hasRole('ExpenseCategories-update')" @click="this.item = item" Icon="bx bx-edit-alt" Modal="expense_categoryUpdate"/>&nbsp;
                        <PrimaryIconBtn  @click="this.$router.push({path:'/admin/expense/categories/show', query:{id: item.id}})" Icon="bx bx-show"/>&nbsp;
                        <PrimaryIconBtn  v-if="counterStore.hasRole('ExpenseCategories-delete') && item.expenses_count == 0" @click="this.delete(item.id)" class="bg-danger border-danger" Icon="bx bx-trash-alt"/>
                    </td>

                </tr>
                <Paginate
                    v-if="last_page != 1"
                    :currentPage="this.current_page"
                    :totalPages="this.last_page"
                    @changePage="indexPaginates($event)"
                />

                <GrowingLoader v-if="loader" :Cols="headers.length"/>

            </BasicTable>

        </div>

        <Update :Item="item" @onUpdate="indexPaginates(this.current_page)" />
        <Create  @onCreate="indexPaginates(this.current_page)" />
    </Page>
</template>
<script>
    import Page from "@/components/layout/Page.vue";
    import {ApiError} from "@/helpers/Config.js";
    import {Alert} from "@/helpers/Config.js";
    import {useConterStore} from "@/store/counter.js";
    import BasicTable from "@/components/all/BasicTable.vue";
    import {expense_categorys, expense_categoryCreate, expense_categorySearch, expense_categoryUpdate, expense_categoryShow, expense_categoryDelete, expense_categoryPaginates, expense_categoryActives, expense_categoryOrderBys} from "@/helpers/api.js";
    import GrowingLoader from "@/components/all/GrowingLoader.vue";
    import PrimaryButton from "@/components/all/PrimaryButton.vue";
    import PrimaryIconBtn from "@/components/all/PrimaryIconBtn.vue";
    import ModalCentered from "@/components/all/ModalCentered.vue";
    import Update from "./update.vue";
    import Create from "./create.vue";
    import PrimaryBtn from "@/components/all/PrimaryBtn.vue";
    import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
    import Paginate from "@/components/all/Paginate.vue";
    import DefaultSelect from "@/ui-components/Forms/DefaultSelect.vue";
    export default {
        components: {
            DefaultSelect,
            Paginate,
            DefaultInput,
            PrimaryBtn,
            ModalCentered, PrimaryIconBtn, PrimaryButton, GrowingLoader, BasicTable, Page, Update, Create},
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
            loader: false,
            headers: [
                this.$t('Id'),
                this.$t('ModalName'),
                this.$t('Desc'),
                this.$t('Expenses'),
                this.$t('Settings'),
            ]
        }},
        methods:{
            async index(){
                try {
                    const response = await expense_categorys();
                    this.items = response.data;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async indexActives(){
                try {
                    const response = await expense_categoryActives(this.paginateCount);
                    this.items = response.data;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async indexPaginates(page=1){
                try {
                    this.loader = true;
                    const response = await expense_categoryPaginates(this.paginateCount, page);
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
                    const response = await expense_categoryOrderBys(this.column, this.type);
                    this.items = response.data;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async show(id){
                try {
                    const response = await expense_categoryShow(id);
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
                    const response = await expense_categoryCreate(data);
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
                    const response = await expense_categoryUpdate(data);
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
                    this.loader = true;
                    if (text == ''){
                        this.indexPaginates();
                        return true;
                    }
                    const response = await expense_categorySearch(text);
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
                    const response = await expense_categoryDelete(id);
                    if (response.status){
                        this.indexPaginates(this.current_page)
                        Alert('success', this.$t('delete'));
                        return true;
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
