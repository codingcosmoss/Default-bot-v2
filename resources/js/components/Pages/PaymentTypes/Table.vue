<template >
    <div class="col-span-12 xl:col-span-12">
        <div
            class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
            <h4 class="mb-6 text-xl font-bold text-black dark:text-white">
                {{getName('PaymentTypes')}}
            </h4>

            <div class="flex flex-col table_media_box">


                <div class="grid grid-cols-3 rounded-sm mb-2 sm:grid-cols-5 relative media_top_bar">

                    <div >

                        <input type="text" placeholder="Search" @input = "clickSearch($event.target.value, order)"
                               class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"  />
                    </div>

                    <div>
                        <select  placeholder="Search" @input = "column = $event.target.value"
                                class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary ml-4"  >

                            <option value="id">Id</option>
                            <option value="name">{{getName('name')}}</option>

                        </select>

                    </div>

                    <div class="ml-4 flex btn01">

                        <svg @click = "clickSearch(search, 'asc')" :title = "getName('growth')" :class="order == 'asc' ?  'active' : '' " xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M6 17.59L7.41 19L12 14.42L16.59 19L18 17.59l-6-6z"/><path fill="currentColor" d="m6 11l1.41 1.41L12 7.83l4.59 4.58L18 11l-6-6z"/></svg>

                        <svg @click = "clickSearch(search, 'desc')" :class="order == 'desc' ?  'active' : '' " :title="getName('decrease')" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M18 6.41L16.59 5L12 9.58L7.41 5L6 6.41l6 6z"/><path fill="currentColor" d="m18 13l-1.41-1.41L12 16.17l-4.59-4.58L6 13l6 6z"/></svg>

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
                        <a @click = "onModal(null)"
                           class=" cursor-pointer inline-flex items-center justify-center rounded-md bg-primary py-3 px-10 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10">
                            {{getName('create')}}
                        </a>

                    </div>

                </div>

                <TableHeader></TableHeader>

                <div v-for="(item, index) in items" class="grid grid-cols-5 border-b border-stroke dark:border-strokedark sm:grid-cols-5 databes_table">

                    <div class="flex items-center gap-3 p-2.5 xl:p-5">

                        <p class="font-medium  text-black dark:text-white sm:block">{{index+1}}.  {{item.name}}</p>
                    </div>

                    <div class="flex items-center justify-center p-2.5 sm:flex xl:p-5">
                        <p class="font-medium text-black dark:text-white">
                            <div style="width: 40px; height: 20px; " :style = " 'background:'+item.color +'' " >
                            </div>
                        </p>
                    </div>

                    <div class="flex items-center justify-center p-2.5 xl:p-5">
                        <p class="font-medium text-black dark:text-white">{{item.created_at}}</p>
                    </div>

                    <div class="flex items-center justify-center p-2.5 xl:p-5">
                        <p class="font-medium text-black dark:text-white">{{item.updated_at}}</p>
                    </div>






                    <div class="flex items-center justify-center p-2.5 sm:flex xl:p-5">
                        <p class="font-medium text-meta-5">

                            <i @click = "onModal(item.id)" class="fa-solid setting-icon fa-pen-to-square"></i>
                            &nbsp;
<!--                            <i @click = "this.$router.push({ path: '/employees/show', query: { id: item.id } })" class="fa-solid setting-icon fa-eye"></i>-->
<!--                            &nbsp;-->
                            <i @click = "onDelete(item.id)" class="fa-solid text-danger fa-trash setting-icon"></i>
                        </p>
                    </div>

                </div>

                <Loader v-if="items.length == 0  && search == '' " ></Loader>

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


    <ModalLayout @onButton = "crudPatient()" :isModal = "isModal" @closeModal = "isModal = false" :Title = " crud == 'created' ? getName('create') :getName('update')" >


        <Input
            :Label = "getName('name_content')"
            @onInput = "name = $event"
            :isError = "hasKey('name')"
            :message = "errorObj['name']"
            :Value = "name"
        />
        <InputColor
            Type = "color"
            :Couple = "false"
            :Label = "getName('color')"
            @onInput = "color = $event"
            :isError = "hasKey('color')"
            :message = "errorObj['color']"
            :Value = "color"
        />
        <Switch
            :isSwitch="status == 1 ? true : false"
            @onClick = "status = $event"

        />


    </ModalLayout>



