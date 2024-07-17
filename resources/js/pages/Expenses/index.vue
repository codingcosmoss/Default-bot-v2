<template>
    <Page Title="">
        <div class="row"  >

            <div v-for="total in totals" @click="getCurrencies(total.currency_id)" class="col-lg-3 cursor-pointer">
                <div class="card mini-stats-wid">
                    <div  class="card-body">
                        <div  class="d-flex flex-wrap">
                            <div class="me-3">
                                <p class="text-muted mb-2">{{total.title == 'Sum' ? $t('Total') : total.title}}</p>
                                <h5 class="mb-0">{{counterStore.formatNumber(total.total_amount)}} {{total.sign}}</h5>
                            </div>
                            <div class="avatar-sm ms-auto">
                                <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                    <i class="bx bx-money"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <BasicTable
                :Th="headers"
                :Title="$t('Expenses')"
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
                    </DefaultSelect>&nbsp;&nbsp;
                </template>

                <template v-slot:buttons>
                    <PrimaryBtn v-if="counterStore.hasRole('Expenses-create')" role="button" data-bs-toggle="modal" data-bs-target="#expenseCreate" >{{$t('Create')}}</PrimaryBtn>
                </template>

                <tr v-for="item in items" >
                    <td>
                        #{{ item.id }}
                    </td>
                    <td>
                        {{ item.title }}
                    </td>
                    <td>{{ counterStore.formatNumber(item.amount) +' '+ item.currency.sign }}</td>
                    <td>{{ item.date }}</td>
                    <td>{{ item.category }}</td>
                    <td>
                        <PrimaryIconBtn v-if="counterStore.hasRole('Expenses-update')" @click="this.item = item" Icon="bx bx-edit-alt" Modal="expenseUpdate"/>&nbsp;
                        <PrimaryIconBtn  @click="this.$router.push({path:'/admin/expenses/show', query:{id: item.id}})" Icon="bx bx-show"/>&nbsp;
                        <PrimaryIconBtn v-if="counterStore.hasRole('Expenses-delete')" @click="this.delete(item.id)" class="bg-danger border-danger" Icon="bx bx-trash-alt"/>
                    </td>

                </tr>
                <Paginate
                    v-if="last_page != 1"
                    :currentPage="this.current_page"
                    :totalPages="this.last_page"
                    @changePage="indexPaginates($event)"
                />

                <GrowingLoader v-if="loader" Cols="7"/>


                <tr>


                </tr>
            </BasicTable>


        </div>

        <Update :Item="item" @onUpdate="indexPaginates(this.current_page), getTotals()" />
        <Create  @onCreate="indexPaginates(this.current_page), getTotals()" />
    </Page>
</template>
<script>
    import Page from "@/components/layout/Page.vue";
    import {ApiError} from "@/helpers/Config.js";
    import {Alert} from "@/helpers/Config.js";
    import {useConterStore} from "@/store/counter.js";
    import BasicTable from "@/components/all/BasicTable.vue";
    import {
        expenses,
        expenseCreate,
        expenseSearch,
        expenseUpdate,
        expenseShow,
        expenseDelete,
        expensePaginates,
        expenseActives,
        expenseOrderBys,
        expenseTotal, expenseCurrencies
    } from "@/helpers/api.js";
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
    import CardBlock from "@/components/all/CardBlock.vue";
    export default {
        components: {
            CardBlock,
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
            headers: [
                this.$t('Id'),
                this.$t('Title'),
                this.$t('Amount'),
                this.$t('Date'),
                this.$t('ExpensesCategory'),
                this.$t('Settings')
            ],
            paginateCount: 10,
            last_page: 1,
            current_page: 1,
            column: 'id',
            type: 'desc',
            errors: [],
            loader: false,
            totals: []
        }},
        methods:{
            async index(){
                try {
                    const response = await expenses();
                    this.items = response.data;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async getCurrencies(id){
                try {
                    if (id == 0){
                        this.indexPaginates(1)
                        Alert('info', this.$t('currenciesAlert'))
                        return;
                    }
                    const response = await expenseCurrencies(id);
                    this.items = response.data;
                    Alert('info', this.$t('currenciesAlert'))
                }catch(error){
                    ApiError(this, error);
                }
            },
            async getTotals(){
                try {
                    const response = await expenseTotal();
                    let sum = 0;
                    response.data.forEach(e => {
                        sum +=e.total_amount;
                    })
                    let arr = response.data;
                    arr.push({
                        title: 'Sum',
                        sign: '',
                        currency_id: 0,
                        total_amount: sum
                    })
                    this.totals = arr;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async indexPaginates(page=1){
                try {
                    this.loader = true;
                    const response = await expensePaginates(this.paginateCount, page);
                    this.current_page = response.data.pagination.current_page;
                    this.last_page = response.data.pagination.last_page;
                    this.items = response.data.items;
                    this.item = response.data.items[0];
                    this.loader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async orderBys(){
                try {
                    const response = await expenseOrderBys(this.column, this.type);
                    this.items = response.data;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async show(id){
                try {
                    const response = await expenseShow(id);
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
                    const response = await expenseCreate(data);
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
                    const response = await expenseUpdate(data);
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
                    const response = await expenseSearch(text);
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
                    const response = await expenseDelete(id);
                    this.items = response.data;
                    if (response.status){
                        Alert('success', this.$t('delete'));
                        this.indexPaginates(this.current_page)
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
            this.indexPaginates(),
                this.getTotals()
        }
    }
</script>
<style></style>
