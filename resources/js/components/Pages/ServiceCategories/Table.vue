<template >
    <div class="col-span-12 xl:col-span-12">
        <div
            class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
            <h4 class="mb-6 text-xl font-bold text-black dark:text-white">
                {{getName('service_types')}}

            </h4>

            <div class="flex flex-col">


                <div class="grid grid-cols-3 rounded-sm mb-2 sm:grid-cols-5 relative">

                    <div >

                        <input type="text" placeholder="Search" @input = "clickSearch($event.target.value, order)"
                               class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"  />
                    </div>



                    <div class="ml-4">
                        <select placeholder="Search" @input = "onPaginate($event.target.value)"
                                class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary ml-4"  >

                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>

                        </select>

                    </div>

                    <div class="flex flex-wrap gap-5 xl:gap-20" style="position: absolute; right: 0px; top: 0">
                        <span @click = "onModal(null)"
                           class=" cursor-pointer inline-flex items-center justify-center rounded-md bg-primary py-3 px-10 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10">
                            {{getName('create')}}
                        </span>

                    </div>


                </div>

                <TableHeader></TableHeader>

                <div v-for="(item, index) in items" class="grid grid-cols-5 border-b border-stroke dark:border-strokedark sm:grid-cols-5">

                    <div class="flex   justify-content-end gap-3 p-2.5 xl:p-5">
                        <p class="font-medium hidden text-black dark:text-white sm:block">{{index+1}}.  {{item.name}}</p>
                    </div>

                    <div class="flex items-center justify-center p-2.5 xl:p-5">
                        <p class="font-medium text-black dark:text-white"> {{getName('serial_number')}}</p>
                    </div>


                    <div class="flex items-center justify-center p-2.5 xl:p-5">
                        <div  class="status_box" :class="item.status == 1 ? 'active' : 'inactive' ">
                            {{item.status ? 'active' : 'inactive' }}
                        </div>
                    </div>

                    <div class="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
                        <p class="font-medium text-meta-5">
                            <i @click = "onModal(item.id)" class="fa-solid setting-icon fa-pen-to-square"></i>
                            &nbsp;
                            <i @click = "this.$router.push({ path: '/service-category/show', query: { id: item.id } })" class="fa-solid setting-icon fa-eye"></i>
                            &nbsp;
                            &nbsp;
                            <i @click = "onDelete(item.id)" class="fa-solid text-danger fa-trash setting-icon"></i>
                        </p>
                    </div>

                </div>


                <Paginate>
                    <Pagination01>
                        <vue-awesome-paginate
                            :total-items="last_page"
                            :items-per-page="1"
                            :max-pages-shown="1"
                            v-model="currentPage"
                            :on-click="onClickHandler"
                        />
                    </Pagination01>
                </Paginate>

            </div>


        </div>
    </div>

    <ModalLayout @Submit = "crudCategory()" :isModal = "isModal" @closeModal = "isModal = false" :Title = " crud == 'created' ? getName('create') :getName('update')" >


        <Input
            :Label = "getName('name_content')"
            @onInput = "categoryName = $event"
            :isError = "hasKey('name')"
            :message = "errorObj['name']"
            :Value = "categoryName"
        />


        <Select
            :Label = "getName('status')"
            @onSelect = "status = $event"
        >

            <option
                :selected = "status == 1"
                :value="1"
            > Active</option>
            <option
                :selected = "status != 1"
                :value="0"
            > Inactive</option>

        </Select>

    </ModalLayout>


