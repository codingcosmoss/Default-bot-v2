<template>
    <Page Title="">
        <div class="row">

            <div v-for="i in 4" v-if="cardLoader"  class="col-lg-3 cursor-pointer">
                <div class="card mini-stats-wid">
                    <div  class="card-body">
                        <div  class="d-flex flex-wrap">
                            <div class="me-3">
                                <p class=" mb-2 placeholder">Uzbekistani</p><br>
                                <h5 class="mb-0 placeholder ">201 000 сўм</h5>
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

            <div class="col-md-3 cursor-pointer" @click="this.$router.push('/')">
                <CardBlock
                    :Title="$t('RegisteredMedicines')"
                    :Number="1200"
                    Icon="bx bx-copy-alt font-size-24"
                />
            </div>
            <div class="col-md-3 cursor-pointer" @click="this.$router.push('/')">
                <CardBlock
                    :Title="$t('ExpiredMedicines')"
                    :Number="1200"
                    Icon="bx bx-time font-size-24"
                />
            </div>
            <div class="col-md-3 cursor-pointer" @click="this.$router.push('/')">
                <CardBlock
                    :Title="$t('ImportedDrugs')"
                    :Number="1200"
                    Icon="bx bx-import font-size-24"
                />
            </div>
            <div class="col-md-3 cursor-pointer" @click="this.$router.push('/')">
                <CardBlock
                    :Title="$t('WarehouseAvailableMedicines')"
                    :Number="1200"
                    Icon="bx bx-pie-chart-alt-2 font-size-24"
                />
            </div>

            <CardClassicBlock
                Icon="bx bx-export"
                :Title="$t('TotalPaid')"
                :Currencies="[]"
                Share="12.3 %"
                Text="Skote Saas Dashboard"
            />
            <CardClassicBlock
                Icon="bx bx-import"
                :Title="$t('ImportPaid')"
                :Currencies="[]"
                Share="12.3 %"
                Text="Skote Saas Dashboard"
            />
            <CardClassicBlock
                Icon="bx bx-collection"
                :Title="$t('TotalCosts')"
                :Currencies="[]"
                Share="12.3 %"
                Text="Skote Saas Dashboard"
            />
            <CardClassicBlock
                Icon="bx bx-collection"
                :Title="$t('TotalNetProfit')"
                :Currencies="[]"
                Share="12.3 %"
                Text="Skote Saas Dashboard"
            />




            <BaseBox :Title="$t('SalesandPurchasestatistics')">
                <div id="dashboardChart1">
                </div>
            </BaseBox>
            <BaseBox :Title="$t('MostSoldMedicines')">
                <div id="dashboardChart2">
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
import BaseBox from "@/components/global/BaseBox.vue";
import CardBlock from "@/components/all/CardBlock.vue";
import CardClassicBlock from "@/components/all/CardClassicBlock.vue";
import {quantityVerification} from "@/helpers/api.js";
export default {
    components: {CardClassicBlock, CardBlock, BaseBox, Page},
    setup() {
        const counterStore = useConterStore();
        return {counterStore}
    },
    data() {
        return {
            items: [],
            item: [],
            paginateCount: 10,
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
                if (response.status){
                    await this.search()
                }
                this.loader = false;
            }catch(error){
                ApiError(this, error);
            }
        },
    },
    mounted() {
        this.chart1()
        this.chart2()
        this.chart3()
        this.chart4()
        this.quantityVerification()
        // this.indexPaginates()
    }
}
</script>
