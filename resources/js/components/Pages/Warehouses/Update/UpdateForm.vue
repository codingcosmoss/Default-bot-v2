<template>

    <ModalLayout @onButton = "updateCategory" :isModal = "isUpdateModal" @closeModal = "this.$emit('closeUpdatedModal', false) " :Title = "getName('update')" >

        <Input
            :Label = "getName('name_content')"
            @onInput = "categoryName = $event"
            :isError = "hasKey('name')"
            :message = "errorObj['name']"
            :Value = "categoryName"
        />
        <Select
            :Label = "getName('status')"
            @onSelect = "status = $event"
        >

            <option
                :selected = "status == 1"
                :value="1"
            > Active</option>
            <option
                :selected = "status != 1"
                :value="0"
            > Inactive</option>

        </Select>
    </ModalLayout>

</template>
<script >

import Page from "../../../Layout/Page.vue";
import ModalLayout from "../../../../ui-components/Element/Modal01/ModalLayout.vue";
import {useConterStore} from "../../../../store/counter.js";
import {service_categoryUpdate, service_categoryShow} from "../../../../Api.js";
import {Alert} from "../../../../Config.js";
import Select from "../../Services/Create/Inputs/Select.vue";
import Input from "../../Employees/Update/Inputs/Input.vue";
export default {
    components:{Input, Select, ModalLayout, Page,},
    data(){
        return{
            status: 1,
            categoryName: '',
            errorObj: {},
        }
    },
    props:{
        isUpdateModal:{
            type: Boolean,
            default: false
        },
        Updated_Id:{
            type: Number,
            default: 0
        }
    },
    methods:{
        getName(val){
            return useConterStore().getName(val)
        },
        hasKey(key) {
            return key in this.errorObj;
        },
        async getModel(){
            console.log(this.isUpdateModal)
            const response = await service_categoryShow(this.Updated_Id);
            this.categoryName = response.data.name;
            this.status = response.data.status;
        },
        async updateCategory(){
            var data = {
                'name': this.categoryName,
                'status': this.status,
            }
            const response = await service_categoryUpdate( this.Updated_Id, data);
            if (response.status){
                this.categoryName = '';
                this.$emit('closeModal', false)
                this.$emit('Created', true)
                Alert('success', 'Update successfully !')
            }else {
                this.errorObj = response.data;
            }
        },

    },
    watch: {
        Updated_Id: function(newVal, oldVal) { // watch it
            this.getModel()
        }
    }

}
</script>
