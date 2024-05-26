<template>
    <Page :Links="links" Title="Saqlash uchun so'zlar generatsiya qilish" >

        <CardBody>

            <div class="row">
                <div class="col-lg-12 col-sm-12 " >
                    <br>
                    <DefaultTextarea
                        Rows="10"
                        :isDisabled="loader"
                        Label="Matn (Har bir so'z oxirida nuqta bilan tugashi kerak)"
                        Pholder="..."
                        @onInput="text = $event"
                        :Value="text"
                    />

                    <br>
                    <div class="w-100 d-flex justify-content-end">
                        <button :disabled="loader" type="reset"  @click="this.$router.go(-1)" class="btn btn-secondary waves-effect">Bekor qilish</button>
                        &nbsp;&nbsp;
                        <button @click="update()" :disabled="loader" class="btn btn-primary " type="submit">Saqlash</button>
                    </div>


                </div>

            </div>
        </CardBody>

        <TopicCreateModal></TopicCreateModal>

    </Page>
</template>
<script >
import {useConterStore} from "@/store/counter.js";
import StaticBackdropModal from "@/ui-components/Modals/StaticBackdropModal.vue";
import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
import {savedWordCreate, savedWordShow, savedWordUpdate} from "@/Api.js";
import {Alert} from "@/Config.js";
import Page from "@/components/Layout/Page.vue";
import CardBody from "@/ui-components/Containers/CardBody.vue";
import DefaultTextarea from "@/ui-components/Forms/DefaultTextarea.vue";
import SearchSelect from "@/ui-components/Forms/SearchSelect.vue";
import DefaultRange from "@/ui-components/Forms/DefaultRange.vue";
import Loader from "@/ui-components/Items/Loader.vue";
import TopicCreateModal from '../Topic/create.vue'
export default {
    components:{Loader, DefaultRange, SearchSelect, DefaultTextarea, CardBody, Page, DefaultInput, StaticBackdropModal, TopicCreateModal},
    data(){return{
        links: [
            {
                path: '/admin/save-words',
                name: "Saqlash uchun so'zlar",
                status: false
            },
            {
                path: '/',
                name: "Qo'shish",
                status: true
            }
        ],
        phrasesArr:[],
        text: '',
        loader: false,
        progres: 0,
        Word: '',
    }},
    methods:{
        async show(){
            let response = [];
            try{
                response = await savedWordShow(this.$route.query.id);
                this.text = response.data.text;
            }catch (e){
                this.validated = response ? response.data : [];
                Alert('error', 'formError');
            }
        },
        async update() {
            let response = [];
            try {
                this.loader = true;
                let data = {
                    text: this.text,
                    status: 1
                }
                response = await savedWordUpdate(this.$route.query.id, data);
                console.log(response)
                if (response.status) {
                    this.$router.go(-1);
                    this.text = '';
                    Alert('success', 'update');
                } else {
                    Alert('error', 'formError');
                }

                this.loader = false;
            } catch (e) {
                this.validated = response ? response.data : [];
                console.log('Error:', response);
            }
        }


    },
    mounted() {
        this.show()
    }

}

</script>
