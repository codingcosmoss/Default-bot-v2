<template>
    <Page :Links="links" Title="So'z qo'shish" >

        <CardBody>

            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <br>
                    <DefaultTextarea
                        Label="So'z"
                        Pholder="So'z..."
                        @onInput="text = $event"
                        :Value="text"
                    />
                    <br>
                    <label class="form-label">So'z turi</label>
                    <select class="form-select" @input="phrase_id = $event.target.value">
                        <option :selected="phrase_id == item.id" :value="item.id" v-for=" item in phrasesArr" >{{item.name}}</option>
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
                        <button data-bs-toggle="modal" data-bs-target="#create_modal" type="button" class="btn btn-primary waves-effect waves-light create_btn m-0" >
                            Mavzu qo'shish
                        </button>
                        <optgroup style="background: #222736; padding: 10px 10px; z-index: 999" :class="searchData.length == 0  ? 'hidden' : '' " class="  position-absolute w-100" >
                            <option v-for="topic in searchTopics" @click="addTopic(topic)" :class="hasTopic(topic) ? 'search_item_active' : ''" class="cursor-pointer search-item" >{{topic.name}}</option>
                            <option  v-if="loader" class="cursor-pointer search-item " style="text-align: center" >Searching...</option>
                        </optgroup>
                    </div>
                    <br>
                    <div class="d-flex flex-wrap justify-content-between" >
                        <DefaultRange @onDelete="onDeleteTopic(topic)" v-for="topic in  topics" :Value="topic.percent" :Label="topic.name" @onInput="onTopic(topic, $event)" />
                    </div>
                    <br><br>
                    <div class="w-100 d-flex justify-content-end">
                        <button type="reset"  @click="this.$router.go(-1)" class="btn btn-secondary waves-effect">Bekor qilish</button>
                        &nbsp;&nbsp;
                        <button @click="update()" class="btn btn-primary " type="submit">Saqlash</button>
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
import {topicSearch, phrases, wordUpdate, wordShow} from "@/Api.js";
import {Alert} from "@/Config.js";
import Page from "@/components/Layout/Page.vue";
import CardBody from "@/ui-components/Containers/CardBody.vue";
import DefaultTextarea from "@/ui-components/Forms/DefaultTextarea.vue";
import SearchSelect from "@/ui-components/Forms/SearchSelect.vue";
import DefaultRange from "@/ui-components/Forms/DefaultRange.vue";
import Loader from "@/ui-components/Items/Loader.vue";
import TopicCreateModal from "@/components/Pages/Topic/create.vue";
export default {
    components:{
        TopicCreateModal,
        Loader, DefaultRange, SearchSelect, DefaultTextarea, CardBody, Page, DefaultInput, StaticBackdropModal},
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
        phrasesArr:[],
        text: '',
        phrase_id: '',
        topics:[],
        searchData: '',
        searchTopics: [],
        validated: [],
        loader: false,
        word: []
    }},
    methods:{
        async update(){
            let response = [];
            try {
                let data = {
                    text: this.text,
                    phrase_id: this.phrase_id,
                    word_topics: this.topics,
                }
                response = await wordUpdate(this.$route.query.id,data);
                this.validated = response.data;
                if (response.status){
                    this.text = '';
                    this.phrase_id = '';
                    this.topics = [];
                    this.validated = []
                    Alert('success','update');
                    this.$router.go(-1);
                }else {
                    Alert('error', 'formError')
                }
                console.log('res:', response)
            }catch (e){
                this.validated = response.data;
                Alert('error', 'formError')
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
                    percent: 50
                })
            }
        },
        onTopic(val, number) {
            this.topics = this.topics.map((e) => {
                if (e.id === val.id) {
                    e.percent = number; // Corrected the typo "percent" to "percent"
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
        },
        onDeleteTopic(topic){
            this.topics = this.topics.filter((e) => {
                if (e.id == topic.id){
                    return false;
                }
                return true;
            })
        },
        async getPharases(){
            try {
                const response = await phrases();
                this.phrasesArr = response.data;
            }catch (e){
                useConterStore().sendError(this, e);
            }
        },
        async getWord(){
            try {
                const response = await wordShow(this.$route.query.id);
                let word = response.data;
                this.phrase_id = word.phrase.id;
                this.text = word.text;
                this.topics = response.data.topics;
            }catch (e){
                useConterStore().sendError(this, e);
            }
        }

    },
    mounted() {
        this.getPharases()
        this.getWord()
    }
}

</script>
