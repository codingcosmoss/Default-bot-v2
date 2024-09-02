<template>
    <Page Title="">
        <div id="sellingPurchase">
        </div>
        <div class="row">
            <BasicTable
                :Th="[ $t('No'),$t('Date'),$t('Amount'),$t('Subtotal'),$t('Indebtedness')]"
                :Title="$t('ReportSaleMedicines')"
                Col="col-lg-6"
            >
                <template v-slot:inputs>
                    <DefaultSelect
                        Label=""
                        Class="col-lg-4 col-sm-4"
                        @onInput="this.paginateCount = $event, this.indexPaginates()"
                    >
                        <option value="10" selected >{{$t('NumberDownloads')}}</option>
                        <option value="10" >10</option>
                        <option value="20" >20</option>
                        <option value="50" >50</option>
                        <option value="100" >100</option>
                    </DefaultSelect>&nbsp;&nbsp;
                </template>


                <tr v-for="(item,i) in sellingItems" >
                    <td>{{ ((selling_current_page - 1) * paginateCount) +  i + 1 }}</td>
                    <td>{{ item.date }}</td>
                    <td>{{ counterStore.formatNumber(item.total_amount) }}</td>
                    <td>{{ counterStore.formatNumber(item.total_subtotal.toFixed(2)) }} {{item.currency.sign}}</td>
                    <td>{{ counterStore.formatNumber(item.must_paid.toFixed(2)) }} {{item.currency.sign}}</td>
                </tr>
                <Paginate
                    Cols="7"
                    v-if="selling_last_page != 1"
                    :currentPage="this.selling_current_page"
                    :totalPages="this.selling_last_page"
                    @changePage="getSellings($event, false)"
                />

                <GrowingLoader v-if="loader" Cols="7"/>

            </BasicTable>
            <BasicTable
                :Th="[ $t('No'),$t('Date'),$t('Subtotal'),$t('Indebtedness')]"
                :Title="$t('ReportPurchasesMedicines')"
                Col="col-lg-6"
            >
                <template v-slot:inputs>

                    <DefaultSelect
                        Label=""
                        Class="col-lg-4 col-sm-4"
                        @onInput="this.paginateCount = $event, this.getPurchases()"
                    >
                        <option value="10" selected >{{$t('NumberDownloads')}}</option>
                        <option value="10" >10</option>
                        <option value="20" >20</option>
                        <option value="50" >50</option>
                        <option value="100" >100</option>
                    </DefaultSelect>&nbsp;&nbsp;
                </template>


                <tr v-for="(item,i) in purchasesItems" >
                    <td>{{ ((current_page - 1) * paginateCount) +  i + 1 }}</td>
                    <td>{{ item.date }}</td>
                    <td>{{ counterStore.formatNumber(item.total_subtotal.toFixed(2)) }} {{item.currency.sign}}</td>
                    <td>{{ counterStore.formatNumber(item.must_paid.toFixed(2)) }} {{item.currency.sign}}</td>
                </tr>
                <Paginate
                    Cols="7"
                    v-if="last_page != 1"
                    :currentPage="this.current_page"
                    :totalPages="this.last_page"
                    @changePage="getPurchases($event)"
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
    import {payment_typeSearchCustomers, reportPurchases, reportSellings} from "@/helpers/api.js";
    import GrowingLoader from "@/components/all/GrowingLoader.vue";
    import PrimaryButton from "@/components/all/PrimaryButton.vue";
    import PrimaryIconBtn from "@/components/all/PrimaryIconBtn.vue";
    import ModalCentered from "@/components/all/ModalCentered.vue";
    import PrimaryBtn from "@/components/all/PrimaryBtn.vue";
    import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
    import Paginate from "@/components/all/Paginate.vue";
    import DefaultSelect from "@/ui-components/Forms/DefaultSelect.vue";
    import ApexCharts from 'apexcharts'
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
            selling_current_page: 1,
            selling_last_page: 1,
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
            sellingItems:[],
            purchasesItems:[],
            sellings: [],
            purchases: [],

        }},
        methods:{
            renderChart(){
                var options = {
                    chart: {
                        height: 380,
                        width: "100%",
                        type: "area",
                        animations: {
                            initialAnimation: {
                                enabled: false
                            }
                        }
                    },
                    series: [
                        {
                            name: this.$t('Selling'),
                            data: this.sellings
                        },
                        {
                            name: this.$t('Purchase'),
                            data: this.purchases
                        }
                    ],
                    xaxis: {
                        type: "datetime"
                    }
                };
                var chart = new ApexCharts(document.querySelector("#sellingPurchase"), options);
                chart.render();

            },
            async getSellings(page=1, islaoder = true){
                try {
                    this.loader = islaoder;
                    const response = await reportSellings(this.paginateCount, page);
                    if (response.status){
                        this.selling_current_page = response.data.pagination.current_page;
                        this.selling_last_page = response.data.pagination.last_page;
                        this.sellingItems = response.data.items.data;
                        this.sellingItems.forEach(e=>{
                            this.sellings.push({
                                x: e.date.split('-')[1] +'-'+e.date.split('-')[2]+'-'+e.date.split('-')[0] + " GMT",
                                y: e.total_subtotal.toFixed(2)
                            });
                        })
                        if (islaoder){
                            this.getPurchases()
                        }
                    }
                    this.loader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async getPurchases(page=1, islaoder = true){
                try {
                    this.loader = islaoder;
                    const response = await reportPurchases(this.paginateCount, page);
                    if (response.status){
                        this.current_page = response.data.pagination.current_page;
                        this.last_page = response.data.pagination.last_page;
                        this.purchasesItems = response.data.items.data;
                        this.purchasesItems.forEach(e=>{
                            this.purchases.push({
                                x: e.date.split('-')[1] +'-'+e.date.split('-')[2]+'-'+e.date.split('-')[0] + " GMT",
                                y: e.total_subtotal.toFixed(2)
                            });
                        })
                        if (islaoder){
                            this.renderChart()
                        }
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
                    const response = await payment_typeSearchCustomers(text);
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
            }
        },
        mounted() {
            this.getSellings()
        }
    }
</script>
<style></style>
