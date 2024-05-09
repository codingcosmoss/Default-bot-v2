<template>
    <Page Title="So'zlar">
        <div class="row">

            <BorderedTable Title="" Desc=""  @onCreate="this.$router.push('/admin/word/create')" @search="search($event)" >

                <div class="table-responsive">
                    <table class="table table-bordered mb-0">

                        <thead  >
                        <tr>
                            <th>#</th>
                            <th style="min-width: 200px">So'z</th>
                            <th>Turi</th>
                            <th>Sozlamalar</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr v-for="(item, index) in items">
                            <th scope="row">{{index+1}}</th>
                            <td>{{item.name}}</td>
                            <td>{{ item.words }}</td>
                            <td>

                                <button type="button" class="btn btn-primary waves-effect waves-light setting_btn" data-bs-toggle="modal" data-bs-target="#update" @click="this.$router.push({path:'/admin/word/update', query:{id: item.id}})">
                                    <i class="bx bx-edit-alt"></i>
                                </button>
                                &nbsp;
                                <button v-if="item.words == 0" type="button" class="btn btn-danger waves-effect waves-light setting_btn"  @click="model=item" data-bs-toggle="modal" data-bs-target="#delete" >
                                    <i class="bx bx-trash-alt"></i>
                                </button>

                            </td>
                        </tr>

                        </tbody>

                    </table>
                   <Loader v-if="loader" />
                    <Paginate>
                        <vue-awesome-paginate
                            :total-items="last_page"
                            :items-per-page="1"
                            :max-pages-shown="1"
                            v-model="currentPage"
                            :on-click="onClickHandler"
                        />
                    </Paginate>
                </div>
            </BorderedTable>



        </div>

        <ConfirmModal Id="delete" Title="O'chirish" @onModal="destroy()" >
            "{{model.name}}" mavzusini o'chirib tashlashni hohlaysizmi ?
        </ConfirmModal>

    </Page>
</template>
<script>
    import Paginate from '../../../ui-components/Items/Paginate/paginate.vue'
    import Page from "@/components/Layout/Page.vue";
    import {useConterStore} from "@/store/counter.js";
    import BorderedTable from "@/ui-components/Tables/BorderedTable.vue";
    import {words, wordSearch, wordShow} from "../../../Api.js";
    import StaticBackdropModal from "@/ui-components/Modals/StaticBackdropModal.vue";
    import Create from './create.vue';
    import Updated from './update.vue';
    import ConfirmModal from "@/ui-components/Modals/ConfirmModal.vue";
    import {Alert} from "@/Config.js";
    import Loader from "@/ui-components/Items/Loader.vue";
    export default {
        components:{Loader, ConfirmModal, StaticBackdropModal, BorderedTable, Page, Create, Paginate, Updated},
        data(){return{
            model: [],
            items: [],
            last_page: 0,
            currentPage: 1,
            paginate: 0,
            loader: true

        }},
        methods:{
            async index(){
                try {

                    const response = await words(this.currentPage , 10);
                    this.items = response.data.items;
                    this.last_page = response.data.pagination.last_page;
                    this.current_page = response.data.pagination.currentPage;
                }catch (e){
                    useConterStore().sendError(this,e);
                }
                this.loader = false;
            },
            async destroy(){
                try {
                    const response = await wordDelete(this.model.id);
                    if (response.status){
                        Alert('success','delete');
                        this.index()
                    }
                }catch (e){
                    useConterStore().sendError(this,e);
                }
            },
            async search(val){
                try {
                    var data = {
                        'search': val,
                        'paginate': 10
                    }
                    const response = await wordSearch(data);
                    this.items = response.data.items;
                }catch (e){
                    useConterStore().sendError(this,e);
                }
                this.loader = false;
            },
            onModal(val){
                this.modalId = val;
            },
            onClickHandler(id){
                this.paginate = id;
                this.currentPage = id;
                this.index();
            },
        },
        mounted(){
            this.index()
        }
    }
</script>
