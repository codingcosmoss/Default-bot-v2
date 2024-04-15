<template>
    <Page :Classes = "false"  >
        <ContentBox style="margin-bottom: 25px ">

            <ContentBlock
                :Title = "getName('employees')"
                :Text = "ReportData.users"
                Icon = "fa-solid fa-users"
                Item = ""
                @click = "this.$router.push('/employees')"
            />

            <ContentBlock
                :Title = "getName('Patients')"
                :Text = "ReportData.patients"
                Icon = "fa-solid fa-user-group"
                Item = ""
                @click = "this.$router.push('/patients')"
            />

            <ContentBlock
                :Title = "getName('services')"
                :Text = "ReportData.services"
                Icon = "fa-solid fa-users-gear"
                Item = ""
                @click = "this.$router.push('/services')"
            />

            <ContentBlock
                :Title = "getName('DeptorPatient')"
                :Text = "deptorPatients"
                Icon = "fa-solid fa-users-line"
                @click = "this.$router.push('/debt-treatments')"
                Item = ""
            />
        </ContentBox>


        <span style="display: flex; justify-content: space-between; gap: 30px" class="chart_box">

            <Map01  :Title="getName('TopServices')" class="chart_item">

            <GroupedBarChart :plot-data="topServices"
                             x-key="date"
                             :width="600"
                             :height="300"
                             :margin="{ top: 20, bottom: 35, left: 55, right: 20 }"
                             :colors="['#ac58e5','#E0488B']"
                             :x-axis-label="getName('services')"
                             :y-axis-label="getName('ActivedCount')"
                             :y-tick-format="d => `${d}`" />
            </Map01>

            <Map01  :Title="getName('Payments')" class="chart_item" >

                <AreaChart :plot-data="plotData2"
                           :width="600"
                           :height="300"
                           x-key="Moon"
                           :margin="{ top: 20, bottom: 30, left: 55, right: 20 }"
                           :colors="['#ac58e5','#E0488B']"
                           :x-axis-label="getName('Payments')"
                           y-axis-label=" "
                           :y-tick-format="d => `${d} sum`" />
            </Map01>
        </span>




    </Page>
</template>
<script>
import Page from "@/components/Layout/Page.vue";
import ContentBox from "@/components/Pages/Reports/Contents/ContentBox.vue";
import ContentBlock from "@/ui-components/Element/Contents/ContentBlock.vue";
import {useConterStore} from "@/store/counter.js";
import Charts from "@/components/Pages/Dashboard/Charts.vue";
import Map01 from "@/ui-components/Element/map-01.vue";
import {getDashboardData} from "@/Api.js";
export default {
    components: {Charts, Page,Map01, ContentBlock, ContentBox},
    methods:{
        getName(val){
            return useConterStore().getName(val)
        },
        async getData(){
            const response = await getDashboardData();
            if (response.status){
                this.ReportData = response.data;
                response.data.debtorPatients.forEach((e) =>{
                    if (e.payment_status == 11){
                        this.deptorPatients += 1;
                    }
                })

                response.data.allServices.forEach((e) =>{

                    this.topServices.push({
                        "date": e.name,
                        "Amount": Number(e.amount),
                    })

                })



                this.plotData2 = [];
                response.data.payments.forEach((e) =>{
                    this.plotData2.push({
                            "Moon": e.moon.split('-')[1] ,
                            "Amount": Number(e.amount),
                        }
                    )
                })
                console.log(this.plotData2)



            }else {
                this.ReportData = {
                    users: 0,
                    patients: 0,
                    services: 0,
                };

            }
        }
    },
    data(){
        return{
            ReportData: {
                users: 0,
                patients: 0,
                services: 0,
            },
            deptorPatients: 0,
            topServices: [],
            services: [
                {
                    "date": "Service",
                    "Amount": 10,
                },

            ],
            plotData2:[{} ],
        }
    },
    mounted() {
        this.getData()
    }


}
</script>

<style scoped class="scss">
    .chart_item{
        width: 50%;
    }
    @media (max-width: 1212px) {
        .chart_box{
            flex-direction: column;
            .chart_item{
                width: 100%;
            }
        }
    }
</style>
