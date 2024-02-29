<template>

    <ModalLayout :isSubmit = "false"   :isModal = "isCreateModal" @closeModal = "this.$emit('closeModal', $event) " :Title = "getName('create')" >

        <table class="table01" v-if="Model != []" >

            <tr>
                <th>ID: &nbsp;&nbsp;</th>
                <td>{{Model['id']}}</td>
            </tr>

            <tr>
                <th>{{getName('code')}}: &nbsp;&nbsp;</th>
                <td>{{Model['code']}}</td>
            </tr>

            <tr>
                <th>{{getName('category')}}: &nbsp;&nbsp;</th>
                <td>{{Model['category'] != null ? Model['category']['name'] : '' }}</td>
            </tr>

            <tr>
                <th>{{getName('material_price')}}: &nbsp;&nbsp;</th>
                <td>{{Model['material_price']}}</td>
            </tr>

            <tr>
                <th>{{getName('technic_price')}}: &nbsp;&nbsp;</th>
                <td>{{Model['technic_price']}}</td>
            </tr>

            <tr>
                <th>{{getName('price')}}: </th>
                <td>{{Model['price']}}</td>
            </tr>

            <tr>
                <th>{{getName('Serial_number')}}: </th>
                <td>{{Model['order']}}</td>
            </tr>

            <tr>
                <th>{{getName('status')}}: </th>
                <td>{{Model['status'] == 1 ? 'Active' : 'Inactive'}}</td>
            </tr>


        </table>

    </ModalLayout>

</template>
<script >

import Page from "../../../Layout/Page.vue";
import Input from "../Update/Inputs/Input.vue";
import ModalLayout from "../../../../ui-components/Element/Modal01/ModalLayout.vue";
import {useConterStore} from "../../../../store/counter.js";
import {serviceShow} from "../../../../Api.js";
import {Alert} from "../../../../Config.js";
import Select from "../../Services/Create/Inputs/Select.vue";
export default {
    components:{Select, ModalLayout, Input, Page,},
    data(){
        return{
            status: 1,
            categoryName: '',
            errorObj: {},
            Model: []
        }
    },
    props:{
        isCreateModal:{
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
        hasKey(key) {
            return key in this.errorObj;
        },
        async getModal(){
            const response = await serviceShow(this.UpdateId);
            this.Model = response.data;
            console.log(response.data)
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
