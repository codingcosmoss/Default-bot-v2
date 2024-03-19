<template>
    <div id="printThisArea">

        <div style="width: 100%;text-align: center"><h2>{{getName('Welcome')}}</h2></div>

        <img src="https://dental.brim.uz/storage/images/vX7pjIQiwQrgGMtNGh3hKakI2fYYENvlkVdBiNDi.jpg" width="95%">

        <br>
        <div style="width: 100%; text-align: center"><span style="margin: 5px auto"> {{getName('TitleCheck')}}</span>
        </div>


        <div><h3>№:{{Treatment.id}}</h3></div>
        <div><h3
            style="margin: 0 auto">{{getName('Date')}}: {{getDate()}}</h3>
        </div>
        <br>
        <div style="border-bottom: 1px solid black; border-top: 1px solid black">
            <h3 style="margin: 1px">{{getName('Patients')}}: {{Patient.first_name}} {{Patient.last_name}}</h3>
            <h3 style="margin: 1px">{{getName('Doctor')}}:  {{Doctor.name}}</h3>
        </div>


        <table class="table-table" width="100%" id="my-table" style="margin-top: 10px">
            <tr style="border: 1px solid;">
                <td style="padding-left: 5px;text-align: center"><h4>№</h4></td>
                <td style="padding-left: 10px;text-align: center"><h4>{{getName('Service_name')}}</h4></td>
                <td style="padding-left: 10px;text-align: center"><h4>{{getName('ServiceCount')}}</h4></td>
                <td style="padding-left: 10px;text-align: center"><h4>{{getName('Summa')}}</h4></td>
            </tr>
                <tr style="border: 1px dashed  !important;" v-for="(item, index) in Items">
                    <td style="padding-left: 10px !important"><b>{{ index +1 }}</b></td>
                    <td style="padding-left: 10px !important"><b>{{item.name}}</b></td>
                    <td style="padding-left: 10px !important;width: 180px !important">
                        <b>{{item.count}}</b></td>
                    <td style="padding-left: 10px !important;width: 180px !important">
                        <b>{{ counterStore.formatNumber(Number(item.price) * Number(item.count)) }}</b></td>
                </tr>


        </table>
        <hr>

        <h3 style="margin: 14px 0 !important; text-align: end !important">{{getName('TotalSum')}}: {{counterStore.formatNumber(TotalSum)}} </h3>
        <h3 style="margin: 14px 0 !important; text-align: end !important">{{getName('Material_total_sum')}} {{counterStore.formatNumber(Material_total_sum)}}</h3>
        <h3 style="margin: 14px 0 !important; text-align: end !important">{{getName('Doctor_total_sum')}} {{counterStore.formatNumber(Doctor_total_sum)}}</h3>
        <h3 style="margin: 14px 0 !important; text-align: end !important">{{getName('Payment')}}: {{counterStore.formatNumber(TotalSum)}}</h3>
        <br>
        <div style="text-align: center !important; margin: 50px 0" class="check-discount"><h1 style="font-weight: bold">{{ getName('Discount')}}: {{Discount}}</h1></div>
        <br>

        <h3>{{getName('Doctor')}} ____________________ </h3>
        <h3>{{getName('Patients')}}: ________________</h3>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <hr>
    </div>

</template>

<script>

    import {useConterStore} from "@/store/counter.js";
    import {getName} from "../../../Config.js";
    import {treatmentAddServiceAll, TreatmentShow} from "@/Api.js";

    export default {

        setup(){
            const counterStore = useConterStore();
            return {counterStore}
        },
        getName(val){
            return useConterStore().getName(val)
        },
        data(){
            return{
                Daily_number: 0,
                Data: '01.12.2024',
                Model: [],
                Treatment: [],
                Patient: [],
                Doctor: [],
                Items: [],
                TotalSum: 0,
                Material_total_sum: 0, // hom ahsyo narxi
                Doctor_total_sum: 0, // shifokor summasi
                Discount: 0, // Chegirma,
                Payment:0 ,// Tolov,
                Success: 0
            }
        },
        methods:{
            getName(val) {
                return useConterStore().getName(val);
            },
            async getTreatment(){

                  const response = await TreatmentShow(this.$route.query.id);
                  this.Treatment =  response.data;
                  this.Discount  = response.data.discount_sum;
                this.Patient = response.data.patient;
                this.Doctor = response.data.doctor;
                if (response.status){
                    this.Success += 1;
                }
                if (this.Success == 2){
                    this.onCheck()
                }
            },
            async getItems(){
                this.Items = [];
                const response = await treatmentAddServiceAll(this.$route.query.id);
                this.Items =  response.data.items;
                this.Items.forEach((item)=>{
                    this.Material_total_sum += item.collection != null ? item.collection.summ : 0;
                    this.TotalSum += Number(item.count) * Number(item.price);
                    this.Doctor_total_sum += item.doctor_total_sum;
                })
                if (response.status){
                    this.Success += 1;
                }
                if (this.Success == 2){
                    this.onCheck()
                }

            },
            getDate(){
                var today = new Date();

                var year = today.getFullYear();
                var month = today.getMonth() + 1; // Oy nomerlarini 1 dan boshlab emas, balki 0 dan boshlanadi
                var day = today.getDate();
                var hours = today.getHours();
                var minutes = today.getMinutes();
                var seconds = today.getSeconds();
                let result = year + "-" + month + "-" + day + " " +  hours + ":" + minutes;
                return  result;

            },
            onCheck(){
                setTimeout(()=> {
                    let w = window;
                    setTimeout(function () {
                        w.print();
                        w.close();
                    }, 100);
                },100)
            }
        },
        mounted() {
            this.getTreatment(),
            this.getItems()
        }

    }
</script>

<style scoped>

.table-table {
    border-collapse: collapse !important;
    width: 100% !important;
}

@media print {
    * {
        font-size: 30px !important;
        font-family: sans-serif !important;

    }
    td{
        padding: 20px 10px !important;
        font-family: sans-serif !important;
        color: black !important;
    }
    .check-discount h1 {
        font-size: 45px !important;
        font-family: sans-serif !important;
        color: black !important;
    }
    h3{
        margin: 10px 0 !important;
        font-family: sans-serif !important;
        color: black !important;
    }

    .table-table tr {
        border: 1px solid !important;
        font-family: sans-serif !important;
    }

    .table-table tr td {
        border: 1px solid !important;
        font-family: sans-serif !important;
        color: black !important;
    }
}

</style>
