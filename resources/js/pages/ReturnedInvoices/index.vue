<template>
    <Page Title="">
        <div class="row">
        <BasicTable
                :Th="[ $t('No'),$t('MedicineName'),$t('Date'),$t('Identifikator'),$t('Customer'),$t('Seller'),$t('Amount'),$t('Subtotal'),$t('Settings')]"
                :Title="$t('ReturnHistory')"
                Col="col-lg-12"
            >
                <template v-slot:inputs>
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
                    </DefaultSelect>&nbsp;&nbsp;
                    <DefaultInput
                        Class="col-lg-3 col-sm-2 search_input"
                        Label=""
                        Name="start"
                        Type="date"
                        @onInput="startDate = $event, search()"
                    />
                    <DefaultInput
                        Class="col-lg-3 col-sm-2 search_input"
                        Label=""
                        Name="finish"
                        Type="date"
                        @onInput="finishDate = $event, search()"
                    />
                </template>

                <template v-slot:buttons>
                    <PrimaryBtn v-if="counterStore.hasRole('invoices-create')" role="button" data-bs-toggle="modal" data-bs-target="#invoiceCreate" >{{$t('Create')}}</PrimaryBtn>
                </template>

                <tr v-for="(item, i) in items" >
                    <td>{{ ((current_page - 1) * paginateCount) +  i + 1 }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ counterStore.formatDate(item.created_at) }}</td>
                    <td>#{{item.invoice_id }}</td>
                    <td>{{ item.customer.name }}</td>
                    <td>{{ item.user.name }}</td>
                    <td>{{ counterStore.formatNumber(item.amount) }}</td>
                    <td>{{ counterStore.formatNumber(item.subtotal) }} {{item.currency.sign}}</td>

                    <td>
                        <PrimaryIconBtn  @click="this.$router.push({path:'/admin/returned/invoices/show', query:{id: item.invoice_id}})" Icon="bx bx-show"/>
                        <PrimaryIconBtn v-if="counterStore.hasRole('invoices-delete')" @click="this.delete(item.id)" class="bg-danger border-danger" Icon="bx bx-trash-alt"/>
                    </td>

                </tr>
                <Paginate
                    Cols="9"
                    v-if="last_page != 1 && !isSearch"
                    :currentPage="this.current_page"
                    :totalPages="this.last_page"
                    @changePage="indexPaginates($event)"
                />
                <Paginate
                    Cols="9"
                    v-if="last_page != 1 && isSearch"
                    :currentPage="this.current_page"
                    :totalPages="this.last_page"
                    @changePage="search($event)"
                />

                <GrowingLoader v-if="loader" Cols="9"/>

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
    import {invoiceReturns, invoiceCreate, invoiceReturnSearch, invoiceUpdate, invoiceShow, invoiceDelete, invoicePaginates, invoiceActives, invoiceOrderBys} from "@/helpers/api.js";
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
            startDate: null,
            finishDate: null,
            isSearch: false
        }},
        methods:{
            async index(){
                try {
                    const response = await invoices();
                    this.items = response.data;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async indexActives(){
                try {
                    const response = await invoiceActives(this.paginateCount);
                    this.items = response.data;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async indexPaginates(page=1){
                try {
                    this.loader = true;
                    this.isSearch = false;
                    const response = await invoiceReturns(this.paginateCount, page);
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
                    const response = await invoiceOrderBys(this.column, this.type);
                    this.items = response.data;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async show(id){
                try {
                    const response = await invoiceShow(id);
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
                    const response = await invoiceCreate(data);
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
                    const response = await invoiceUpdate(data);
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
            async search(page=1){
                try {
                    this.loader = true;

                    let data = {
                        start: this.startDate,
                        finish: this.finishDate
                    }
                    this.isSearch = true;
                    const response = await invoiceReturnSearch(data, page);
                    this.items = response.data.items;
                    this.current_page = response.data.pagination.current_page;
                    this.last_page = response.data.pagination.last_page;
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
                    const response = await invoiceDelete(id);
                    this.items = response.data;
                    if (response.status){
                        this.indexPaginates(this.current_page)
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
