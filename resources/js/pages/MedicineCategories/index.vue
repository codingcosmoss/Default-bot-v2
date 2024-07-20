<template>
    <Page Title="">
        <div class="row"  >
            <BasicTable
                :Th="[ $t('Id'),$t('ModalName'),$t('Status'),$t('Settings')]"
                :Title="$t('Categories')"
                Col="col-lg-6"
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
                    <PrimaryBtn v-if="counterStore.hasRole('Medicines-index')" role="button" data-bs-toggle="modal" data-bs-target="#medicine_categoryCreate" >{{$t('Create')}}</PrimaryBtn>
                </template>

                <tr v-for="item in items" >
                    <td>
                        #{{ item.id }}
                    </td>
                    <td>
                        {{ item.name }}
                    </td>
                    <td>
                        <span :class="item.status == 1 ? 'badge-soft-success' : 'badge-soft-danger' "
                              class="badge badge-pill badge-soft-success font-size-11">{{ item.status  == 1 ? $t('Active') : $t('InActive') }}</span>

                    </td>
                    <td>
                        <PrimaryIconBtn v-if="counterStore.hasRole('Medicines-index')" @click="this.item = item" Icon="bx bx-edit-alt" Modal="medicine_categoryUpdate"/>&nbsp;
<!--                        <PrimaryIconBtn  @click="this.$router.push({path:'/admin/size-types/show', query:{id: item.id}})" Icon="bx bx-show"/>&nbsp;-->
                        <PrimaryIconBtn v-if="counterStore.hasRole('Medicines-index')" @click="this.delete(item.id)" class="bg-danger border-danger" Icon="bx bx-trash-alt"/>
                    </td>

                </tr>
                <Paginate
                    v-if="last_page != 1"
                    :currentPage="this.current_page"
                    :totalPages="this.last_page"
                    @changePage="indexPaginates($event)"
                />

                <GrowingLoader v-if="loader" Cols="4"/>

            </BasicTable>
            <BasicTable
                :Th="[ $t('Id'),$t('Size'),$t('Status'),$t('Settings')]"
                :Title="$t('DrugCompanies')"
                Col="col-lg-6"
            >
                <template v-slot:inputs>
                    <DefaultInput
                        Class="col-lg-3 col-sm-2 search_input"
                        Label=""
                        Name="name"
                        Type="text"
                        Pholder="Search..."
                        @onInput="boxSearch($event)"
                    />

                    <DefaultSelect
                        Label=""
                        Class="col-lg-2 col-sm-2"
                        @onInput="this.paginateCount = $event, this.indexBoxPaginates()"
                    >
                        <option value="10" selected >{{$t('NumberDownloads')}}</option>
                        <option value="10" >10</option>
                        <option value="20" >20</option>
                        <option value="50" >50</option>
                        <option value="100" >100</option>
                    </DefaultSelect>&nbsp;&nbsp;
                </template>

                <template v-slot:buttons>
                    <PrimaryBtn v-if="counterStore.hasRole('Medicines-index')" role="button" data-bs-toggle="modal" data-bs-target="#drug_companyCreate" >{{$t('Create')}}</PrimaryBtn>
                </template>

                <tr v-for="item in boxItems" >
                    <td>
                        #{{ item.id }}
                    </td>
                    <td>
                        {{ item.name }}
                    </td>
                    <td>
                        <span :class="item.status == 1 ? 'badge-soft-success' : 'badge-soft-danger' "
                              class="badge badge-pill badge-soft-success font-size-11">{{ item.status  == 1 ? $t('Active') : $t('InActive') }}</span>

                    </td>

                    <td>
                        <PrimaryIconBtn v-if="counterStore.hasRole('Medicines-index')" @click="boxItem = item" Icon="bx bx-edit-alt" Modal="drug_companyUpdate"/>&nbsp;
