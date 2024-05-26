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
                    />

                    <label class="form-label">So'z manbasi</label>
                    <div class="col-lg-6" >
                        <select class="form-select " :disabled="loader" @input="source_id = $event.target.value">
                            <option selected value="">---</option>
                            <option :value="source.id" v-for=" source in sources" >{{source.name}}</option>
                        </select>
                        <button  data-bs-toggle="modal" data-bs-target="#create_modal" type="button" class="btn btn-primary waves-effect m-0 mt-2 waves-light create_btn" >
                            Manba qo'shish
                        </button>
                    </div>

                    <br>
                    <div class="w-100 d-flex justify-content-end">
                        <button :disabled="loader" type="reset"  @click="this.$router.go(-1)" class="btn btn-secondary waves-effect">Bekor qilish</button>
                        &nbsp;&nbsp;
                        <button @click="create()" :disabled="loader" class="btn btn-primary " type="submit">Generatsiya qilish</button>
                    </div>


                </div>

               <div class="col-lg-12 col-sm-12" v-if="loader">
                   <br>
                   <br>
                   <!--   Progres bar   -->
                   <div class="">
                       <Loader></Loader>
                   </div>
                   <br>
               </div>



           </div>
        </CardBody>

        <SourceCreateModal @onCreated="index()" ></SourceCreateModal>

    </Page>
</template>
<script >
import {useConterStore} from "@/store/counter.js";
import StaticBackdropModal from "@/ui-components/Modals/StaticBackdropModal.vue";
import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
import {savedWordCreate, savedWords, sources} from "@/Api.js";
import {Alert} from "@/Config.js";
import Page from "@/components/Layout/Page.vue";
import CardBody from "@/ui-components/Containers/CardBody.vue";
import DefaultTextarea from "@/ui-components/Forms/DefaultTextarea.vue";
import SearchSelect from "@/ui-components/Forms/SearchSelect.vue";
import DefaultRange from "@/ui-components/Forms/DefaultRange.vue";
import Loader from "@/ui-components/Items/Loader.vue";
import SourceCreateModal from '../Sources/create.vue'
export default {
    components:{Loader, DefaultRange, SearchSelect, DefaultTextarea, CardBody, Page, DefaultInput, StaticBackdropModal, SourceCreateModal},
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
        sources: [],
        source_id: ''
    }},
    methods:{
        async create() {
            try {
                this.loader = true;
                let response;
                let created = true;
                let data = {
                    text: this.text,
                    source_id: this.source_id,
                    status: 1
                }
                response = await savedWordCreate(data);
                console.log(response)
                if (!response.status) {
                    created = false;
                    console.log('Error text:', e);
                    console.log('Error:', response);
                    Alert('error', 'formError');
                }

                if (created) {
                    this.$router.go(-1);
                    this.text = '';
                    this.progres = 0;
                    Alert('success', 'create');
                }
            } catch (error) {
                console.error('Error:', error);
                this.validated = response ? response.data : [];
                Alert('error', 'formError');
            } finally {
                this.loader = false;
            }
        },
        async index(){
            try {
                const response = await sources(this.currentPage , 1000);
                this.sources = response.data.items;
            }catch (e){
                useConterStore().sendError(this,e);
            }
            this.loader = false;
        },


    },
    mounted() {
        this.index()
    }

}

</script>
