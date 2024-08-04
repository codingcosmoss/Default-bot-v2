<template>
    <Page Title="">
        <div class="row">
            <BasicTable
                :Th="[ $t('No'),$t('Warehouse'),$t('Supplier'),$t('ImportedDate'),$t('Subtotal'),$t('AmountPaid'),$t('Indebtedness'),$t('Status'),$t('Settings')]"
                :Title="$t('ImportedDrugs')"
                Col="col-lg-12"
            >
                <template v-slot:inputs>

                    <DefaultInput
                        Class="col-lg-3 col-sm-2 search_input"
                        Label=""
                        Name="name"
                        Type="text"
                        :Pholder="$t('DateSearch')"
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
                    <PrimaryBtn v-if="counterStore.hasRole('Documents-create')" role="button" data-bs-toggle="modal" data-bs-target="#documentCreate" >{{$t('NewImportMedicines')}}</PrimaryBtn>
                </template>

                <tr v-for="(item,i) in items" >
                    <td>{{ ((current_page - 1) * paginateCount) +  i + 1 }}</td>
                    <td>{{ item.warehouse.name }}</td>
                    <td>{{ item.supplier.name }}</td>
                    <td>{{ item.date }}</td>
                    <td>{{ counterStore.formatNumber(item.subtotal)}} {{item.currency.sign}} </td>
                    <td>{{ counterStore.formatNumber(item.amount_paid)}} {{item.currency.sign}} </td>
                    <td :class="item.loan_amount > 0 ?  'text-danger' : '' ">{{ counterStore.formatNumber(item.loan_amount)}} {{item.currency.sign}} </td>

                    <td>
                        <span :class="item.status == 5 ? 'badge-soft-success' : 'badge-soft-warning' "
                              class="badge badge-pill  font-size-11">{{ item.status  == 5 ? $t('Saved') : $t('NotSaved') }}</span>

                    </td>
                    <td>
                        <PrimaryIconBtn v-if="counterStore.hasRole('Documents-update')" @click="this.item = item" Icon="bx bx-edit-alt" Modal="documentUpdate"/>
                        <PrimaryIconBtn v-if="counterStore.hasRole('Documents-update') && item.status != 5"
                                        @click="this.$router.push({path:'/admin/import', query:{id: item.id}})"
                                        Icon="bx bx-receipt"/>

                        <PrimaryIconBtn v-if="counterStore.hasRole('Documents-update') && item.status == 5"
                                        @click="this.$router.push({path:'/admin/document/show', query:{id: item.id}})"
                                        Icon="bx bx-show"/>
                        <PrimaryIconBtn
                            v-if="counterStore.hasRole('Documents-update') && item.loan_amount > 0"
                            Modal="documentToPayModal"
                            @click="this.item = item"
                            class="bg-info border-info"
                            Icon="bx bx-money"
                        />
                        <PrimaryIconBtn v-if="counterStore.hasRole('Documents-delete')" @click="this.delete(item.id)" class="bg-danger border-danger" Icon="bx bx-trash-alt"/>

                    </td>

                </tr>
                <Paginate
                    Cols="9"
                    v-if="last_page != 1"
                    :currentPage="this.current_page"
                    :totalPages="this.last_page"
                    @changePage="indexPaginates($event)"
                />

                <GrowingLoader v-if="loader" Cols="9"/>

            </BasicTable>
        </div>

        <Update
            :mloader="boxLoader"
            :warehouses="warehouses"
            :suppliers="suppliers"
            :Item="item" @onUpdate="indexPaginates(this.current_page, false)"
        />
        <Create
            :mloader="boxLoader"
            :warehouses="warehouses"
            :suppliers="suppliers"
            @onCreate="indexPaginates(this.current_page, false)"
        />
        <ToPay :Item="item" @onPayment="indexPaginates(current_page, false)" :paymentTypes="paymentTypes"></ToPay>

    </Page>
</template>
<script>
    import Page from "@/components/layout/Page.vue";
    import {ApiError} from "@/helpers/Config.js";
    import {Alert} from "@/helpers/Config.js";
    import {useConterStore} from "@/store/counter.js";
    import BasicTable from "@/components/all/BasicTable.vue";
    import {
        documents,
        documentCreate,
        documentSearch,
        documentUpdate,
        documentShow,
        documentDelete,
        documentPaginates,
        documentActives,
        documentOrderBys,
        suppliers, warehouses, payment_types
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
    import ToPay from "@/pages/Documents/toPay.vue";
    export default {
        components: {
            ToPay,
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
            boxItem: [],
            paginateCount: 10,
            last_page: 1,
            current_page: 1,
            boxLast_page: 1,
            boxCurrent_page: 1,
            column: 'id',
            type: 'desc',
            errors: [],
            loader: false,
            boxLoader: false,
            boxItems: [],
            warehouses: Object,
            suppliers: Object,
            paymentTypes: Object,
        }},
        methods:{
            async indexPaymentTypes(){
                try {
                    this.loader = true;
                    const response = await payment_types();
                    if (response.status){
                        this.paymentTypes = response.data;
                    }
                    this.loader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async indexPaginates(page=1, islaoder = true){
                try {
                    this.loader = islaoder;
                    const response = await documentPaginates(this.paginateCount, page);
                    if (response.status){
                        this.current_page = response.data.pagination.current_page;
                        this.last_page = response.data.pagination.last_page;
                        this.items = response.data.items;
                    }
                    this.loader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async search(text = ''){
                try {
                    this.loader = true;
                    if (text == ''){
                        this.indexPaginates();
                        return true;
                    }
                    const response = await documentSearch(text);
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
                    const response = await documentDelete(id);
                    if (response.status){
                        this.indexPaginates(this.current_page)
                        Alert('success', this.$t('delete'));
                        return;
                    }
                    Alert('error', this.$t('formError'));
                    return false;
                }catch(error){
                    ApiError(this, error);
                    return false;
                }
            },
            async indexSuppliers(){
                try {
                    this.boxLoader = true;
                    const response = await suppliers();
                    this.suppliers = response.data;
                    this.boxLoader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async indexWarehouses(){
                try {
                    this.boxLoader = true;
                    const response = await warehouses();
                    this.warehouses = response.data;
                    this.boxLoader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
        },
        mounted() {
            this.indexPaginates()
            this.indexWarehouses()
            this.indexSuppliers()
            this.indexPaymentTypes()
        }
    }
</script>
<style></style>
