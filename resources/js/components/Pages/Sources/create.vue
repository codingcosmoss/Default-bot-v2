<template>
    <StaticBackdropModal Id="create_modal" Title="Manba qo'shish" @onModal="create" :isDisabled="name == '' ? true : false" >

        <DefaultInput
            Label="Manba nomi"
            @onInput="name = $event"
            Name="name"
            :Validated="validated"

        />

        <DefaultTextarea
            Label="Izoh"
            @onInput="text = $event"
        />

    </StaticBackdropModal>
</template>
<script >
import StaticBackdropModal from "@/ui-components/Modals/StaticBackdropModal.vue";
import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
import {sourceCreate} from "@/Api.js";
import {Alert} from "@/Config.js";
import DefaultTextarea from "@/ui-components/Forms/DefaultTextarea.vue";
export default {
    components:{DefaultTextarea, DefaultInput, StaticBackdropModal},
    data(){return{
        name: '',
        text: '',
        validated: ''
    }},
    methods:{
        async create(){
            let response = [];
            try {
                let data = {
                    name: this.name,
                    text: this.text
                }
                response = await sourceCreate(data);
                this.validated = response.data;
                if (response.status){
                    this.$emit('onCreated', true);
                    this.name = '';
                    this.text = '';
                    this.validated = []
                    Alert('success','create');
                }else {
                    Alert('error', 'dublicatColumn')
                }
            }catch (e){
                this.validated = response.data;
                Alert('error', 'dublicatColumn')
            }
        },
        closeModal(){
            const modal = document.getElementById('create_modal');
            const body = document.getElementById('body');
            const modalBox = document.querySelector('.modal-backdrop');

            modal.setAttribute("aria-hidden", true);

            body.style = "";
            body.classList.remove('modal-open')
            modal.style.display = 'none';
            modal.removeAttribute('aria-modal');
            modal.removeAttribute('role');
            modal.classList.remove('show');
            modalBox.classList.remove('show');
            modalBox.remove();


        }
    }
}

</script>
