<template>

    <ModalLayout :isSubmit = "false"   :isModal = "isCreateModal"  @closeModal = "this.$emit('closeModal', $event) " :Title = "Model['name']" >
        <h1>sdnjsafjkabfjsafjasf fasnfjkasdnjk</h1>
        <h1>sdnjsafjkabfjsafjasf fasnfjkasdnjk</h1>
        <h1>sdnjsafjkabfjsafjasf fasnfjkasdnjk</h1>

        <table class="table01" v-if="Model != []" >

<!--            <tr>-->
<!--                <th>{{getName('code')}}: &nbsp;&nbsp;</th>-->
<!--                <td>{{Model['code']}}</td>-->
<!--            </tr>-->
                        <tr>
                            <th>{{getName('code')}}: &nbsp;&nbsp;</th>
                            <td>{{getName('code')}}</td>
                        </tr>



        </table>

    </ModalLayout>
</template>
<script >
import {useConterStore} from "@/store/counter.js";
import Page from "@/components/Layout/Page.vue";
import ModalLayout from "../../../../ui-components/Element/Modal01/ModalLayout.vue";
export default {
    components:{ModalLayout, Page},
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
            console.log('okey:', this.isCreateModal)
            // const response = await serviceShow(this.UpdateId);
            // this.Model = response.data;
            // console.log(response.data)
        },


    },
    watch:{
        UpdateId: function(newVal, oldVal) { // watch it
            this.getModal()
        }
    },


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