</template>
<script >
import {useConterStore} from "../../../store/counter.js";
import TableHeader from "./Table-header.vue";
import router from "../../../router/index.js";
import Switch from "../../../ui-components/Element/Switch.vue";
import {
    PaymentTypes,
    paymentTypessSearch,
    paymentTypesUpdate,
    paymentTypesDelete,
    paymentTypesShow,
    paymentTypesCreate,
} from "../../../Api.js";
import PaginateBtn from "./Paginate/paginate-btn.vue";
import {VueAwesomePaginate} from "vue-awesome-paginate";
import {Alert} from "../../../Config.js";
import Input from "../../../ui-components/Form/Input.vue";
import InputDefault from '../../../ui-components/Form/InputDefault.vue';
import ModalLayout from "../../../ui-components/Element/Modal01/ModalLayout.vue";
import Select from "../Services/Create/Inputs/Select.vue";
import InputColor from "../Employees/Update/Inputs/InputColor.vue";
import Paginate from "../../../ui-components/Element/Paginate/paginate.vue";
import Loader from "@/ui-components/Element/Loader.vue";
export default {
    components: {
        Loader,
        Paginate,
        Input,
        Switch,
        InputColor,
        Select,
        ModalLayout, VueAwesomePaginate,InputDefault, PaginateBtn, TableHeader},
    data(){
        return{
            items: [],
            search: '',
            column: 'updated_at',
            order: 'asc',
            paginateCount: 10,
            pagination: {},
            last_page: 0,
            currentPage: 1,
            ExitModal: false,
            errorObj: {},
            isModal: false,
            crud:'',
            // input varables
            name: '',
            color: '#000000',
            status: true,



        }
    },

    methods:{
        router() {
            return router
        },
        onModal(id){
            if (id == null){
                this.crud = 'created';
                this.name = '';
                this.status = false;
            }else {
                this.crud = '';
                this.UpdatedId = id;
                this.getModel();
            }
            this.errorObj = {};
            this.isModal = true;

        },
        async getModel(){

            const response = await paymentTypesShow(this.UpdatedId);
            this.name = response.data.name;
            this.color = response.data.color;
            this.status = response.data.status ;

        },

        async crudPatient(){

            var data = {
                'name': this.name,
                'color': this.color,
                'status': this.status

            }

            var response = '';
            if(this.crud == 'created'){
                response = await paymentTypesCreate(data);

            }else {
                response = await paymentTypesUpdate( this.UpdatedId, data);
            }
            console.log(response);
            if (response.status){
                this.name = '';
                this.color = '#000000';
                this.UpdatedId = null;
                this.isModal = false;
                this.getItems();
                Alert('success', 'Created successfully !')
            }else {
                this.errorObj = response.data;
            }
        },

        onClickHandler(id){

            this.paginate = id;
            this.currentPage = id;
            this.getItems();
        },


        getName(val){
            return useConterStore().getName(val)
        },



        async getItems(){
            const response = await PaymentTypes(this.currentPage, this.paginateCount);
            this.pagination =  response.data.pagination;
            this.last_page = response.data.pagination.last_page;
            this.current_page = response.data.pagination.currentPage;
            this.items = response.data.items;
        },

        async clickSearch(val, order){
            this.search = val;
            this.order = order;
            var data = {
                'search': this.search,
                'order' : this.order,
                'column': this.column,
                'paginate': this.paginateCount
            }
            const response = await paymentTypessSearch(data);
            this.items = response.data.items;


        },
        async onDelete(val){
            var message = 'Вы уверены, что хотите это удалить?'
            if (confirm(message)){
                const response = await paymentTypesDelete(val);
                if(response.status == true){
                    Alert('success', 'Deleted successfully !')
                    this.getItems();
                };
            }

        },

        onSearch(val){
            this.order = val;
            this.search();
        },
        onPaginate(e){
          this.paginateCount = e;
          this.getItems();
        },
        hasKey(key) {
            return key in this.errorObj;
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
        color: #ffffff !important;
        /* border: 2px solid  #10B981; */
        border-radius: 50%;

    }
    .inactive{
        background: #e70909bf !important;
        color: #ffffff !important;
        /* border: 2px solid #e70909bf; */

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


</style>
