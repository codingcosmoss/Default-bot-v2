<template>
    <StaticBackdropModal Id="update" Title="Mavzu tahrirlash" @onModal="update" :isDisabled="name == '' ? true : false" >

        <DefaultInput
            Label="Mavzu nomi"
            @onInput="name = $event"
            Name="name"
            :Validated="validated"
            :Value="Model.name"
        />

    </StaticBackdropModal>
</template>
<script >
import StaticBackdropModal from "@/ui-components/Modals/StaticBackdropModal.vue";
import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
import {topicUpdate} from "@/Api.js";
import {Alert} from "@/Config.js";
export default {
    components:{DefaultInput, StaticBackdropModal},
    data(){return{
        name: '',
        validated: ''
    }},
    props:{
        Model:{
            type: [Array, Object],
            default: []
        }
    },
    methods:{
        async update(){
            let response = [];
            try {
                let data = {
                    name: this.name
                }
                response = await topicUpdate(this.Model.id, data);
                console.log(response, data)
                this.validated = response.data;
                if (response.status){
                    this.$emit('onUpdated', true);
                    this.name = '';
                    this.validated = []
                    Alert('success','update');
                }else {
                    Alert('error', 'dublicatColumn')
                }
            }catch (e){
                this.validated = response.data;
                Alert('error', 'dublicatColumn')
            }
        },
    }

}

</script>