<!--                        <PrimaryIconBtn  @click="this.$router.push({path:'/admin/size-types/show', query:{id: item.id}})" Icon="bx bx-show"/>&nbsp;-->
                        <PrimaryIconBtn v-if="counterStore.hasRole('Medicines-index')" @click="this.boxDelete(item.id)" class="bg-danger border-danger" Icon="bx bx-trash-alt"/>
                    </td>

                </tr>
                <Paginate
                    v-if="boxLast_page != 1"
                    :currentPage="this.boxCurrent_page"
                    :totalPages="this.boxLast_page"
                    @changePage="indexBoxPaginates($event)"
                />

                <GrowingLoader v-if="boxLoader" Cols="4"/>

            </BasicTable>
        </div>
        <Update :Item="item" @onUpdate="indexPaginates(this.current_page, false)" />
        <Create  @onCreate="indexPaginates(this.current_page, false)" />
        <boxUpdate :Item="boxItem" @onUpdate="indexBoxPaginates(this.boxCurrent_page, false)" />
        <boxCreate  @onCreate="indexBoxPaginates(this.boxCurrent_page, false)" />
    </Page>
</template>
<script>
    import Page from "@/components/layout/Page.vue";
    import {ApiError} from "@/helpers/Config.js";
    import {Alert} from "@/helpers/Config.js";
    import {useConterStore} from "@/store/counter.js";
    import BasicTable from "@/components/all/BasicTable.vue";
    import {drug_companys, drug_companyCreate, drug_companySearch, drug_companyUpdate, drug_companyShow, drug_companyDelete, drug_companyPaginates, drug_companyActives, drug_companyOrderBys} from "@/helpers/api.js";
    import {medicine_categorys, medicine_categoryCreate, medicine_categorySearch, medicine_categoryUpdate, medicine_categoryShow, medicine_categoryDelete, medicine_categoryPaginates, medicine_categoryActives, medicine_categoryOrderBys} from "@/helpers/api.js";
    import GrowingLoader from "@/components/all/GrowingLoader.vue";
    import PrimaryButton from "@/components/all/PrimaryButton.vue";
    import PrimaryIconBtn from "@/components/all/PrimaryIconBtn.vue";
    import ModalCentered from "@/components/all/ModalCentered.vue";
    import Update from "./update.vue";
    import Create from "./create.vue";
    import boxUpdate from "./boxUpdate.vue";
    import boxCreate from "./boxCreate.vue";
    import PrimaryBtn from "@/components/all/PrimaryBtn.vue";
    import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
    import Paginate from "@/components/all/Paginate.vue";
    import DefaultSelect from "@/ui-components/Forms/DefaultSelect.vue";
    export default {
        components: {
            DefaultSelect,
            Paginate,
            boxUpdate,
            boxCreate,
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
            boxItems: []
        }},
        methods:{
            async indexPaginates(page=1, islaoder = true){
                try {
                    this.loader = islaoder;
                    const response = await medicine_categoryPaginates(50, page);
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
            async indexBoxPaginates(page=1, isLoader = true){
                try {
                    this.boxLoader = isLoader;
                    const response = await drug_companyPaginates(50, page);
                    if (response.status){
                        this.boxCurrent_page = response.data.pagination.current_page;
                        this.boxLast_page = response.data.pagination.last_page;
                        this.boxItems = response.data.items;
                    }
                    this.boxLoader = false;
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
                    const response = await medicine_categorySearch(text);
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
            async boxSearch(text = ''){
                try {
                    this.boxLoader = true;
                    if (text == ''){
                        this.indexBoxPaginates();
                        return true;
                    }
                    const response = await drug_companySearch(text);
                    this.boxItems = response.data;
                    this.boxLoader = false;
                    if (!response.status){
                        Alert('error', this.$t('formError'));
                        this.boxLoader = false;
                        return false;
                    }
                    this.boxLoader = false;
                    return true;
                }catch(error){
                    ApiError(this, error);
                    this.boxLoader = false;
                    return false;
                }
            },
            async delete(id){
                try {
                    if (!confirm(this.$t('DeleteAlert'))){
                        return false;
                    }
                    const response = await medicine_categoryDelete(id);
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
            async boxDelete(id){
                try {
                    if (!confirm(this.$t('DeleteAlert'))){
                        return false;
                    }
                    const response = await drug_companyDelete(id);
                    if (response.status){
                        this.indexBoxPaginates(this.current_page)
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
            this.indexBoxPaginates()
        }
    }
</script>
<style></style>
