<template>
  <div class="col-span-12 xl:col-span-12">
    <div
      class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1"
    >
      <h4 class="mb-6 text-xl font-bold text-black dark:text-white">
        {{ getName("Products") }}
      </h4>

      <div class="flex flex-col table_media_box">

        <div v-if="Header" class="grid grid-cols-3 rounded-sm mb-2 sm:grid-cols-5 relative media_top_bar">
          <div>
            <input
              type="text"
              placeholder="Search"
              @input="clickSearch($event.target.value, order)"
              class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
            />
          </div>

          <div>
            <select
              placeholder="Search"
              @input="column = $event.target.value"
              class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary ml-4"
            >
              <option selected value="sort_order">{{ getName("serial_number") }}</option>
              <option value="id">Id</option>
              <option value="start">{{ getName("TreatmentStarted_at") }}</option>
                <option value="first_name">{{ getName("name") }}</option>
                <option value="last_name">{{ getName("last_name") }}</option>
                <option value="status">{{ getName("New") }}</option>
              <!-- <option value="price">{{getName('price')}}</option> -->
              <option value="created_at">{{ getName("Created_at") }}</option>
              <option value="updated_at">{{ getName("Updated_at") }}</option>
            </select>
          </div>

          <div class="ml-4 flex btn01">
            <svg
              @click="clickSearch(search, 'asc')"
              :title="getName('growth')"
              :class="order == 'asc' ? 'active' : ''"
              xmlns="http://www.w3.org/2000/svg"
              width="32"
              height="32"
              viewBox="0 0 24 24"
            >
              <path
                fill="currentColor"
                d="M6 17.59L7.41 19L12 14.42L16.59 19L18 17.59l-6-6z"
              />
              <path
                fill="currentColor"
                d="m6 11l1.41 1.41L12 7.83l4.59 4.58L18 11l-6-6z"
              />
            </svg>

            <svg
              @click="clickSearch(search, 'desc')"
              :class="order == 'desc' ? 'active' : ''"
              :title="getName('decrease')"
              xmlns="http://www.w3.org/2000/svg"
              width="32"
              height="32"
              viewBox="0 0 24 24"
            >
              <path fill="currentColor" d="M18 6.41L16.59 5L12 9.58L7.41 5L6 6.41l6 6z" />
              <path
                fill="currentColor"
                d="m18 13l-1.41-1.41L12 16.17l-4.59-4.58L6 13l6 6z"
              />
            </svg>
          </div>

          <div class="ml-4">
            <select
              placeholder="Search"
              @input="onPaginate($event.target.value)"
              class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary ml-4"
            >
              <option value="10">10</option>
              <option value="20">20</option>
              <option value="50">50</option>
              <option value="100">100</option>
            </select>
          </div>
        </div>

        <TableHeader></TableHeader>

        <div
          v-for="(item, index) in Products"
          class="grid tableBox2 grid-cols-7 border-b border-stroke dark:border-strokedark sm:grid-cols-7"
        >
          <div class="flex items-center gap-3 p-2.5 xl:p-5">
            <p class="font-medium  text-black dark:text-white sm:block">
              {{ index + 1 }}. {{ item.name }}
            </p>
          </div>

          <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white">{{ item.bar_code }}</p>
          </div>

        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white">{{item.size_type == 'piece' ? 'dona' : item.size_type  }}</p>
        </div>

            <div class="flex items-center justify-center p-2.5 xl:p-5">
                <Input01
                    class="type_input"
                    type = "number"
                    @input = "Products[index]['amount'] = $event.target.value, validate()"
                    :value = "item.amount"
                    :isError = "isError.indexOf(item.id) != -1"
                />


            </div>

            <div class="flex items-center justify-center p-2.5 xl:p-5">
                <Input01
                    class="type_input"
                    type = "number"
                    @input = "Products[index]['price'] = $event.target.value, validate()"
                    :value = "item.price"
                    :isError = "isError.indexOf(item.id) != -1"
                />


            </div>


            <div class="flex items-center justify-center p-2.5 xl:p-5">
              <p class="font-medium text-black dark:text-white">{{ useConterStore().formatNumber(Products[index]['price'] * Products[index]['amount'])   }} uzs</p>
          </div>


          <div class="flex items-center justify-center p-2.5 sm:flex xl:p-5">
            <p class="font-medium text-meta-5" >
                <i @click = "removeItem(item), validate()"  class="fa-solid text-danger fa-trash setting-icon"></i>

            </p>
          </div>



        </div>

          <div style="display: flex; justify-content: flex-end">
              <p  style="color: #0b7fef; margin-top: 10px;font-size: 25px">Sum: {{ useConterStore().formatNumber(Summ) }} uzs</p>

          </div>

          <p v-if="isError.length != 0" style="color: #d7123e;">There is an error</p>

          <br>



          <div style="width: 300px" class="save_button">
            <Input
                Label = ""
                Pholder = "Search product..."
                @onInput = "productSearch($event)"
                :Value = "SearchText"
            />
              <button @click = "sendData()" style="height: 50px" class="flex justify-center rounded bg-primary p-3 font-medium text-gray">
                  {{getName('Save')}}
              </button>

          </div>

          <table class="table_search table01" >


              <tr v-for="product in SearchPrducts" @click = "addTodo(product)" >
                  <td>{{product.name}}</td>
                  <td>{{product.price_format}} uzs</td>
                  <td>{{product.size_type}}</td>
              </tr>

          </table>




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
</template>
<script>
import {useConterStore} from "@/store/counter.js";
import TableHeader from "./Table-header.vue";
import PaginateBtn from "@/components/Pages/Groups/Paginate/paginate-btn.vue";
import { VueAwesomePaginate } from "vue-awesome-paginate";
import {Alert} from "@/Config.js";
import {importedProducts, productCreate} from "@/Api.js";
import Input from "@/ui-components/Form/Input.vue";
import InputDefault from "@/ui-components/Form/InputDefault.vue";
import {products, productSearch} from "@/Api.js";
import Pagination01 from "@/ui-components/Element/pagination-01.vue";
import Paginate from "@/ui-components/Element/Paginate/paginate.vue";
import Table from "@/components/Pages/Diseases/Table.vue";
import Input01 from "@/ui-components/Form/Input01.vue";
export default {
  components: {
      Input01,
      Paginate,
      Pagination01,
      Table,
    Input,
    VueAwesomePaginate,
    PaginateBtn,
    TableHeader,
  },
    setup(){
      return {useConterStore}
    },
  props:{
      Treatments:{
          type: [Array, Object],
          default: []
      },
      Header:{
          type: Boolean,
          default: true
      }
  }  ,
  data() {
    return {
      items: [],
      search: "",
      column: "updated_at",
      order: "asc",
      paginateCount: 10,
      pagination: {},
      last_page: 0,
      currentPage: 1,
      password_1: ".",
      password_2: "",
      isPasswordError: false,
      ExitModal: false,
      isModal: false,
      Duration: 0,
      service_id: "",
      isShowModal: false,
      errorObj: [],
      UpdateId: 0,
      crud: "",
      Employees: [],
      Employee_id: 0,
      DateTime: "",
      TextData: '',
      Time: "0",
      patient_id: 0,
        SearchPrducts: '',
        Products: [],
        SearchText: '',
        Summ: 0,
        isError:'',
        categoryName: '',
        price: ''
    };
  },

  methods: {
    router() {
      return router;
    },
      removeItem(data){
          this.Products = this.Products.filter((product) => product.id != data.id);
      },
      validate(){
          this.isError = [];
          this.Summ = 0;
          this.Products.forEach((item) => {
              // item.amount ni stringga aylantiramiz
              let amountString = item.amount.toString();
              let priceString = item.price.toString();
              if (amountString.indexOf("e") != -1 || amountString.length == 0 || priceString.indexOf("e") != -1 || priceString.length == 0) {
                  this.isError.push(item.id);
              } else if (parseInt(amountString) < 0 || amountString.slice(0, 1) == "0" || parseInt(priceString) < 0 || priceString.slice(0, 1) == "0") {
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

      async sendData(){
          if (this.validate() && this.Products.length != 0){

                var data = {
                    id: this.$route.query.id,
                    products: this.Products,
                }
              console.log('Products', this.Products)

                const response = await importedProducts(data);
              console.log(response)
              if (response.status){
                  Alert('success', 'Save successfully !')
                  this.$emit('Created', true);
              }else {
                  this.errorObj = response.data;
              }

          }else{
              Alert('error', 'There is an error in the form')
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
                  product_document_id: this.$route.query.id,
                  name: data.name,
                  amount: 1,
                  price: data.price,
                  bar_code: data.bar_code,
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

    Show(id) {
      this.UpdateId = id;
      this.isShowModal = true;
    },
    onClickHandler(id) {
      this.paginate = id;
      this.currentPage = id;
      this.getItems();
    },


    getName(val) {
      return useConterStore().getName(val);
    },

    async getModel() {
      // const response = await patientShow(this.$route.query.id);
    },

    async clickSearch(val, order) {
      this.search = val;
      this.order = order;
      var data = {
        search: this.search,
        order: this.order,
        column: this.column,
        paginate: this.paginateCount,
      };

      // const response = await treatmentSearch(data);
      //   this.items = response.data.items;

    },
    // async onDelete(val) {
    //   var message = "Вы уверены, что хотите это удалить?";
    //   if (confirm(message)) {
    //     const response = await patientDelete(val);
    //     if (response.status == true) {
    //       Alert("success", "Deleted successfully !");
    //       this.getItems();
    //     }
    //   }
    // },
    hasKey(key) {
      return this.errorObj.hasOwnProperty(key);
    },

    onSearch(val) {
      this.order = val;
      this.clickSearch();
    },

    onPaginate(e) {
      this.paginateCount = e;
      this.getItems();
    },
      hasPermission(){
          let permissions = localStorage.getItem('permissions').split(',');
          if (!permissions.includes('Warehouse-update') ){
              this.$router.go(-1);
      }
  },
  },
  mounted() {
      this.hasPermission()
    // this.getItems();
  },
};
</script>
<style lang="scss">
.fa-solid {
  cursor: pointer;
}

.btn01 {
  width: 100px;
  margin-left: 100px;
  background: rgba(0, 0, 0, 0.12);
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 10px;
}
.btn01 svg {
  background: rgba(46, 58, 71, 0.07);
  border: 1px solid rgba(245, 245, 245, 0.33);
  margin: 0 10px;
  border-radius: 10px;
  color: white;
  cursor: pointer;
}
.btn01 svg:active {
  transform: scale(0.9);
}
.active {
  background: #10b981 !important;
  //color: #2E3A47 !important;
}
.table01 tr:hover{
    background: rgba(60, 80, 224, 0.22);
}
.table01 tr{
    cursor: pointer;
}
.table01 tr:active{
    background: rgba(60, 224, 82, 0);
}
.photo-img {
  width: 50px;
  height: 50px;
  margin-right: 10px;
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

.inactive {
  background: #f71010;
}
.status-text{
    background: #39aa07;
    padding: 3px 8px ;
    border-radius: 10px;
    font-weight: bold;
    color: white;
}
.unmount{
    background: #f71010 !important;
}
.fullUnmount{
    background: #b9a505 !important;
}
.save_button{
    display: flex;
    justify-content: space-between;
    width: 100% !important;
}
//.bottomTable{
//    transition: 1s;
//    background: #3C50E0;
//    overflow: hidden;
//    height: 0px;
//    padding: 0px;
//}
//.tableBox:hover{
//    transition: 1s !important;
//    .bottomTable{
//        transition: 1s !important;
//        height: 100%;
//    }
//}

</style>
