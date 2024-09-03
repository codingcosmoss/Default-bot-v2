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
            <div class="col-md-3 cursor-pointer" @click="this.$router.push('/')">
                <CardBlock
                    :Title="$t('RegisteredMedicines')"
                    :Number="counterStore.formatNumber(registeredMedicines)"
                    Icon="bx bx-copy-alt font-size-24"
                />
            </div>
            <div class="col-md-3 cursor-pointer" @click="this.$router.push('/')">
                <CardBlock
                    :Title="$t('ExpiredMedicines')"
                    :Number="counterStore.formatNumber(expiredMedicinesCount)"
                    Icon="bx bx-time font-size-24"
                />
            </div>
            <div class="col-md-3 cursor-pointer" @click="this.$router.push('/')">
                <CardBlock
                    :Title="$t('ImportedDrugs')"
                    :Number="counterStore.formatNumber(importedMedicines)"
                    Icon="bx bx-import font-size-24"
                />
            </div>
            <div class="col-md-3 cursor-pointer" @click="this.$router.push('/')">
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
                :Text="$t('CustomerReturnedInfo')"
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

            <BaseBox :Title="$t('SalesandPurchasestatistics')">
                <div id="dashboardChart1">
                </div>
            </BaseBox>
            <BaseBox :Title="$t('MostSoldMedicines')">
                <div id="dashboardChart2">
                    <apexchart
                        type="bar"
                        height="350"
                        :options="chartOptions"
                        :series="series"
                    ></apexchart>
                </div>
            </BaseBox>
            <BaseBox :Title="$t('CurrentMedicinesAmount')">
                <div id="dashboardChart3">
                </div>
            </BaseBox>
            <BaseBox :Title="$t('Expenses')">
                <div id="dashboardChart4">
                </div>
            </BaseBox>

        </div>
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
export default {
    components: {CardClassicBlockLoader,  apexchart: VueApexCharts, CardClassicBlock, CardBlock, BaseBox, Page},
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
            sellings: [
                {
                    x: '2024-08-20 GMT',
                    y: 10
                },
                {
                    x: '2024-08-23 GMT',
                    y: 20
                }
            ],
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

            series: [
                {
                    name: "Fruits",
                    data: [20, 15, 25], // Mevalar miqdorini bu yerda qo'shasiz
                },
            ],
            chartOptions: {
                chart: {
                    height: 350,
                    type: "bar",
                },
                plotOptions: {
                    bar: {
                        borderRadius: 10,
                        dataLabels: {
                            position: "top", // top, center, bottom
                        },
                    },
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val + "ta";
                    },
                    offsetY: -20,
                    style: {
                        fontSize: "12px",
                        colors: ["#304758"],
                    },
                },
                xaxis: {
                    categories: ["Apple", "Banana", "Orange"], // Mevalar nomini bu yerda qo'shasiz
                    position: "top",
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                    crosshairs: {
                        fill: {
                            type: "gradient",
                            gradient: {
                                colorFrom: "#D8E3F0",
                                colorTo: "#BED1E6",
                                stops: [0, 100],
                                opacityFrom: 0.4,
                                opacityTo: 0.5,
                            },
                        },
                    },
                    tooltip: {
                        enabled: true,
                    },
                },
                yaxis: {
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                    },
                },
                title: {
                    text: "Fruit Count",
                    floating: true,
                    offsetY: 330,
                    align: "center",
                    style: {
                        color: "#444",
                    },
                },
            },

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
        chart2(){
            var options = {
                chart: {
                    height: 380,
                    width: "100%",
                    type: "bar",
                },
                series: [{
                    data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
                }],
                chartOptions: {
                    chart: {
                        type: 'bar',
                        height: 350
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
                        categories: ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan',
                            'United States', 'China', 'Germany'
                        ],
                    }
                },
            };
            var chart = new ApexCharts(document.querySelector("#dashboardChart2"), options);
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
                series:[25, 15, 44, 55, 41, 17],
                labels: [
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                    'Saturday',
                ],

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
                    name: "Desktops",
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
                    })
                    this.expiredMedicinesCount = 0;
                    data.expiredMedicines.forEach(e=>{
                        this.expiredMedicinesCount += e.amount;
                    })
                    data.importedMedicines.forEach(e=>{
                        this.importedMedicines += e.amount;

                    })

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

        this.chart2()
        this.chart3()
        this.chart4()
        this.quantityVerification()
        // this.indexPaginates()
    }
}
</script>
