<template>
  <div class="col-span-12 xl:col-span-12">
    <div
      class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1"
    >
      <h4 class="mb-6 text-xl font-bold text-black dark:text-white">
        {{ getName("Products") }}
      </h4>

      <div class="flex flex-col">

        <TableHeader></TableHeader>

        <div
          v-for="(item, index) in Products"
          class="grid tableBox grid-cols-6 border-b border-stroke dark:border-strokedark sm:grid-cols-6"
        >
          <div class="flex items-center gap-3 p-2.5 xl:p-5">
            <p class="font-medium hidden text-black dark:text-white sm:block">
              {{ index + 1 }}. {{ item.name }}
            </p>
          </div>

          <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white">{{ item.bar_code }} </p>
          </div>

        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white">{{item.size_type == 'piece' ? 'dona' : item.size_type  }}</p>
        </div>

        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white">{{ useConterStore().formatNumber(item.amount)   }}</p>
        </div>
        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white">{{ useConterStore().formatNumber(item.price)  }} uzs </p>
        </div>

            <div class="flex items-center justify-center p-2.5 xl:p-5">
              <p class="font-medium text-black dark:text-white">{{useConterStore().formatNumber( Number(item.price) * Number(item.amount))   }} uzs</p>
          </div>






        </div>

          <div style="display: flex; justify-content: flex-end">
              <p  style="color: #0b7fef; margin-top: 10px;font-size: 25px">Sum:  {{useConterStore().formatNumber(Summ) }} uzs</p>

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
</template>
<script>
import {useConterStore} from "@/store/counter.js";
import TableHeader from "./Table-header2.vue";
import PaginateBtn from "@/components/Pages/Groups/Paginate/paginate-btn.vue";
import { VueAwesomePaginate } from "vue-awesome-paginate";
import {Alert} from "@/Config.js";
import {getDocumentProducts} from "@/Api.js";
import Input from "@/ui-components/Form/Input.vue";
import InputDefault from "@/ui-components/Form/InputDefault.vue";
import {products, productSearch} from "@/Api.js";
import Pagination01 from "@/ui-components/Element/pagination-01.vue";
import Paginate from "@/ui-components/Element/Paginate/paginate.vue";
import Table from "@/components/Pages/Diseases/Table.vue";
import Input01 from "@/ui-components/Form/Input01.vue";
import {holdNextTicks} from "alpinejs/src/nextTick.js";
export default {
    setup(){
        return{useConterStore}
    },
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



      async getDocumentProducts(){
          const response = await getDocumentProducts(this.$route.query.id);
          this.Products = response.data.items;
          console.log('Response;', response);
          this.Products.forEach((e) => {
              this.Summ += Number(e.price) * Number(e.amount);
          })
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
  },
  mounted() {
    // this.getItems();
      this.getDocumentProducts()
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
  color: #2e3a47 !important;
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
    font-size: 13px;
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
