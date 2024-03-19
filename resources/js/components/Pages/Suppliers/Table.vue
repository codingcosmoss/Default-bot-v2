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

                <div v-for="(item, index) in items" class="grid grid-cols-5 border-b border-stroke dark:border-strokedark sm:grid-cols-5 databes_table">

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
                            (not fount)
                        </p>
                    </div>

                    <div class="flex items-center justify-center p-2.5 xl:p-5">
                        <p   class="font-medium text-black dark:text-white">
                            (not fount)
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


    <ModalLayout @Submit = "CRUD()" :isModal = "isModal" @closeModal = " closeModal() " :Title = " crud == 'created' ? getName('create') :getName('update')" >


        <Input
            :Label = "getName('name_content')"
            @onInput = "Name = $event"
            :isError = "hasKey('name')"
            :message = "errorObj['name']"
            :Value = "Name"
        />

        <Input
            :Label = "getName('Bin')"
            @onInput = "Bin = $event"
            :isError = "hasKey('bin')"
            :message = "errorObj['bin']"
            :Value = "Bin"
        />

        <Input
            :Label = "getName('phone')"
            @onInput = "Phone = $event"
            :isError = "hasKey('phone')"
            :message = "errorObj['phone']"
            :Value = "Phone"
        />

        <Input
            :Label = "getName('Email')"
            @onInput = "Email = $event"
            :isError = "hasKey('email')"
            :message = "errorObj['email']"
            :Value = "Email"
        />

        <Input
            :Label = "getName('Address')"
            @onInput = "Address = $event"
            :isError = "hasKey('address')"
            :message = "errorObj['address']"
            :Value = "Address"
        />

        <Input
            :Label = "getName('ContactPerson')"
            @onInput = "ContactPerson = $event"
            :isError = "hasKey('contact_person')"
            :message = "errorObj['contact_person']"
            :Value = "ContactPerson"
        />

        <Textarea
            :Label = "getName('BankDetails')"
            @onInput = "BankDetails = $event"
            :isError = "hasKey('bank_details')"
            :message = "errorObj['bank_details']"
            :Value = "BankDetails"
        />


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
    supplierCreate,
    supplierDelete,
    supplierShow,
    suppliers, supplierSearch, supplierUpdate
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
import Textarea from "@/ui-components/Form/Textarea.vue";
export default {
    components: {
        Textarea,
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
            Name: '',
            errorObj: {},
            crud: '',
            Suppliers: [],
            Bin: '',
            Phone: '',
            Email: '',
            Address: '',
            ContactPerson: '',
            BankDetails: '',

        }
    },

    methods:{

        router() {
            return router
        },

        closeModal(){
            this.cleaningVarables()
            this.isModal = false;
            this.isError = [];
            this.Summ = 0;
        },

        onClickHandler(id){

            this.paginate = id;
            this.currentPage = id;
            this.getItems();
        },
        onModal(id){
            if (id == null){
                this.crud = 'created';
                this.Name = '';
            }else {
                this.crud = '';
                this.UpdatedId = id;
                this.getModel();
            }
            this.errorObj = {};
            this.isModal = true;

        },
        async getModel(){
            const response = await supplierShow(this.UpdatedId);
            this.Name =  response.data.name;
            this.Bin =  response.data.bin;
            this.Phone =  response.data.phone;
            this.Email =  response.data.email;
            this.Address =  response.data.address;
            this.ContactPerson =  response.data.contact_person;
            this.BankDetails =  response.data.bank_details;
        },
        onUpdateModal(id){
            this.UpdatedId = id;
            this.isUpdateModal = true;
        },

        hasKey(key) {
            return key in this.errorObj;
        },
        async CRUD(){


            var data = {
                'name': this.Name,
                'bin': this.Bin,
                'phone': this.Phone,
                'email': this.Email,
                'address': this.Address,
                'contact_person': this.ContactPerson,
                'bank_details': this.BankDetails
            }

            var response = '';
            if(this.crud == 'created'){
                response = await supplierCreate(data);

            }else {
                response = await supplierUpdate( this.UpdatedId, data);
            }
            if (response.status){
                this.cleaningVarables()
                this.closeModal();
                this.isModal = false;
                this.getItems();

                Alert('success', 'Created successfully !')
            }else {
                this.errorObj = response.data;
                console.log(response)
            }
        },

        cleaningVarables(){
            this.Name = '';
            this.Bin = '';
            this.Phone = '';
            this.Email = '';
            this.Address = '';
            this.ContactPerson = '';
            this.BankDetails = '';
        },

        getName(val){
            return useConterStore().getName(val)
        },
        openModal(){
            const modal = document.querySelector('.modal');
            modal.classList.remove('hidden')
        },

        async getItems(){
            const response = await suppliers(this.currentPage, this.paginateCount);
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
                const response = await supplierSearch(data);
                console.log(response)
                this.items = response.data.items;
            }else {
                this.getItems()
            }



        },
        async onDelete(val){
            var message = 'Вы уверены, что хотите это удалить?'
            if (confirm(message)){
                const response = await supplierDelete(val);
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
