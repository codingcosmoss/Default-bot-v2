<template>
    <Page :Links="links" Title="So'z qo'shish" >

        <CardBody>

           <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <br>
                    <DefaultTextarea
                        Label="So'z"
                        Pholder="So'z..."
                    />
                    <br>
                    <label class="form-label">So'z turi</label>
                    <select class="form-select" @select="this">
                        <option>Select</option>
                        <option>Large select</option>
                        <option>Small select</option>
                    </select>
                    <br>
                </div>
               <div class="col-lg-6 col-sm-12">
                   <br>
                   <div class="position-relative" >
                       <DefaultInput
                           Label="Mavzular"
                           Pholder="Qidirish..."
                           @onInput="topicSearch($event)"
                       />
                       <optgroup style="background: #222736; padding: 10px 10px; z-index: 999" :class="searchData.length == 0  ? 'hidden' : '' " class="  position-absolute w-100" >
                           <option v-for="topic in searchTopics" @click="addTopic(topic)" :class="hasTopic(topic) ? 'search_item_active' : ''" class="cursor-pointer search-item" >{{topic.name}}</option>
                           <option v-if="loader" class="cursor-pointer search-item " style="text-align: center" >Searching...</option>
                       </optgroup>
                   </div>
                    <br>
                   <DefaultRange v-for="topic in  topics" :Value="topic.pracent" :Label="topic.name" @onInput="onTopic(topic, $event)" />
                   <br><br>
                   <div class="w-100 d-flex justify-content-end">
                       <button type="reset" class="btn btn-secondary waves-effect">Bekor qilish</button>
                       &nbsp;&nbsp;
                       <button class="btn btn-primary " type="submit">Saqlash</button>
                   </div>
               </div>

           </div>
            {{topics}}
        </CardBody>

    </Page>
</template>
<script >
import {useConterStore} from "@/store/counter.js";
import StaticBackdropModal from "@/ui-components/Modals/StaticBackdropModal.vue";
import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
import {topicSearch} from "@/Api.js";
import {Alert} from "@/Config.js";
import Page from "@/components/Layout/Page.vue";
import CardBody from "@/ui-components/Containers/CardBody.vue";
import DefaultTextarea from "@/ui-components/Forms/DefaultTextarea.vue";
import SearchSelect from "@/ui-components/Forms/SearchSelect.vue";
import DefaultRange from "@/ui-components/Forms/DefaultRange.vue";
import Loader from "@/ui-components/Items/Loader.vue";
export default {
    components:{Loader, DefaultRange, SearchSelect, DefaultTextarea, CardBody, Page, DefaultInput, StaticBackdropModal},
    data(){return{
        links: [
            {
                path: '/admin/words',
                name: "So'zlar",
                status: false
            },
            {
                path: '/',
                name: "So'z qo'shish",
                status: true
            }
        ],
        text: '',
        phrase_id: '',
        topics:[],
        searchData: '',
        searchTopics: [],
        validated: '',
        loader: false,
    }},
    methods:{
        async create(){
            let response = [];
            try {
                let data = {
                    name: this.name
                }
                response = await topicCreate(data);
                this.validated = response.data;
                if (response.status){
                    this.$emit('onCreated', true);
                    this.name = '';
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
        async topicSearch(val){
            this.searchData = val;
            this.loader = true;
            try {
                var data = {
                    'search': val,
                    'paginate': 1000
                }
                const response = await topicSearch(data);
                this.searchTopics = response.data.items;
            }catch (e){
                useConterStore().sendError(this,e);
            }
            this.loader = false;

        },
        addTopic(val){
            let isTopic = false;
            this.topics.forEach((topic)=>{
                if (topic.id == val.id){
                    isTopic = true;
                    return true;
                }
            })
            if (!isTopic){
                this.topics.push({
                    id: val.id,
                    name: val.name,
                    pracent: 50
                })
            }
        },
        onTopic(val, number) {
            this.topics = this.topics.map((e) => {
                if (e.id === val.id) {
                    e.pracent = number; // Corrected the typo "pracent" to "percent"
                }
                return e; // Return the updated element
            });
        },
        hasTopic(val){
            let isTopic = false;
            this.topics.forEach((topic)=>{
                if (topic.id == val.id){
                    isTopic = true;
                    return true;
                }
            })
            return isTopic;
        }

    }
}

</script>
