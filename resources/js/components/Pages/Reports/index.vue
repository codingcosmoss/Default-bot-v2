<template>
    <Page :Classes = "false" >

        <div class="grid grid-cols-1 gap-9 sm:grid-cols-2">
            <div class="flex flex-col gap-9">
                <!-- Contact Form -->

                <div
                    class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark"
                >

                    <form action="#">

                        <div class="p-6.5">
                            <h3 class="font-semibold text-black dark:text-white">
                                {{ getName("DateStatistic") }}
                            </h3>
                            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row " style="align-items: center">
                                <Input
                                    @input = "getIndex"
                                    :Couple="false"
                                    Label=""
                                    @onInput="end = $event"
                                    :Value="end"
                                    Type = "date"
                                    style="width: 200px;"
                                />
                                <b>-</b>
                                <Input
                                    @input = "getIndex"
                                    :Couple="false"
                                    Label=""
                                    @onInput="start = $event"
                                    :Value="start"
                                    style="width: 200px"
                                    Type = "date"
                                />

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <br>
        <ContentBox style="margin-bottom: 25px" >

            <ContentBlock
                :Title = "getName('TotalServicePrices')"
                :Text = "useConterStore().formatNumber(totalServiceSum) + ' uzs' "
                Icon = "fa fa-fas fa-coins"
                Item = ""
            />

            <ContentBlock
                :Title = "getName('GivenMoney')"
                :Text = "useConterStore().formatNumber(totalClientPaymentCashSum) + ' uzs' "
                Icon = "fa fa-fas fa-coins"
                Item = ""
            />

            <ContentBlock
                :Title = "getName('DailyExpenses')"
                :Text = "useConterStore().formatNumber(dailyExpensesTotalSum) + ' uzs' "
                Icon = "fa fa-fas fa-coins"
                Item = ""
            />

            <ContentBlock
                :Title = "getName('ClientPayments')"
                :Text = "useConterStore().formatNumber(totalClientPaymentSum) + ' uzs' "
                Icon = "fa fa-fas fa-coins"
                Item = ""
            />


        </ContentBox>

        <!--   Xarajatlar     -->
        <Expenses></Expenses>


    </Page>
</template>
<script >
import Page from "../../Layout/Page.vue";
import {useConterStore} from "@/store/counter.js";
import Input from "@/components/Pages/Diseases/EditPassword/Inputs/Input.vue";
import ContentBlock from "./Contents/ContentBlock.vue";
import ContentBox from "./Contents/ContentBox.vue";
import {employeeCreate, getEmployeePayments, reports, treatmentDiscount} from "@/Api.js";
import Expenses  from './Expenses/Table.vue';
import Select from "@/components/Pages/Services/Create/Inputs/Select.vue";
import DinamicForm from "@/ui-components/Form/DinamicForm.vue";
    export default {
        components:{DinamicForm, Select, Input, ContentBox, ContentBlock, Page, Expenses},
        setup(){
            return {useConterStore}
        },
        data(){
            return{
                Employees: [],
                Reports: [],
                totalServiceSum: 0,
                totalClientPaymentCashSum: 0,
                dailyExpensesTotalSum: 0,
                stuffGivenTotalSum: 0,
                totalClientPaymentSum: 0,
                start: 0,
                end:0,
            }
        },
        methods:{
            employeeCreate() {
                return employeeCreate
            },
            getDate(){
                const today = new Date();
                const year = today.getFullYear();
                const month = String(today.getMonth() + 1).padStart(2, '0'); // +1 qo'shib o'tkazish sababi: JavaScript oy nomerlari 0 dan boshlanadi.
                const day = String(today.getDate()).padStart(2, '0');

                const result = `${year}-${month}-${day}`;
                console.log('R:', result)
                this.start = result; // Bugungi sanani konsolga chiqaring

                // ertangi kunni olish
                today.setDate(today.getDate() - 1); // 1 kun qo'shib, keyingi kunni olish
                const year2 = today.getFullYear(); // Yil
                const month2 = today.getMonth() + 1; // Oy (0 dan 11 gacha hisoblanadi, shuning uchun +1 qo'shamiz)
                const day2 = today.getDate(); // Kun

                let result2 = `${year2}-${month2}-${day2}`
                this.end = result2
                this.getEndDate()
            },
            getEndDate(){
                const today = new Date();
                today.setDate(today.getDate() - 1);
                const year = today.getFullYear();
                const month = String(today.getMonth() + 1).padStart(2, '0'); // +1 qo'shib o'tkazish sababi: JavaScript oy nomerlari 0 dan boshlanadi.
                const day = String(today.getDate()).padStart(2, '0');

                let result = `${year}-${month}-${day}`
                this.end = result

            },


            getName(val){
                return useConterStore().getName(val)
            },
            async getIndex(){
                // const response = await reports(this.yesterday, this.currentDate);
                setTimeout(async ()=>{
                    const response = await reports(this.start, this.end);
                    this.totalServiceSum = response.data.totalServiceSum;
                    this.totalClientPaymentCashSum = response.data.totalClientPaymentCashSum;
                    this.dailyExpensesTotalSum = response.data.dailyExpensesTotalSum;
                    this.stuffGivenTotalSum = response.data.stuffGivenTotalSum;
                    this.totalClientPaymentSum = response.data.totalClientPaymentSum;

                    this.Reports = response.data;
                }, 500)
            },
            Sum(treatments){
                let sum = 0;
                treatments.forEach((treatment) => {
                    sum+= treatment.doctor_sum;
                })
                return useConterStore().formatNumber(sum);
            },

            hasKey(key) {
                return key in this.errorObj;
            },


        },
        mounted() {
            this.getIndex()
            this.getDate()
        }

    }


</script>
<style scoped>
.genderCheckbox{
    display: flex;
    align-items: flex-end;
}
.Alert_div{
    width: 300px;
    height: 100px;
    background: #17e30d;
    position: sticky;
    right: 10px;
    top: 10px ;
}
.list01{
    padding: 5px 27px;
    display: flex;
    align-content: space-between;
    justify-content: space-between;
    flex-direction: column;
}
.btn{
    width: 60px;
    transform: scale(0.8);
}

.btn2{
    margin: 20px 0;
    margin-top: 30px;
    margin-left: 10px;
    width: 60px;
    transform: scale(0.8);
}
.btn2 button{
    background: rgba(255, 0, 0, 0.8);
}

.alert {
    width: 500px !important;
    background: #17e30d;
    color: white;
    position: relative;
    left: 0;
    width: auto;
    height: auto;
    padding: 10px;
    margin: 10px;
    line-height: 1.8;
    border-radius: 5px;
    cursor: hand;
    cursor: pointer;
    font-family: sans-serif;
    font-weight: 400;
}

.alertCheckbox {
    display: none;
}

:checked + .alert {
    display: none;
}

.alertText {
    display: table;
    margin: 0 auto;
    text-align: center;
    font-size: 16px;
}

.alertClose {
    float: right;
    padding-top: 5px;
    font-size: 10px;
}

.clear {
    clear: both;
}

.info {
    background-color: #EEE;
    border: 1px solid #DDD;
    color: #999;
}

.success {
    background-color: #EFE;
    border: 1px solid #DED;
    color: #9A9;
}

.notice {
    background-color: #EFF;
    border: 1px solid #DEE;
    color: #9AA;
}

.warning {
    background-color: #FDF7DF;
    border: 1px solid #FEEC6F;
    color: #C9971C;
}

.error {
    background-color: #FEE;
    border: 1px solid #EDD;
    color: #A66;
}


</style>
