<template>

    <ModalLayout @Submit = "this.$emit('onSubmit', true)"   :isModal = "isShowModal" @closeModal = "this.$emit('closeModal', $event) " :Title = "Patient.last_name != undefined ? Patient.last_name+' '+Patient.first_name : '' " >

        <slot></slot>

    </ModalLayout>

</template>
<script >

import Page from "../../../Layout/Page.vue";
import Input from "../Update/Inputs/Input.vue";
import ModalLayout from "../../../../ui-components/Element/Modal01/ModalLayout.vue";
import {useConterStore} from "../../../../store/counter.js";
import {TreatmentShow} from "../../../../Api.js";
import {Alert} from "../../../../Config.js";
import Select from "../../Services/Create/Inputs/Select.vue";
export default {
    components:{Select, ModalLayout, Input, Page,},
    data(){
        return{
            status: 1,
            categoryName: '',
            errorObj: {},
            Model: [],
            doctor: [],
            Patient: [],
        }
    },
    props:{

        isShowModal:{
            type: Boolean,
            default: false
        },
        UpdateId:{
            type: Number,
            default: false
        }
    },
    methods:{
        getName(val){
            return useConterStore().getName(val)
        },
        getClass(e){
            if (e == 10){
                return 'unmount';
            }else if (e == 11){
                return 'fullUnmount';
            }else{
                return '';
            }
        },
        getStatus(e){
            if (e == 7){
                return this.getName('New');
            }else if (e == 8){
                return this.getName('DoctorFinished');
            }else if (e == 9){
                return this.getName('Finished');
            }else if (e == 10){
                return this.getName('Unpaint');
            }else if (e == 11){
                return this.getName('NotFullPaint');
            }else if (e == 12){
                return this.getName('Closed');
            }

        },
        hasKey(key) {
            return key in this.errorObj;
        },
        async getModal(){
            const response = await TreatmentShow(this.UpdateId);
            this.Model = response.data;
            this.doctor = response.data.doctor;
            this.Patient = response.data.patient;
        },


    },
    watch:{
        UpdateId: function(newVal, oldVal) { // watch it
            this.getModal()
        }
    }

}
</script>

<style scoped>
    table{
        width: 100%;
    }
    th{
        text-align: left;
        border: 2px solid rgba(37, 154, 230, 0.7);
        padding: 10px;
    }
    td{
        font-weight: 100;
        border: 2px solid rgba(37, 154, 230, 0.7);
        padding: 10px;
    }

</style>
