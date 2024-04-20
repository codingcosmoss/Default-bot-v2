<template >
    <Page :Animation = "false" >

        <div class="col-span-12 xl:col-span-8 ">
            <h4   class="mb-6 mt-6 text-xl font-bold text-black dark:text-white">
                {{getName('Employee')}}: {{Employee.name}}
            </h4>
            <div
                class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">


                <h4   class="mb-6 mt-6 text-xl font-bold text-black dark:text-white">
                    {{getName('PaymentTreatments')}}
                </h4>

                <div class="flex flex-col table_media_box">

                    <div v-for=" item in Employee.finished_treatments"  class="grid grid-cols-3 border-b  border-stroke dark:border-strokedark sm:grid-cols-3 databes_table ">

                        <div class="flex items-center gap-3 p-2.5 xl:p-5">
                            <p class="font-bold  text-black dark:text-white sm:block ">
                                <Checkbox01
                                    :onCheck = "searchKey(item.id)"
                                    @click = "sendData(item)"
                                    :Title = "getName('Patient') + ': ' + item.patient_name"
                                />

                            </p>
                        </div>


                        <div class="flex items-center justify-center p-2.5 xl:p-5">
                            <p class="font-medium  text-black dark:text-white">{{counterStore.formatNumber(item.doctor_sum)}} UZS</p>
                        </div>

                        <div class="flex items-center justify-center p-2.5 xl:p-5">
                            <p class="font-medium text-black dark:text-white">
                                {{item.start}}
                            </p>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        <RightTable class="box001" :Sum = "DebtorSum" :Items = "Employee.deptor_treatments"></RightTable>

        <h4>{{getName('PaymentTypes')}}:</h4>
        <Checkbox01
            v-for="payment in PayTypes"
            :Title = "payment.name"
            @click = "PaymentId = payment.id"
            :onCheck = "payment.id == PaymentId ? true : false"

        />


       <PrimaryButton
           v-if="Patients.length > 0"
           :Title ="getName('ToPay')"
           @click = "Payment()"
       />
    </Page>


</template>
<script >

import {useConterStore} from "@/store/counter.js";
import Checkbox01 from "@/ui-components/Form/Checkbox/Checkbox01.vue";
import Checkbox from "@/components/Pages/Diseases/EditPassword/Inputs/Checkbox.vue";
import Page from "@/components/Layout/Page.vue";
import {showEmployeePayments} from "@/Api.js";
import inputText from "../../../../ui-components/Form/InputText.vue";
import RightTable from "./RightTable.vue";
import PrimaryButton from "@/ui-components/Form/PrimaryButton.vue";
import {PaymentTypes} from "@/Api.js";
import {Alert} from "@/Config.js";
import {storeEmployeePayments} from "@/Api.js";


export default {
    computed: {
        inputText() {
            return inputText
        }
    },
    setup(){
        const counterStore = useConterStore();
        return{counterStore}
    },

    components: {PrimaryButton, RightTable, Page, Checkbox, Checkbox01},
    data(){
        return{
            Employee: [],
            PayTypes: [],
            PaymentId: 0,
            Patients: [],
            DebtorSum: 0
        }
    },
    methods:{
        async Payment(){
            let data = {
                patients: this.Patients,
                payment_type_id: this.PaymentId
            }
            const response = await storeEmployeePayments(data);
            console.log(response)
            if(response.status == true){
                this.$router.push('/employees-payments');
                Alert('success', 'Saved successfully !')
            };
        },
        sendData(item){
            let id = 0;
            this.Patients.forEach((patient) => {
                if (item.id == patient.id){
                    id = item.id;
                }
            })
            if (id != 0){
                this.Patients = this.Patients.filter((item) => item.id != id );
            }else {
                this.Patients.push({
                    id: item.id
                })
            }

        },
        searchKey(id){
            let isArray = false;
            this.Patients.forEach((e) =>{
                if (e.id == id){
                    isArray = true;
                }
            });
            return isArray;
        },
        getName(val){
            return useConterStore().getName(val)
        },
        async getIndex(){
            const response = await showEmployeePayments(this.$route.query.id);
            console.log(response)
            this.Employee = response.data;
            response.data.deptor_treatments.forEach((e) => {
                this.DebtorSum +=e.doctor_sum;
            })

        },
        async getPaymentTypes(){
            const response = await PaymentTypes(1, 1000);
            this.PayTypes = response.data.items;
            if (response.data.items.length > 0){
                this.PaymentId = response.data.items[0].id;

            }


        },


    },
    mounted() {
        this.getIndex()
        this.getPaymentTypes()
    }


}
</script>
<style scoped>
    .box001{
        margin-top: 75px;
    }
    @media (max-width: 1023px) {
        .box001{
            margin-top: 0 !important;
        }
    }
</style>
