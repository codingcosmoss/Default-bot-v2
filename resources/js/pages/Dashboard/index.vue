<template>
    <Page Title="">
        <div class="row">
            <div v-for="i in 4" v-if="cardLoader"  class="col-lg-3 cursor-pointer">
                <div class="card mini-stats-wid">
                    <div  class="card-body">
                        <div  class="d-flex flex-wrap">
                            <div class="me-3">
                                <p class=" mb-2 placeholder">Uzbekistani Uzbekistani</p><br>
                                <h5 class="mb-0 placeholder ">201 000 сўм</h5>
                            </div>
                            <div class="avatar-sm ms-auto">
                                <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                    <i class="bx bx-money placeholder"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row " v-if="!cardLoader">
            <div class="col-md-3 cursor-pointer" @click="this.$router.push('/admin/medicines')">
                <CardBlock
                    :Title="$t('RegisteredMedicines')"
                    :Number="counterStore.formatNumber(registeredMedicines)"
                    Icon="bx bx-copy-alt font-size-24"
                />
            </div>
            <div class="col-md-3 cursor-pointer" @click="this.$router.push('/admin/expired-medicines')">
                <CardBlock
                    :Title="$t('ExpiredMedicines')"
                    :Number="counterStore.formatNumber(expiredMedicinesCount)"
                    Icon="bx bx-time font-size-24"
                />
            </div>
            <div class="col-md-3 cursor-pointer" @click="this.$router.push('/admin/import/medicines')">
                <CardBlock
                    :Title="$t('ImportedDrugs')"
                    :Number="counterStore.formatNumber(importedMedicines)"
                    Icon="bx bx-import font-size-24"
                />
            </div>
            <div class="col-md-3 cursor-pointer" @click="this.$router.push('/admin/medicines')">
                <CardBlock
                    :Title="$t('WarehouseAvailableMedicines')"
                    :Number="counterStore.formatNumber(realMedicines)"
                    Icon="bx bx-pie-chart-alt-2 font-size-24"
                />
            </div>
        </div>

        <div class="row" v-if="cardClassicLoader">
            <CardClassicBlockLoader v-for="i in 4" />
        </div>
        <div class="row" v-if="!cardClassicLoader">
            <CardClassicBlock
                Icon="bx bx-export"
                :Title="$t('TotalPaid')"
                :Currencies="medicinesSoldCustomers"
                :Share="medicinesSoldCustomersAmount"
                :Text="$t('SubtotalAmount') + ':'"
            />
            <CardClassicBlock
                Icon="bx bx-import"
                :Title="$t('ImportPaid')"
                :Currencies="importedSubtotalMedicines"
                :Share="importedSubtotalMedicinesAmount"
                :Text="$t('SubtotalAmount') + ':'"
            />
            <CardClassicBlock
                Icon="bx bx-collection"
                :Title="$t('TotalCosts')"
                :Currencies="expenses"
                Share=""
                Text=""
            />
            <CardClassicBlock
                Icon="bx bx-collection"
                :Title="$t('TotalNetProfit')"
                :Currencies="totalNetProfit"
                Share=""
                Text=""
            />
        </div>

        <div class="row">

            <BaseBox Col="col-xl-12" :Title="$t('SalesandPurchasestatistics')">
                <div id="dashboardChart1">
                </div>
            </BaseBox>
            <BaseBox :Title="$t('MostSoldMedicines')">
                <div id="dashboardChart2" v-if="isChart2">
                    <apexchart
                        type="bar"
                        height="345"
                        :options="chart2Data.chartOptions"
                        :series="chart2Data.series"
                    ></apexchart>
                </div>
            </BaseBox>
            <BaseBox :Title="$t('CurrentMedicinesAmount')">
                <div id="dashboardChart3">
                </div>
            </BaseBox>
