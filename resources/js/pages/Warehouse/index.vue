<template>
    <Page Title="">
        <div class="row"  >
            <BasicTable
                :Th="[ $t('No'),$t('ModalName'),$t('Status'),$t('Settings')]"
                :Title="$t('Warehouses')"
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
                    <PrimaryBtn v-if="counterStore.hasRole('MedicineCategories-create')" role="button" data-bs-toggle="modal" data-bs-target="#warehouseCreate" >{{$t('Create')}}</PrimaryBtn>
                </template>

                <tr v-for="(item, i) in items" >
                    <td>{{ ((current_page - 1) * paginateCount) +  i + 1 }}</td>
                    <td>
                        {{ item.name }}
                    </td>
                    <td>
                        <span :class="item.status == 1 ? 'badge-soft-success' : 'badge-soft-danger' "
                              class="badge badge-pill badge-soft-success font-size-11">{{ item.status  == 1 ? $t('Active') : $t('InActive') }}</span>

                    </td>
                    <td>
                        <PrimaryIconBtn v-if="counterStore.hasRole('MedicineCategories-update')" @click="this.item = item" Icon="bx bx-edit-alt" Modal="warehouseUpdate"/>
                        <!--                        <PrimaryIconBtn  @click="this.$router.push({path:'/admin/size-types/show', query:{id: item.id}})" Icon="bx bx-show"/>&nbsp;-->
                        <PrimaryIconBtn v-if="counterStore.hasRole('MedicineCategories-delete')" @click="this.delete(item.id)" class="bg-danger border-danger" Icon="bx bx-trash-alt"/>
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
        </div>
        <Update :Item="item" @onUpdate="indexPaginates(this.current_page, false)" />
        <Create  @onCreate="indexPaginates(this.current_page, false)" />

    </Page>
</template>
<script>
    import Page from "@/components/layout/Page.vue";
    import {ApiError} from "@/helpers/Config.js";
    import {Alert} from "@/helpers/Config.js";
    import {useConterStore} from "@/store/counter.js";
    import BasicTable from "@/components/all/BasicTable.vue";
    import {warehouses, warehouseCreate, warehouseSearch, warehouseUpdate, warehouseShow, warehouseDelete, warehousePaginates, warehouseActives, warehouseOrderBys} from "@/helpers/api.js";
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
                    const response = await warehousePaginates(this.paginateCount, page);
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
                    const response = await warehouseSearch(text);
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
                    const response = await warehouseDelete(id);
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
