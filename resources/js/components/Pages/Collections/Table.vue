<template >
    <div class="col-span-12 xl:col-span-12">
        <div
            class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
            <WarehouseTopbar></WarehouseTopbar>
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

                <div v-for="(item, index) in items" class="databes_table grid grid-cols-5 border-b border-stroke dark:border-strokedark sm:grid-cols-5 databes_table">

                    <div class="flex   justify-content-end gap-3 p-2.5 xl:p-5">
                        {{index+1}}.
                        <p class="font-bold hidden text-black dark:text-white sm:block cursor-pointer"  style="color: #0a91f1" >  {{item.name}}</p>
                    </div>

<!--                    <div class="flex items-center justify-center p-2.5 xl:p-5">-->
<!--                        <p   class="font-medium text-black dark:text-white">-->
<!--                            {{ item.warehouses }}-->
<!--                         </p>-->
<!--                    </div>-->

                    <div class="flex items-center justify-center p-2.5 xl:p-5">
                        <p   class="font-medium text-black dark:text-white">

                            {{counterStore.formatNumber(item.summ)}} uzs

                        </p>
                    </div>

                    <div class="flex items-center justify-center p-2.5 xl:p-5">
                        <p   class="font-medium text-black dark:text-white">
                            {{item.created_at }}
                        </p>
                    </div>



                    <div class="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
                        <p class="font-medium text-meta-5">
                            <i @click = "onModal(item.id)" class="fa-solid setting-icon fa-pen-to-square"></i>
                            &nbsp;
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


    <ModalLayout @onButton = "crudCategory()" :isModal = "isModal" @closeModal = " closeModal() " :Title = " crud == 'created' ? getName('create') :getName('update')" >


        <Input
            :Label = "getName('name_content')"
            @onInput = "categoryName = $event"
            :isError = "hasKey('name')"
            :message = "errorObj['name']"
            :Value = "categoryName"
        />



        <table class="table01 " >

            <tr>
                <th>{{getName('name_content')}}</th>
                <th>{{getName('Amount')}}</th>
                <th>{{getName('price')}}</th>
                <th></th>

            </tr>
            <tr v-for="(product, index) in Products">
                <td>{{ product.name }}</td>
                <td>
                    <Input01
                        class="type_input"
                        type = "number"
                        @input = "Products[index]['amount'] = $event.target.value, validate()"
                        :value = "product.amount"
                        :isError = "isError.indexOf(product.id) != -1"
                    />
                    {{product.size_type == 'piece' ? 'dona' : product.size_type  }}
                </td>
                <td>{{ product.price }} uzs</td>
                <td>
                    <i @click = "removeItem(product), validate()"  class="fa-solid text-danger fa-trash setting-icon"></i>
                </td>
            </tr>
        </table>
        <div style="display: flex; justify-content: flex-end">
        <p  style="color: #0b7fef; margin-top: 10px;font-size: 25px">Sum: {{counterStore.formatNumber(Summ)}} uzs</p>

        </div>

        <p v-if="isError.length != 0" style="color: #d7123e;">There is an error</p>

        <br>
        <Input
            :Label = "getName('Search')"
            @onInput = "productSearch($event)"
            :Value = "SearchText"
        />

        <table class="table_search table01" >


            <tr v-for="product in SearchPrducts" @click = "addTodo(product)" >
                <td>{{product.name}}</td>
                <td>{{product.price_format}} uzs</td>
                <td>{{product.size_type}}</td>
            </tr>

        </table>




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
    collectionShow,
    collectionCreate,
    collectionUpdate,
    collectionSearch, collections, collectionDelete, productSearch
} from "../../../Api.js"
import CreateForm from "./Create/CreateForm.vue";
import UpdateForm from "./Update/UpdateForm.vue";
import Input from "../Employees/Update/Inputs/Input.vue";
import Select from "../Services/Create/Inputs/Select.vue";
import Switch from "../../../ui-components/Element/Switch.vue";
import Loader from "@/ui-components/Element/Loader.vue";
import WarehouseTopbar from "@/components/Pages/Warehouses/WarehouseTopbar.vue";
import Table from "@/components/Pages/Diseases/Table.vue";
import Input01 from "@/ui-components/Form/Input01.vue";
export default {
    setup(){
        const counterStore = useConterStore();
        return{counterStore}
    },
    components: {
        Input01,
        Table,
        WarehouseTopbar,
        Loader,
        Switch,
        Select,
        Input,
        CreateForm,
        ModalLayout, Pagination01, UpdateForm, VueAwesomePaginate,InputDefault, PaginateBtn, Paginate, TableHeader},
    data(){
        return{
            items: [],
            search: '',
            column: 'updated_at',
            isError: '',
            order: 'asc',
            paginateCount: 10,
            pagination: {},
            last_page: 0,
            currentPage: 1,
            UpdatedId: 0,
            isModal: false,
            ExitModal: false,
            categoryName: '',
            errorObj: {},
            crud: '',
            SearchPrducts: '',
            Products: [],
            SearchText: '',
            Summ: 0
        }
    },

    methods:{

        router() {
            return router
        },

        removeItem(data){
            this.Products = this.Products.filter((product) => product.id != data.id);
        },
        closeModal(){
            this.isModal = false;
            this.Products = [];
            this.SearchText = '';
            this.SearchPrducts = [];
            this.isError = [];
            this.Summ = 0;
        },
        validate(){
            this.isError = [];
            this.Summ = 0;
            this.Products.forEach((item) => {
                // item.amount ni stringga aylantiramiz
                let amountString = item.amount.toString();
                if (amountString.indexOf("e") != -1 || amountString.length == 0) {
                    this.isError.push(item.id);
                } else if (parseInt(amountString) < 0 || amountString.slice(0, 1) == "0") {
                    this.isError.push(item.id);
                }else {
                    this.Summ += Number(item.amount) * Number(item.price);
                }
            });
            if (this.isError.length == 0){
                return true;
            }else {
                return false;
            }
        },

        addTodo(data){
            let error = false;
            this.Products.forEach((product) => {
                if (product.id == data.id){
                    error = true;
                    return
                }
            })
            if (!error){
                this.Products.push({
                    id: data.id,
                    name: data.name,
                    amount: 0,
                    price: data.price,
                    size_type: data.size_type,
                })
            }

        },


        async productSearch(val) {
            this.SearchText = val;
            if (val.length == 0){
                this.SearchPrducts = [];
                return true;
            }
            var data = {
                search: val,
                order: 'asc',
                column: 'updated_at',
                paginate: 10,
            };
            const response = await productSearch(data);
            console.log(response)
            this.SearchPrducts = response.data.items;
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
            const response = await collectionShow(this.UpdatedId);
            this.categoryName = response.data.name;
            this.Products = [];
            this.Summ = 0;

            response.data.products.forEach((product) =>{
                this.Summ += Number(product.amount) * Number(product.price) ;
                this.Products.push({
                    id: product.product_id,
                    name: product.name,
                    amount: product.amount,
                    price: product.price,
                    size_type: product.size_type,
                })
            });
        },
        onUpdateModal(id){
            this.UpdatedId = id;
            this.isUpdateModal = true;
        },

        hasKey(key) {
            return key in this.errorObj;
        },
        async crudCategory(){

            if (!this.validate()){
                console.log("Products",this.Products)
                return false;
            }

            var data = {
                'name': this.categoryName,
                'products': this.Products,
                'product_total_sum': this.Summ
            }

            var response = '';
            if(this.crud == 'created'){
                response = await collectionCreate(data);

            }else {
                response = await collectionUpdate( this.UpdatedId, data);
            }
            if (response.status){
                this.categoryName = '';
                this.Products = [];
                this.UpdatedId = null;
                this.isModal = false;
                this.closeModal();
                this.getItems();

                Alert('success', 'Created successfully !')
            }else {
                this.errorObj = response.data;
                console.log(response)
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
            const response = await collections(this.currentPage, this.paginateCount);
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
                const response = await collectionSearch(data);
                console.log(response)
                this.items = response.data.items;
            }else {
                this.getItems()
            }



        },
        async onDelete(val){
            var message = 'Вы уверены, что хотите это удалить?'
            if (confirm(message)){
                const response = await collectionDelete(val);
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
<style lang="scss">
    .loader_box01{
        background: blue;
        width: 100%;
    }
    .fa-solid{cursor: pointer}
    .type_input{
        width: 120px;

    }

    .table_search{
        tr{
            cursor: pointer;
        }
        tr:active{
            background: #3C50E0;
        }
        td{
            border: 2px solid rgba(255, 255, 255, 0.15) !important;
        }
        th{
            border: 2px solid rgba(255, 255, 255, 0.16) !important;
        }
    }

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
