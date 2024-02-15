<template>

    <ModalLayout @Submit = "createCategory" :isModal = "isCreateModal" @closeModal = "this.$emit('closeModal', $event) " :Title = "getName('create')" >

        <Input
            :Label = "getName('name_content')"
            @onInput = "categoryName = $event"
            :isError = "hasKey('name')"
            :message = "errorObj['name']"
            :Value = "categoryName"
        />

        <Select
            :Label = "getName('status')"
            @onSelect = "this.status = $event"
        >

            <option
                :value="1"
            > Active</option>
            <option
                :value="0"
            > Inactive</option>

        </Select>

    </ModalLayout>

</template>
<script >

import Page from "../../../Layout/Page.vue";
import ModalLayout from "../../../../ui-components/Element/Modal01/ModalLayout.vue";
import {useConterStore} from "../../../../store/counter.js";
import {service_categoryCreate} from "../../../../Api.js";
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
        isCreateModal:{
            type: Boolean,
            default: false
        },
        isUpdateModal: {
            type: Boolean,
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
        async createCategory(){
            var data = {
                'name': this.categoryName,
                'status': this.status,
            }
            const response = await service_categoryCreate(data);
            console.log(response)
            if (response.status){
                this.categoryName = '';
                this.$emit('closeModal', false)
                this.$emit('Created', true)
                Alert('success', 'Created successfully !')
            }else {
                this.errorObj = response.data;
            }
        },

    }

}
</script>
