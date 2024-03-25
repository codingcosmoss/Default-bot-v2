<template>


    <ContentBox style="margin-bottom: 25px" >

        <ContentBlock
            @click = "this.$router.push({path: '/employees-payments/show' , query: {id: item.id}})"
            v-for="(item , index) in Employees"
            :Title = "item.name"
            :Text1 = " item.finished_count + ' ta ( ' + Sum(item.finished_treatments) + ' uzs )'"
            :Text2 = " item.deptor_count + ' ta ( ' + Sum(item.deptor_treatments) + ' uzs )'"
            Icon = "fa-solid fa-handshake"
            Item = ""
        />

    </ContentBox>




</template>
<script >

import {useConterStore} from "@/store/counter.js";
import Input from "@/components/Pages/Diseases/EditPassword/Inputs/Input.vue";
import ImageInput from "@/components/Pages/Employees/Update/Inputs/ImageInput.vue";
import ContentBlock from "./Contents/ContentBlock.vue";
import ContentBox from "./Contents/ContentBox.vue";
import {employeeCreate, getEmployeePayments, treatmentDiscount} from "@/Api.js";

export default {

    data(){
        return{
            Employees: [],
        }
    },
    components:{ContentBox, ContentBlock, ImageInput, Input},
    methods:{
        employeeCreate() {
            return employeeCreate
        },

        getName(val){
            return useConterStore().getName(val)
        },
        async getIndex(){
            const response = await getEmployeePayments();
            this.Employees = response.data;
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
