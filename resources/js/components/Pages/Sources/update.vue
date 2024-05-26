<template>
    <StaticBackdropModal Id="update" Title="Mavzu tahrirlash" @onModal="update" :isDisabled="(name == '' && text == '') ? true : false" >

        <DefaultInput
            Label="Mavzu nomi"
            @onInput="name = $event"
            Name="name"
            :Validated="validated"
            :Value="Model.name"
        />

        <DefaultTextarea
            Label="Izoh"
            @onInput="text = $event"
            :Value="Model.text"
        />

    </StaticBackdropModal>
</template>
<script >
import StaticBackdropModal from "@/ui-components/Modals/StaticBackdropModal.vue";
import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
import {sourceUpdate} from "@/Api.js";
import {Alert} from "@/Config.js";
import DefaultTextarea from "@/ui-components/Forms/DefaultTextarea.vue";
export default {
    components:{DefaultTextarea, DefaultInput, StaticBackdropModal},
    data(){return{
        name: '',
        validated: '',
        text: ''
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
                    name: this.name == '' ? this.Model.name : this.name,
                    text: this.text == '' ? this.Model.text : this.text
                }
                response = await sourceUpdate(this.Model.id, data);
                console.log(response, data)
                this.validated = response.data;
                if (response.status){
                    this.$emit('onUpdated', true);
                    this.name = '';
                    this.text = '';
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
