<template>
  <div class="col-span-12 xl:col-span-12">
    <div
      class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1"
    >
      <h4 class="mb-6 text-xl font-bold text-black dark:text-white">
        {{ getName("Payments") }}
      </h4>

      <div class="flex flex-col">
        <div v-if="Header" class="grid grid-cols-3 rounded-sm mb-2 sm:grid-cols-5 relative">
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
              <option value="id">Id</option>
                <option value="first_name">{{getName('name')}}</option>
                <option value="last_name">{{getName('last_name')}}</option>
            <option value="amount">{{getName('Amount')}}</option>
              <option selected value="created_at">{{ getName("Created_at") }}</option>
              <option  value="updated_at">{{ getName("Updated_at") }}</option>
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
          v-for="(item, index) in items"
          class=" databes_table grid tableBox grid-cols-7 border-b border-stroke dark:border-strokedark sm:grid-cols-7"
        >
          <div class="flex items-center gap-3 p-2.5 xl:p-5">
            <p class="font-medium hidden text-black dark:text-white sm:block">
              {{ index + 1 }}. {{ item.first_name }}
            </p>
          </div>

          <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white">{{ item.last_name }}</p>
          </div>

          <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white">{{ item.amount }}</p>
          </div>


          <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white ">{{ item.created_at}}</p>
          </div>

        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium dark:text-white status-text "
               :style=" 'background: ' + item.color "
            >{{ item.payment_type }}</p>
        </div>


          <div class="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
            <p class="font-medium text-meta-5" >
              <i
                  v
                  v-if="isIcons"
                @click="paymentModal(item)"
                class="fa-solid setting-icon fa-pen-to-square  "
              ></i>
              &nbsp;
              <i
                  v-if="isIcons"
                @click="Show(item)"
                class="fa-solid setting-icon fa-eye "
              ></i>
                <i
                    v-if="!isIcons"
                    @click="this.$router.push('/payments')"
                    class="fa-solid setting-icon  fa-right-to-bracket "
                ></i>
                &nbsp;
                &nbsp;
                <i @click = "onDelete(item.id)" class="fa-solid text-danger fa-trash setting-icon"></i>



            </p>

          </div>
        </div>

          <Loader v-if="items.length == 0  && search == '' " ></Loader>

          <h1 v-if="items.length == 0" style="margin: 15px auto" > {{getName('Payments')}} {{getName('NotFound')}}</h1>


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

        <ModalLayout  @onButton = "onSubmit()"   :UpdateId = "UpdateId"  @closeModal = "isShowModal = $event, errorObj = []" :isModal = "isShowModal">
            <div >
                <DangerButton
                    :isActive = "userPayments <= 0 ? true : false"
                    style="font-size: 20px"
                    :Title = "useConterStore().formatNumber(Number(Math.abs(userPayments))) + ' uzs' "
                />

                <Input
                    Pholder = "0"
                    Class = "format_input"
                    :Label="getName('Amount')"
                    @onInput="paymentNumberFormat($event)"
                    :isError="hasKey('amount')"
                    :message="errorObj['amount']"
                    :Value = "counterStore.formatNumber(Amount)"
                />

                <Select
                    :Label="getName('PaymentTypes')"
                    :isError="hasKey('payment_type_id')"
                    :message="errorObj['payment_type_id']"
                    @onSelect = "paymentTypeId = $event"

                >
                    <option selected >---</option>
                    <option :selected = "paymentTypeId == item['id']"  v-for="item in paymentTypes" :value="item['id']">
                        {{ item["name"] }}
                    </option>
                </Select>

            </div>

        </ModalLayout>


    </div>
  </div>
