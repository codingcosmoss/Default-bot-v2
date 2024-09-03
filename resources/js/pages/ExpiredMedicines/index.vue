<template>
    <Page Title="">
        <div class="row">
        <BasicTable
                :Th="[ $t('No'),$t('Photo'),$t('MedicineName'),$t('Collection'),$t('Amount'),$t('ExpirationDate'),$t('Settings')]"
                Col="col-lg-12"
                :Title="$t('MostSolds')"
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


                <tr v-for="(item,i) in items" >
                    <td>{{ ((current_page - 1) * paginateCount) +  i + 1 }}</td>
                    <td>
                        <div class="table_image"  :style="'background-image: url('+ item.medicine.image[0].url +')'"></div>
                    </td>
                    <td>
                        <p class="m-0">{{ item.medicine.name }}</p>
                        <p class="m-0 font-size-12">{{ item.medicine.generic_name }}</p>
                    </td>
                    <td>{{ item.name }} </td>
                    <td>{{ counterStore.formatNumber(item.amount) }} </td>
                    <td>{{ item.expiry_date_finished }} </td>
                    <td>
                        <PrimaryIconBtn v-if="counterStore.hasRole('ExpiredMedicines-delete')" @click="this.delete(item.id)" class="bg-danger border-danger" Icon="bx bx-trash-alt"/>
                    </td>
                </tr>
                <Paginate
                    Cols="7"
                    v-if="last_page != 1"
                    :currentPage="this.current_page"
                    :totalPages="this.last_page"
                    @changePage="indexPaginates($event)"
                />

                <GrowingLoader v-if="loader" Cols="7"/>

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
        expiredDelete,expiredPaginates
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
                    const response = await expiredPaginates(this.paginateCount, page);
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
            async delete(id){
                try {
                    if (!confirm(this.$t('DeleteAlert'))){
                        return false;
                    }
                    const response = await expiredDelete(id);
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
