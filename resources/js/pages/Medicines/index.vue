<template>
    <Page Title="">
        <div class="row"  >
            <BasicTable
                :Th=" [
                    $t('Id'),
                    $t('Picture'),
                    $t('ModalName'),
                    $t('GenericName'),
                    $t('Amount'),
                    $t('SellingPrice'),
                    $t('BuyPrice'),
                    $t('Category'),
                    $t('Status'),
                    $t('Settings'),
                ]"
                :Title="$t('Medicines')"
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
                    <PrimaryBtn v-if="counterStore.hasRole('Medicines-create')" @click="crud= 'create' " role="button" data-bs-toggle="modal" data-bs-target="#medicineCreate" >{{$t('Create')}}</PrimaryBtn>
                </template>

                <tr v-for="(item,i) in items" >
                    <td>{{ ((current_page - 1) * paginateCount) +  i + 1 }}</td>
                    <td>
                        <div class="table_image"  :style="'background-image: url('+ item.image[0].url +')'"></div>
                    </td>
                    <td style=" text-wrap: wrap" >
                        {{ item.name }}
                    </td>
                    <td style=" text-wrap: wrap" >{{ item.generic_name }}</td>
                    <td>{{ item.amount }}</td>
                    <td>{{ counterStore.formatNumber(item.price)}} {{item.currency.sign}}</td>
                    <td>{{ counterStore.formatNumber(item.buy_price)}} {{item.currency.sign}}</td>
                    <td>{{ item.medicine_category_name }}</td>
                    <td>
                        <span :class="item.status == 1 ? 'badge-soft-success' : 'badge-soft-danger' "
                              class="badge badge-pill badge-soft-success font-size-11">{{ item.status  == 1 ? $t('Active') : $t('InActive') }}</span>

                    </td>
                    <td>
                        <PrimaryIconBtn v-if="counterStore.hasRole('Medicines-update')" @click="this.item = item, crud='update'" Icon="bx bx-edit-alt" Modal="medicineUpdate"/>
                        <PrimaryIconBtn  @click="this.$router.push({path:'/admin/medicines/show', query:{id: item.id}})" Icon="bx bx-show"/>
                        <PrimaryIconBtn v-if="counterStore.hasRole('Medicines-delete')" @click="this.delete(item.id)" class="bg-danger border-danger" Icon="bx bx-trash-alt"/>
                    </td>

                </tr>
                <Paginate
                    v-if="last_page != 1"
                    :currentPage="this.current_page"
                    :totalPages="this.last_page"
                    @changePage="indexPaginates($event)"
                    :Cols="headers.length"
                />

                <GrowingLoader v-if="loader" :Cols="headers.length"/>

            </BasicTable>

        </div>

        <Update
            :crud="crud"
            :Item="item"
            :medicineCategories="medicineCategories"
            :boxSizes="boxSizes"
            :drugCompanies="drugCompanies"
            :sizeTypes="sizeTypes"
            @indexCategoryActives="indexCategoryActives()"
            @indexCompaniesActives="indexCompaniesActives()"
            @indexBoxSizesActives="indexBoxSizesActives()"
            @indexTypesActives="indexTypesActives()"
            @onUpdate="indexPaginates(this.current_page)"
            :mloader="mloader"
        />
        <Create
            :medicineCategories="medicineCategories"
            :boxSizes="boxSizes"
            :drugCompanies="drugCompanies"
            :sizeTypes="sizeTypes"
            @indexCategoryActives="indexCategoryActives()"
            @indexCompaniesActives="indexCompaniesActives()"
            @indexBoxSizesActives="indexBoxSizesActives()"
            @indexTypesActives="indexTypesActives()"
            @onCreate="indexPaginates(this.current_page)"
            :mloader="mloader"
        />
    </Page>
</template>
<script>
    import Page from "@/components/layout/Page.vue";
    import {ApiError} from "@/helpers/Config.js";
    import {Alert} from "@/helpers/Config.js";
    import {useConterStore} from "@/store/counter.js";
    import BasicTable from "@/components/all/BasicTable.vue";
    import {
        medicines,
        medicineCreate,
        medicineSearch,
        medicineUpdate,
        medicineShow,
        medicineDelete,
        medicinePaginates,
        medicineActives,
        medicineOrderBys,
        medicine_categoryActives, box_sizeActives, drug_companyActives, size_typeActives
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
            headers: [1,2,3,4,5,6,7,8,9,10],
            last_page: 1,
            current_page: 1,
            column: 'id',
            type: 'desc',
            errors: [],
            loader: false,
            medicineCategories: [],
            boxSizes: [],
            drugCompanies: [],
            sizeTypes: [],
            mloader: false,
            crud: 'create'
        }},
        methods:{
            async index(){
                try {
                    const response = await medicines();
                    this.items = response.data;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async indexActives(){
                try {
                    const response = await medicineActives(this.paginateCount);
                    this.items = response.data;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async indexPaginates(page=1){
                try {
                    this.loader = true;
                    const response = await medicinePaginates(this.paginateCount, page);
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
                    const response = await medicineOrderBys(this.column, this.type);
                    this.items = response.data;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async show(id){
                try {
                    const response = await medicineShow(id);
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
                    const response = await medicineCreate(data);
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
                    const response = await medicineUpdate(data);
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
                    const response = await medicineSearch(text);
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
                    const response = await medicineDelete(id);
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
            async indexCategoryActives() {
                try {
                    this.mloader = true;
                    const response = await medicine_categoryActives();
                    this.medicineCategories = response.data;
                    this.mloader = false;
                } catch (error) {
                    ApiError(this, error);
                }
            },
            async indexBoxSizesActives() {
                try {
                    this.mloader = true;
                    const response = await box_sizeActives();
                    this.boxSizes = response.data;
                    this.mloader = false;
                } catch (error) {
                    ApiError(this, error);
                }
            },
            async indexCompaniesActives() {
                try {
                    this.mloader = true;
                    const response = await drug_companyActives();
                    this.drugCompanies = response.data;
                    this.mloader = false;
                } catch (error) {
                    ApiError(this, error);
                }
            },
            async indexTypesActives() {
                try {
                    this.mloader = true;
                    const response = await size_typeActives();
                    this.sizeTypes = response.data;
                    this.mloader = false;
                } catch (error) {
                    ApiError(this, error);
                }
            },
        },
        mounted() {
            this.indexPaginates()
            this.indexCategoryActives()
            this.indexBoxSizesActives()
            this.indexCompaniesActives()
            this.indexTypesActives()
        }
    }
</script>
<style></style>
