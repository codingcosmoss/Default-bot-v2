<template>
    <Page Title="">
        <div class="row">
            <BasicTable
                :Th="[ $t('No'),$t('MedicineName'),
                $t('Supplier'),
                $t('ImportedMedicinesDate'),
                $t('ReturnedDate'),
                $t('BoxSize'),
                $t('Amount'),
                $t('BuyPrice'),
                $t('Subtotal'),
                $t('Settings')]"
                :Title="$t('ReturnedMedicines')"
                Col="col-lg-12"
            >
                <template v-slot:inputs>
<!--                    <DefaultInput-->
<!--                        Class="col-lg-3 col-sm-2 search_input"-->
<!--                        Label=""-->
<!--                        Name="name"-->
<!--                        Type="text"-->
<!--                        Pholder="Search..."-->
<!--                        @onInput="search($event)"-->
<!--                    />-->

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
                    <PrimaryBtn v-if="counterStore.hasRole('MedicineCategories-create')" role="button" data-bs-toggle="modal" data-bs-target="#warehouseCreate" >{{$t('Create')}}</PrimaryBtn>
                </template>

                <tr v-for="(item, i) in items" >
                    <td>{{ ((current_page - 1) * paginateCount) +  i + 1 }}</td>
                    <td>
                        <p class="m-0">{{ item.medicine.name }}</p>
                        <p class="font-size-10 m-0" >{{ item.medicine.generic_name }}</p>
                    </td>
                    <td>{{ item.supplier.name }}</td>
                    <td>{{ item.document.date}}</td>
                    <td>{{ counterStore.formatDate(item.document.updated_at)}}</td>
                    <td>{{ item.box_size.name}}</td>
                    <td>{{ counterStore.formatNumber(item.amount) }} </td>
                    <td>{{ counterStore.formatNumber(item.buy_price) }} {{item.currency.sign}}</td>
                    <td>{{ counterStore.formatNumber(item.total_cost) }} {{item.currency.sign}}</td>
                    <td>
                        <PrimaryIconBtn  @click="this.$router.push({path:'/admin/document/show', query:{id: item.document_id}})" Icon="bx bx-show"/>
                        <PrimaryIconBtn v-if="counterStore.hasRole('MedicineCategories-delete')" @click="this.delete(item.id)" class="bg-danger border-danger" Icon="bx bx-trash-alt"/>
                    </td>

                </tr>
                <Paginate
                    Cols="10"
                    v-if="last_page != 1"
                    :currentPage="this.current_page"
                    :totalPages="this.last_page"
                    @changePage="indexPaginates($event)"
                />

                <GrowingLoader v-if="loader" Cols="10"/>

            </BasicTable>
        </div>

    </Page>
</template>
<script>
    import Page from "@/components/layout/Page.vue";
    import {ApiError} from "@/helpers/Config.js";
    import {Alert} from "@/helpers/Config.js";
    import {useConterStore} from "@/store/counter.js";
    import BasicTable from "@/components/all/BasicTable.vue";
    import {
        imported_medicineDelete,
        imported_medicines,
        imported_medicinePaginates,
        imported_medicineSearch,
        returned_medicineSearch,
        returned_medicinePaginates
    } from "@/helpers/api.js";
    import GrowingLoader from "@/components/all/GrowingLoader.vue";
    import PrimaryButton from "@/components/all/PrimaryButton.vue";
    import PrimaryIconBtn from "@/components/all/PrimaryIconBtn.vue";
    import ModalCentered from "@/components/all/ModalCentered.vue";
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
            ModalCentered, PrimaryIconBtn, PrimaryButton, GrowingLoader, BasicTable, Page},
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
            boxItems: []
        }},
        methods:{
            async indexPaginates(page=1, islaoder = true){
                try {
                    this.loader = islaoder;
                    const response = await returned_medicinePaginates(this.paginateCount, page);
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
                    const response = await returned_medicineSearch(text);
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
                    const response = await imported_medicineDelete(id);
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
        },
        mounted() {
            this.indexPaginates()
        }
    }
</script>
<style></style>