</template>
<script >
import {useConterStore} from "../../../store/counter.js";
import TableHeader from "./Table-header.vue";
import router from "../../../router/index.js";
import Paginate from "./Paginate/paginate.vue";
import PaginateBtn from "./Paginate/paginate-btn.vue";
import {VueAwesomePaginate} from "vue-awesome-paginate";
import {Alert} from "../../../Config.js";
import InputDefault from '../../../ui-components/Form/InputDefault.vue';
import Pagination01 from "../../../ui-components/Element/pagination-01.vue";
import ModalLayout from "../../../ui-components/Element/Modal01/ModalLayout.vue";
//
import {
    service_categorys,
    service_categorySearch,
    service_categoryDelete,
    service_categoryCreate, service_categoryUpdate, service_categoryShow
} from "../../../Api.js"
import CreateForm from "./Create/CreateForm.vue";
import UpdateForm from "./Update/UpdateForm.vue";
import Input from "../Employees/Update/Inputs/Input.vue";
import Select from "../Services/Create/Inputs/Select.vue";
export default {
    components: {
        Select,
        Input,
        CreateForm,
        ModalLayout, Pagination01, UpdateForm, VueAwesomePaginate,InputDefault, PaginateBtn, Paginate, TableHeader},
    data(){
        return{
            items: [],
            search: '',
            column: 'name',
            order: 'asc',
            paginateCount: 10,
            pagination: {},
            last_page: 0,
            currentPage: 1,
            UpdatedId: 0,
            isModal: false,
            ExitModal: false,
            status: 1,
            categoryName: '',
            errorObj: {},
            crud: ''
        }
    },

    methods:{
        router() {
            return router
        },

        onClickHandler(id){

            this.paginate = id;
            this.currentPage = id;
            this.getItems();
        },
        onModal(id){
            if (id == null){
                this.crud = 'created';
                this.categoryName = '';
            }else {
                this.crud = '';
                this.UpdatedId = id;
                this.getModel();
            }
            this.errorObj = {};
            this.isModal = true;

        },
        async getModel(){
            const response = await service_categoryShow(this.UpdatedId);
            this.categoryName = response.data.name;
            this.status = response.data.status;
        },
        onUpdateModal(id){
            this.UpdatedId = id;
            this.isUpdateModal = true;
        },

        hasKey(key) {
            return key in this.errorObj;
        },
        async crudCategory(){
            var data = {
                'name': this.categoryName,
                'status': this.status,
            }
            var response = '';
            if(this.crud == 'created'){
                response = await service_categoryCreate(data);

            }else {
                response = await service_categoryUpdate( this.UpdatedId, data);
            }
            console.log(response)
            if (response.status){
                this.categoryName = '';
                this.status = 1;
                this.UpdatedId = null;
                this.isModal = false;
                this.getItems();
                Alert('success', 'Created successfully !')
            }else {
                this.errorObj = response.data;
            }
        },

        getName(val){
            return useConterStore().getName(val)
        },
        openModal(){
            const modal = document.querySelector('.modal');
            modal.classList.remove('hidden')
        },

        async getItems(){
            const response = await service_categorys(this.currentPage, this.paginateCount);
            this.pagination =  response.data.pagination;
            this.last_page = response.data.pagination.last_page;
            this.current_page = response.data.pagination.currentPage;
            this.items = response.data.items;
        },

        async clickSearch(val, order){
            this.search = val;
            this.order = order;
            if (val != ''){
                var data = {
                    'search': this.search,
                    'order' : this.order,
                    'column': this.column,
                    'paginate': this.paginateCount
                }
                const response = await service_categorySearch(data);
                console.log(response)
                this.items = response.data.items;
            }else {
                this.getItems()
            }



        },
        async onDelete(val){
            var message = 'Вы уверены, что хотите это удалить?'
            if (confirm(message)){
                const response = await service_categoryDelete(val);
                if(response.status == true){
                    Alert('success', 'Deleted successfully !')
                    this.getItems();
                };
            }

        },


        onPaginate(e){
          this.paginateCount = e;
          this.getItems();
        }

    },
    mounted() {
        this.getItems()
    }
}
</script>
<style >
    .fa-solid{cursor: pointer}

    .btn01{
        width: 100px;
        margin-left: 100px;
        background: rgba(0, 0, 0, 0.12);
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 10px;

    }
    .btn01 svg{
        background: rgba(46, 58, 71, 0.07);
        border: 1px solid rgba(245, 245, 245, 0.33);
        margin: 0 10px;
        border-radius: 10px;
        color: white;
        cursor: pointer;
    }
    .btn01 svg:active{
        transform: scale(0.9);
    }
    .active{
        background: #10B981 !important;
        color: white;

    }
    .photo-img{
        width: 50px;
        height: 50px;
        margin-right:10px ;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }


    .pagination-container {
        display: flex;
        column-gap: 10px;
    }
    .paginate-buttons {
        height: 40px;
        width: 40px;
        border-radius: 20px;
        cursor: pointer;
        background-color: rgba(242, 242, 242, 0);
        border: 1px solid rgb(4, 237, 109);
        color: #17e30d;
        margin: 0 5px;
    }
    .paginate-buttons:hover {
        background-color: #d8d8d8;
    }
    .active-page {
        background-color: #3498db;
        border: 1px solid #3498db;
        color: white;
    }
    .active-page:hover {
        background-color: #2988c8;
    }

    .inactive{
        background: rgba(247, 16, 16, 0.71);
        color: white;
    }


</style>