</template>
<script>
import { useConterStore } from "../../../store/counter.js";
import TableHeader from "./Table-header.vue";
import router from "../../../router/index.js";
import PaginateBtn from "./Paginate/paginate-btn.vue";
import { VueAwesomePaginate } from "vue-awesome-paginate";
import { Alert } from "../../../Config.js";
import Input from "../../../ui-components/Form/Input.vue";
import InputDefault from "../../../ui-components/Form/InputDefault.vue";
import ModalLayout from "../../../ui-components/Element/Modal01/ModalLayout.vue";
import {
    payments,
    paymentShow,
    paymentDelete,
    paymentsSearch,
    paymentUpdate, paymentCreate, PaymentTypes
} from "../../../Api.js";
import CreateForm from "../ServiceCategories/Create/CreateForm.vue";
import Pagination01 from "../../../ui-components/Element/pagination-01.vue";
import Paginate from "../../../ui-components/Element/Paginate/paginate.vue";
import InputText from "../../../ui-components/Form/InputText.vue";
import Select from "./Create/Inputs/Select.vue";
import Textarea from "../../../ui-components/Form/Textarea.vue";
import InputDateTime from "../../../ui-components/Form/InputDateTime.vue";
import InputTime from "../../../ui-components/Form/InputTime.vue";
import Table from "../Employees/Table.vue";
import ShowForm from "./Show/ShowForm.vue";
import Item from "../Employees/Calendar/Item.vue";
import Loader from "@/ui-components/Element/Loader.vue";
import DangerButton from "@/ui-components/Form/DangerButton.vue";
import Checkbox01 from "@/ui-components/Form/Checkbox/Checkbox01.vue";
export default {
    setup(){
        const counterStore = useConterStore();
        return{counterStore, useConterStore}
    },
    computed: {
        Item() {
            return Item
        }
    },

    props:{
        Payments:{
            type: [Array, Object],
            default: null
        },
        Header:{
            type: Boolean,
            default: true
        },
        isIcons:{
            type: Boolean,
            default: true
        }
    },
  components: {
      Checkbox01,
      DangerButton,
      Loader,
      ShowForm,
      Table,

    Paginate,
    InputTime,
    InputDateTime,
    Pagination01,
    CreateForm,
    Textarea,
    ModalLayout,
    Input,
    VueAwesomePaginate,
    InputDefault,
    PaginateBtn,
    TableHeader,
    InputText,
    Select,
  },
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
      isPasswordError: false,
      ExitModal: false,
      isModal: false,
      Duration: 0,
      service_id: "",
      isShowModal: false,
      errorObj: [],
      UpdateId: 0,
      crud: "",
        Model: '',
        userPayments: 0,
        Amount: '',
        paymentType: 0,
        paymentTypes: [],
        paymentTypeId: 0
    };
  },

  methods: {
    router() {
      return router;
    },
      paymentNumberFormat(val){
          const format_input = document.querySelector('.format_input');
          let numbers = ['0','1','2','3','4','5','6','7','8','9', ' ', ''];
          if (numbers.includes(val.slice(val.length-1, val.length)) == true){
              format_input.value = this.counterStore.formatNumber(val);
              this.Amount = Number(val.replace(/\s+/g, ''));
          }else {
              format_input.value = this.counterStore.formatNumber(this.Amount);
          }
          console.log('trih', this.Amount);
      },
      async getPaymentTypes(){
          const response = await PaymentTypes(1, 1000);
          this.paymentTypes = response.data.items;
      },

      async onSubmit(){

          const data = {
              patient_id: this.Model.patient_id,
              payment_type_id: this.paymentTypeId,
              treatment_id: this.Model.treatment_id,
              amount: this.Amount
          }

          const response = await paymentUpdate(this.Model.id, data);
          console.log('Response:', response);
          if(response.status){
              this.PaymentType = '';
              this.PatientId = '';
              this.Amount = '';
              this.isShowModal = false;
              this.paymentTypes = [];
              this.getPaymentTypes()
              this.getItems();
              Alert('success', 'The payment was made successfully')
          }else {
              this.errorObj = response.data
              Alert('error', 'There is an error in the form')
          }
      },


    Show(item) {
        this.$router.push({ path: '/patient/show', query: { id: item.patient_id } })
    },
    onClickHandler(id) {
      this.paginate = id;
      this.currentPage = id;
      this.getItems();
    },

    onModal(id) {
      this.service_id = id;
      this.isModal = true;
    },
      paymentModal(item) {
        this.getModel(item.id);
          this.Modal = 'payment';
          this.UpdateId = item.id;
          this.Model = item;
          this.isShowModal = true;
      },

    getName(val) {
      return useConterStore().getName(val);
    },
    openModal() {
      const modal = document.querySelector(".modal");
      modal.classList.remove("hidden");
    },

    async getItems() {
        var response = [];

        if (this.Payments == null){
            response = await payments(this.currentPage, this.paginateCount);

            this.pagination = response.data.pagination;
            this.last_page = response.data.pagination.last_page;
            this.current_page = response.data.pagination.currentPage;
            this.items = response.data.items;

        }else{
            response = this.Payments;
            this.pagination = response.pagination;
            this.last_page = response.pagination.last_page;
            this.current_page = response.pagination.currentPage;
            this.items = response.items;
        }

    },
    async getModel(id) {
      const response = await paymentShow(id);

      if (response.status) {
          this.paymentTypeId = response.data.payment_type_id;
          this.Amount = response.data.amount_number;
          this.userPayments = response.data.real_price;
      }
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

      const response = await paymentsSearch(data);
      this.items = response.data.items;
    },
    async onDelete(val) {
      var message = "Вы уверены, что хотите это удалить?";
      if (confirm(message)) {
        const response = await paymentDelete(val);
        if (response.status == true) {
          Alert("success", "Deleted successfully !");
          this.getItems();
        }
      }
    },
    hasKey(key) {
      return this.errorObj.hasOwnProperty(key);
    },
    getStatus(e){
        if (e == 7){
            return this.getName('New');
        }else if (e == 8){
            return this.getName('DoctorFinished');
        }else if (e == 9){
            return this.getName('Finished');
        }else if (e == 10){
            return this.getName('Unpaint');
        }else if (e == 11){
            return this.getName('NotFullPaint');
        }else if (e == 12){
            return this.getName('Closed');
        }

    },
    getClass(e){
        if (e == 10){
            return 'unmount';
        }else if (e == 11){
            return 'fullUnmount';
        }else{
            return '';
        }
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
    this.getItems();
    this.getPaymentTypes()
  },
    watch:{
        Payments: function (val1, val2){
            this.getItems();
        }
    }
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
    padding: 5px 20px ;
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