<!--            <BaseBox :Title="$t('Expenses')">-->
<!--                <div id="dashboardChart4">-->
<!--                </div>-->
<!--            </BaseBox>-->


        </div>

        <ModalCentered
            :isSubmit="false"
            ModalName="dashboardAlert"
            :Title="$t('Info')"
        >
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-0 ">
                        <h4 class="card-title text-center">{{$t('ExpiredMedicines')}}</h4>
                        <div class="table-responsive">
                            <table class="table mb-0">

                                <thead class="table-light">
                                <tr>
                                    <th>{{$t('MedicineName')}}</th>
                                    <th>{{$t('Collection')}}</th>
                                    <th>{{$t('Amount')}}</th>
                                    <th>{{$t('ExpirationDate')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="batch in expiredDrugs">
                                    <td>
                                        <p class="font-size-12 text-wrap" >{{batch.medicine.name}}</p>
                                    </td>
                                    <td>{{batch.name}}</td>
                                    <td>{{batch.amount}}</td>
                                    <td>{{batch.expiry_date_finished}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-0 text-center">
                        <h4 class="card-title">{{$t('WarehouseNotAmount')}}</h4>
                        <div class="table-responsive">
                            <table class="table mb-0">

                                <thead class="table-light">
                                <tr>
                                    <th>{{$t('MedicineName')}}</th>
                                    <th>{{$t('Amount')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="medicine in outdatedDrugs">
                                    <td>{{medicine.name}}</td>
                                    <td>{{medicine.amount}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </ModalCentered>

    </Page>
</template>
<script>
import Page from "@/components/layout/Page.vue";
import {ApiError} from "@/helpers/Config.js";
import {Alert} from "@/helpers/Config.js";
import {useConterStore} from "@/store/counter.js";
import page from "@/components/layout/Page.vue";
import ApexCharts from "apexcharts";
import VueApexCharts from "vue3-apexcharts";
import BaseBox from "@/components/global/BaseBox.vue";
import CardBlock from "@/components/all/CardBlock.vue";
import CardClassicBlock from "@/components/all/CardClassicBlock.vue";
import {dashboardCart1, dashboardCart2, quantityVerification} from "@/helpers/api.js";
import {registry} from "chart.js";
import CardClassicBlockLoader from "@/components/all/CardClassicBlockLoader.vue";
import ModalCentered from "@/components/all/ModalCentered.vue";
export default {
    components: {
        ModalCentered,
        CardClassicBlockLoader,  apexchart: VueApexCharts, CardClassicBlock, CardBlock, BaseBox, Page},
    setup() {
        const counterStore = useConterStore();
        return {counterStore}
    },
    data() {
        return {
            items: [],
            item: [],
            paginateCount: 10,
            cardClassicLoader: false,
            column: 'id',
            type: 'desc',
            errors: [],
            loader: false,
            cardLoader: false,
            // sharts
            sellings: [],
            purchases: [],

            // cart 1
            registeredMedicines: 0,
            expiredMedicines: [],
            importedMedicines: 0,
            realMedicines: 0,
            expiredMedicinesCount: 0,
            // cart 2
            medicinesSoldCustomers: [],
            medicinesSoldCustomersAmount: 0,
            importedSubtotalMedicines: [],
            importedSubtotalMedicinesAmount: 0,
            expenses: [],
            netProfit: [],
            totalNetProfit: [],
            isChart2: false,
            chart2Data: {
                series: [{
                    data: []
                }],
                chartOptions: {
                    chart: {
                        type: 'bar',
                        height: 380,
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 4,
                            borderRadiusApplication: 'end',
                            horizontal: true,
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    xaxis: {
                        categories: [],
                    }
                },


            },
            realMedicineNumbers: [],
            realMedicineArr: [],
            outdatedDrugs: [], // eskirgan dorilar
            expiredDrugs: [] // miqdori qolmagan dorilar

        }
    },
    methods: {
        chart1(){
            var options = {
                chart: {
                    height: 380,
                    width: "100%",
                    type: "area",
                    animations: {
                        zoom: false,
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
            var chart = new ApexCharts(document.querySelector("#dashboardChart1"), options);
            chart.render();

        },
        chart3(){
            var options = {
                chart: {
                    height: 380,
                    width: "100%",
                    type: "pie",
                    animations: {
                        initialAnimation: {
                            enabled: false
                        }
                    }
                },
                series: this.realMedicineNumbers,
                labels: this.realMedicineArr,

            };
            var chart = new ApexCharts(document.querySelector("#dashboardChart3"), options);
            chart.render();

        },
        chart4(){
            var options = {
                    chart: {
                        height: 350,
                        type: 'line',
                        zoom: {
                            enabled: false
                        }
                    },
                series: [{
                    name: this.$t('Amount'),
                    data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
                }],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight'
                },

                grid: {
                    row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0
                    },
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                }

            };
            var chart = new ApexCharts(document.querySelector("#dashboardChart4"), options);
            chart.render();

        },
        async quantityVerification(){
            try {
                this.loader = true;
                const response = await quantityVerification();
                this.loader = false;
            }catch(error){
                ApiError(this, error);
            }
        },
        async dashboardCart1(){
            try {
                this.cardLoader = true;
                const response = await dashboardCart1();
                let data = response.data;
                if (response.status){


                    this.registeredMedicines = data.medicines_count;
                    this.realMedicinesArr = data.realMedicinesCount;
                    this.realMedicines = 0;
                    data.realMedicinesCount.forEach(e =>{
                        this.realMedicines += e.amount;
                        if (e.amount > 0){
                            this.realMedicineNumbers.push(e.amount);
                            this.realMedicineArr.push(e.name);
                        }else{
                            e.amount = 0;
                            this.outdatedDrugs.push(e);
                        }
                    })

                    this.expiredMedicinesCount = 0;
                    data.expiredMedicines.forEach(e=>{
                        this.expiredMedicinesCount += e.amount;
                        this.expiredDrugs.push(e);
                    })

                    if (this.outdatedDrugs.length > 0 || this.expiredDrugs.length){
                        // Alert info
                        const myModal = new bootstrap.Modal(document.getElementById('dashboardAlert'));
                        myModal.show();
                        // --------
                    }


                    this.chart3()

                    data.importedMedicines.forEach(e=>{
                        this.importedMedicines += e.amount;

                    })
                    let bestSellerArr = [];
                    let bestSellerNumbers = [];
                    data.bestSellers.forEach(e =>{
                        bestSellerArr.push(e.name);
                        bestSellerNumbers.push(e.total_amount)
                    })

                    this.chart2Data.chartOptions.xaxis.categories = bestSellerArr;
                    this.chart2Data.series[0].data = bestSellerNumbers;
                    this.isChart2 = true;
                    this.expiredMedicines = data.expiredMedicines;
                }
                this.cardLoader = false;
            }catch(error){
                ApiError(this, error);
            }
        },
        async dashboardCart2(){
            try {
                this.cardClassicLoader = true;
                const response = await dashboardCart2();
                let data = response.data;
                if (response.status){
                    this.medicinesSoldCustomers = data.medicinesSoldCustomers;
                    this.importedSubtotalMedicines = data.importedSubtotalMedicines;
                    this.expenses = data.expenses;
                    data.medicinesSoldCustomers.forEach(e => {
                        this.medicinesSoldCustomersAmount+= Number(e.total_amount);
                    });
                    data.importedSubtotalMedicines.forEach(e => {
                        this.importedSubtotalMedicinesAmount+=  Number(e.amount);
                    });
                    data.sellings.forEach(e => {
                        this.sellings.push({
                            x: e.date.split('-')[1] +'-'+e.date.split('-')[2]+'-'+e.date.split('-')[0] +' GMT',
                            y: e.subtotal.toFixed(2)
                        });
                    });
                    data.purchases.forEach(e => {
                        this.purchases.push({
                            x: e.date.split('-')[1] +'-'+e.date.split('-')[2]+'-'+e.date.split('-')[0] +' GMT',
                            y: e.subtotal.toFixed(2)
                        });
                    });
                    this.medicinesSoldCustomers.forEach((n, index)=>{
                        let sum = 0;
                        data.importedSubtotalMedicines.forEach(e => {
                            if (e.currency_id == n.currency_id){
                                sum+= Number(e.total_cost);
                            }
                        });
                        data.expenses.forEach(e => {
                            if (e.currency_id == n.currency_id){
                                sum+= Number(e.total_cost);
                            }
                        });

                        let total_cost = 0;
                        if (n.total_cost - sum > 0){
                            total_cost = n.total_cost - sum;
                        }
                        this.totalNetProfit.push({
                            total_cost: total_cost,
                            sign: n.sign
                        });


                    })
                    this.cardClassicLoader = false;
                }
                this.cardClassicLoader = false;
                this.chart1();
            }catch(error){
                ApiError(this, error);
            }
        },

    },
    mounted() {
        this.dashboardCart1();
        this.dashboardCart2();
        this.quantityVerification()
        // this.indexPaginates()
    }
}
</script>
