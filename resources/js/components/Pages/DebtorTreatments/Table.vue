<template>
  <div class="col-span-12 xl:col-span-12">
    <div
      class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1"
    >

      <h4 class="mb-6 text-xl font-bold text-black dark:text-white">
        {{ getName("DebtTreatments") }}
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
          v-for="(item, index) in Treatments.length > 0 ? Treatments : items"
          class="grid tableBox grid-cols-7 border-b border-stroke dark:border-strokedark sm:grid-cols-7 databes_table "
        >
          <div class="flex items-center gap-3 p-2.5 xl:p-5">
            <p class="font-medium hidden text-black dark:text-white sm:block">
              {{ index + 1 }}. {{ item.patient.first_name }}
            </p>
          </div>

          <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white">{{ item.patient.last_name }}</p>
          </div>

          <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white">{{ item.doctor.name }}</p>
          </div>

          <div class="flex items-center justify-center p-2.5 xl:p-5">
              <p class="font-medium text-black dark:text-white">{{ item.start }} {{ item.id }}</p>
          </div>

          <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white status-text "
               :class="getClass(item.status)"
            >{{ getStatus(item.status) }}</p>
          </div>


        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium dark:text-white status-text "
              :class="getClass(item.payment_status)"
            >{{ getStatus(item.payment_status) }}
            </p>
        </div>


          <div class="hidden button-box0 items-center justify-center p-2.5 sm:flex xl:p-5">
            <p class="font-medium text-meta-5 btns " >
                <i
                    @click="Show(item) "
                    class="fa-solid setting-icon fa-eye"
                ></i>
                <i
                    titile = 'Tahrirlash'
                    v-if="item.status == 8 && item.payment_status != 12 "
                    @click="this.$router.push({ path: '/treatmetns/treatmetn', query:{ id: item.patient_id, treatment_id: item.id } })"
                    class="fa-solid setting-icon fa-pen-to-square "
                ></i>
                <i
                    v-if="item.status == 7"
                    @click="this.$router.push({ path: '/treatmetns/treatmetn', query:{ id: item.patient_id, treatment_id: item.id } })"
                    :title="getName('Treatment')"
                    class="fa-regular setting-icon fa-calendar-plus cursor-pointer"

                ></i>

                <i
                    v-if="item.payment_status != 12 && item.status != 7"
                    @click="paymentModal(item), userPayments = item.user_payment "
                    :title="getName('Payments')"
                    class="fa-regular fas fa-donate setting-icon  cursor-pointer"
                ></i>

                <i
                    title="Tolov tarixi"
                    v-if="item.payment_status ==  11 || item.payment_status == 12"
                    @click="istoryPaymentModal(item)"
                    :title="getName('Payment')"
                    class="fa-solid fa-clock-rotate-left setting-icon  cursor-pointer"
                ></i>


                <i
                    title="Chegirma berish"
                    v-if="item.payment_status != 12 && item.status != 9 && item.status != 7"
                    @click="discountModal(item)"
                    :title="getName('Payment')"
                    class="fa-regular fas fa-percent setting-icon  cursor-pointer"
                ></i>
                <i
                    title="Qarzga bajarish"
                    v-if="item.payment_status != 12 && item.status != 9 && item.status != 7"
                    @click="debtModal(item)"
                    :title="getName('Payment')"
                    class="fa-regular fas fa-coins setting-icon  cursor-pointer"
                ></i>


                <a target="_blank" :href="onCheck(item.id)"  >
                    <i
                        title="Tolov cheki"
                        v-if="item.payment_status != 10"
                        :title="getName('Payment')"
                        class="fa-regular fas fa-print setting-icon  cursor-pointer"
                    ></i>
                </a>

                <i
                    title="Tugatish"
                    v-if="item.status != 9 && item.status != 7"
                    @click="treatementFinished(item.id)"
                    :title="getName('Payment')"
                    class="fa-regular fas fa-square-check setting-icon  cursor-pointer"
                ></i>
<!--                <div class="button-box01" v-if="item.payment_status != 12 && item.status != 7">-->
<!--                  -->
<!--                </div>-->

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


            <ShowForm @onSubmit = "Modal == '0' ? isShowModal = false : onPayment() "   :UpdateId = "UpdateId"  @closeModal = "isShowModal = $event, errorObj = []" :isShowModal = "isShowModal"  >

                <table v-if="Modal == 0 && Model != []  " class="table01" >

                    <tr>
                        <th>{{getName('name')}}: &nbsp;&nbsp;</th>
                        <td>{{Patient.last_name}}</td>
                    </tr>

                    <tr>
                        <th>{{getName('last_name')}}: &nbsp;&nbsp;</th>
                        <td>{{ Patient.first_name }}</td>
                    </tr>

                    <tr>
                        <th>{{getName('Doctor')}}: &nbsp;&nbsp;</th>
                        <td>{{doctor.name}}</td>
                    </tr>

                    <tr>
                        <th>{{getName('TreatmentStarted_at')}}: &nbsp;&nbsp;</th>
                        <td>{{Model.start}}</td>
                    </tr>

                    <tr>
                        <th>{{getName('Finished_at')}}: &nbsp;&nbsp;</th>
                        <td>{{Model.end}}</td>
                    </tr>

                    <tr>
                        <th>{{getName('PatientEndPayment')}}: &nbsp;&nbsp;</th>
                        <td>{{Model.latest_payment != null ? Model.latest_payment.amount : '0 UZS'}}</td>
                    </tr>

                    <tr>
                        <th>{{getName('AmountOwedType')}}: &nbsp;&nbsp;</th>
                        <td>{{Model.latest_payment != null ? Model.latest_payment.payment_type : '---'}}</td>
                    </tr>
                    <tr>
                        <th>{{getName('TreatmentPrice')}}: &nbsp;&nbsp;</th>
                        <td>{{useConterStore().formatNumber(Number(Model.service_real_price))}} uzs</td>
                    </tr>
                    <tr>
                        <th>{{getName('PaymentsUser')}}: &nbsp;&nbsp;</th>
                        <td>{{useConterStore().formatNumber(Number(Model.payment_amount))}} uzs</td>
                    </tr>
                    <tr>
                        <th>{{getName('AmountOwed')}}: &nbsp;&nbsp;</th>
                        <td>{{useConterStore().formatNumber(Number(Model.user_payment))}} uzs</td>
                    </tr>
                    <tr>
                        <th>{{getName('Discount')}}: &nbsp;&nbsp;</th>
                        <td>{{useConterStore().formatNumber(Number(Model.discount_sum))}} uzs</td>
                    </tr>
                    <tr>
                        <th>{{getName('Payment_status')}}: &nbsp;&nbsp;</th>
                        <td>

                            <p class="font-medium dark:text-white status-text "
                               :class="getClass(Model.payment_status)"
                            >{{ getStatus(Model.payment_status)  }}</p>

                        </td>
                    </tr>

                </table>

                <!--         Tolov tarixi       -->
                <table v-if="Modal == 'istory-payment' && Model != []  " class="table01" >

                    <tr>
                        <th>{{getName('Amount')}}</th>
                        <th>{{getName('Created_at')}}</th>
                        <th>{{getName('Type')}}</th>
                    </tr>
                    <tr v-for="patientPayment in patientPayments ">
                        <td>{{patientPayment.amount}}</td>
                        <td>{{patientPayment.created_at}}</td>
                        <td>
                            <p class="font-medium dark:text-white status-text "
                               :style=" 'background: ' + patientPayment.color "
                            >{{ patientPayment.payment_type }}</p>
                        </td>

                    </tr>

                </table>

                <div v-else-if = "Modal == 'debt' " >

                    <h1>{{getName('DebitTitle')}}</h1>
                    <br>
                    <div class="flex">
                        <Checkbox01
                            @click = "debtUser = 'doctor'"
                            :onCheck =" debtUser == 'doctor' ? true : false"
                            :Title = "getName('Doctor')"
                        />
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        <Checkbox01
                            @click = "debtUser = 'polyclinic'"
                            :onCheck =" debtUser == 'polyclinic' ? true : false"
                            :Title = "getName('PolyClinic')"
                        />
                    </div>
                    <br>
                    <Input
                        :Label="getName('DebitData')"
                        @onInput="debtData = $event"
                        :isError="hasKey('debt_data')"
                        :message="errorObj['debt_data']"
                        Type = "date"
                        Value = "2024-03-01"
                    />


                    <Textarea
                        :Label="getName('Description')"
                        @onInput="debtText = $event"
                        :isError="hasKey('debt_text')"
                        :message="errorObj['debt_text']"
                        :Value = "debtText"
                    />





                </div>
                <div v-else-if = "Modal == 'discount' " >

                    <h1>{{getName('Summa')}}: {{counterStore.formatNumber(RealPrice)}} uzs</h1>
                    <h1>{{getName('PaymentSum')}}: {{counterStore.formatNumber(discount_total_sum)}} uzs</h1>


                    <br>
                    <Input
                        :Label="getName('Discount') + ' (%)' "
                        @onInput="percentInput($event)"
                        :isError="hasKey('discount_percent')"
                        :message="errorObj['discount_percent']"
                        :Value = "discount_percent"
                        Tyoe = "number"
                    />

                    <Input
                        :Label="getName('Discount') + ' (sum)' "
                        @onInput="sumInput($event)"
                        :isError="hasKey('discount_sum')"
                        :message="errorObj['discount_sum']"
                        :Value = "discount_sum"
                        Tyoe = "number"
                    />
                    <p v-if="discountError" class="text-danger"> {{getName('DiscountError')}}</p>


                    <h1>{{getName('DebitTitle')}}</h1>
                    <br>

                    <div class="flex">
                        <Checkbox01
                            @click = "debtUser = 'doctor'"
                            :onCheck =" debtUser == 'doctor' ? true : false"
                            :Title = "getName('Doctor')"
                        />
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        <Checkbox01
                            @click = "debtUser = 'polyclinic'"
                            :onCheck =" debtUser == 'polyclinic' ? true : false"
                            :Title = "getName('PolyClinic')"
                        />
                    </div>
                    <br>

                </div>
               <div  v-else-if = "Modal == 'payment'" >
                   <DangerButton
                        style="font-size: 20px"
                        :isActive = "userPayments <= 0 ? true : false"
                        :Title = "useConterStore().formatNumber(Number(userPayments)) + ' uzs' "
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
                       @onSelect = "PaymentType = $event"

                   >
                       <option selected >---</option>
                       <option v-for="item in paymentTypes" :value="item['id']">
                           {{ item["name"] }}
                       </option>
                   </Select>

               </div>


            </ShowForm>

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
import {owedTreatmentCreate, patientShow} from "../../../Api.js";
import {
    treatmentDiscount,
  TreatmentShow,
  Employees,
    PaymentTypes,
    paymentCreate,
    treatmentFinished,
    debtorTreatments,
    deptorTreatmentSearch
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
import PrimaryButton2 from "@/ui-components/Form/PrimaryButton2.vue";
import {holdNextTicks} from "alpinejs/src/nextTick.js";
import DangerButton from "@/ui-components/Form/DangerButton.vue";
import {getUserPayments} from "@/Api.js";
import Checkbox01 from "@/ui-components/Form/Checkbox/Checkbox01.vue";
import {createMemoryHistory} from "vue-router";
import {indexOf} from "vue-modal-service";
export default {
    setup(){
        const counterStore = useConterStore();
        return{useConterStore, counterStore}
    },
  components: {
      Checkbox01,
      DangerButton,
      PrimaryButton2,
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
        userPayments: 0,
      order: "asc",
      paginateCount: 10,
      pagination: {},
      last_page: 0,
      currentPage: 1,
      password_1: ".",
      password_2: "",
      isPasswordError: false,
      ExitModal: false,
        isPaymentModal: false,
      Duration: 0,
      service_id: "",
        PaymentType: '',
        Amount: '',
      isShowModal: false,
      errorObj: [],
      UpdateId: 0,
      crud: "",
      Employees: [],
      Employee_id: 0,
      DateTime: "",
      TextData: '',
      Time: "0",
      Modal: 0,
      Item: [],
      patient_id: 0,
        status: 1,
        categoryName: '',
        Model: [],
        doctor: [],
        Patient: [],
        paymentTypes: [],
        PatientId: '',
        debtUser: 'doctor', // qarz kim tomondan berildi doctor/ polyclinic
        debtData: '', // qaytarish sanasi
        debtText: '', // izoh
        patientPayments: [],
        discount_percent: 0,
        discount_sum: 0,
        discount_total_sum: 0,
        RealPrice: 0,
        discountError: false,

    };
  },

  methods: {
    router() {
      return router;
    },
    async getEmployee() {
      const response = await Employees(null, 1000);
      this.Employees = response.data.employees;
    },
  sumInput(val){
        this.discount_sum = val;
      if (this.RealPrice > 0){
          this.discount_percent = (100 * val)/this.RealPrice;
      }else {
          this.discount_percent = 0;
      }

  },
      percentInput(val){
          if (Number(val) > 100){
              this.discount_percent = 100;
          }else {
              this.discount_percent = val;
          }
          if (this.RealPrice > 0){
              this.discount_sum = (this.RealPrice * val)/100;
          }else {
              this.discount_sum = 0;
          }

      },
  async treatementFinished(id){
      const response = await treatmentFinished(id);
      console.log(response);
      if (response.status) {
          Alert('success', 'Treatment is complete');
          this.getItems();
      }else {
          Alert('error', 'Error!');
      }
  },

    debtModal(item){
        this.Item = item;
        this.debtUser = 'doctor';
        this.Modal = 'debt';
        this.getDate();
        this.UpdateId = item.id;
        this.isShowModal = true;
    },
      discountModal(item){
          this.Item = item;
          this.debtUser = item.type_of_discount != 15 ? 'doctor' : 'polyclinic';
          this.Modal = 'discount';
          this.discount_sum = item.discount_sum;
          this.discount_percent = item.discount_percent;
          this.discount_total_sum = Number(item.user_payment);
          this.RealPrice = item.service_real_price;
          this.UpdateId = item.id;
          this.isShowModal = true;
          console.log('Item', item);
      },
    istoryPaymentModal(item){
      this.Item = item;
      this.Modal = 'istory-payment';
      this.patientPayments = [];
      this.getPatientPayments(item.patient_id);
      this.UpdateId = item.id;
      this.isShowModal = true;
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

    async getModal(){
          const response = await TreatmentShow(this.UpdateId);
          this.Model = response.data;
          this.doctor = response.data.doctor;
          this.Patient = response.data.patient;
    },
      async sendDiscount(){
        if (this.discount_sum > this.discount_total_sum){
            this.discountError = true;
            console.log('error fkfr0', this.discount_sum)
            return true;
        }
          let data = {
              discount_sum: this.discount_sum,
              discount_percent: this.discount_percent,
              discount_total_sum: this.discount_total_sum,
              discounter: this.debtUser == 'doctor' ? 16 : 15 ,
              treatment_id: this.Item.id
          }
          const response = await treatmentDiscount(data);
          console.log('response:', response);

          if (response.status){
              this.debtUser = "";
              this.discount_sum = 0;
              this.discount_total_sum = 0;
              this.discount_percent = 0;
              this.errorObj = [];
              this.isShowModal = false;
              this.getItems();
              Alert('success', 'Saved successfully !');
          }else {
              this.errorObj = response.data
              Alert('error', 'There is an error in the form')
          }
      },
    async saveOwed(){

        let data = {
            'patient_id': this.Item.patient_id,
            'authorizing': this.debtUser,
            'treatment_id': this.Item.id,
            'return_at': this.debtData,
            'description': this.debtText,
        }

        const response = await owedTreatmentCreate(data)
        console.log('Response:->', response);
        if (response.status){
            this.debtUser = "";
            this.debtData = "";
            this.debtText = "";
            this.isShowModal = false;
            Alert('success', 'Saved successfully !');
        }else {
            this.errorObj = response.data
            Alert('error', 'There is an error in the form')
        }
    },
      async getPatientPayments(id){
          const response = await patientShow(id);
          this.patientPayments = response.data.payments.items;
          console.log('Payment:', response.data.payments.items);
      },
    async getPayments(id){
        const response =  await getUserPayments(id);
        return response.data;
    },
    async getPaymentTypes(){
        const response = await PaymentTypes(1, 1000);
        this.paymentTypes = response.data.items;
    },

    getDate() {

      const currentDate = new Date();
      const year = currentDate.getFullYear();
      const month = ("0" + (currentDate.getMonth() + 1)).slice(-2);
      const day = ("0" + currentDate.getDate()).slice(-2);
      const hours = ("0" + currentDate.getHours()).slice(-2);
      const minutes = ("0" + currentDate.getMinutes()).slice(-2);

        var result = `${year}-${month}-${day} ${hours}:${minutes}`;
        var result2 = `${year}-${month}-${day}`;
        this.DateTime = result;
        this.debtData = result2;
    },
    Show(item) {
        this.Model = [];
        this.Model = item;
        this.Modal = 0;
      this.UpdateId = item.id;
      this.isShowModal = true;
    },
      paymentModal(item) {
        this.Modal = 1;
          this.UpdateId = item.id;
          this.PatientId = item.patient_id;
          this.userPayments = item.user_payment
          this.isShowModal = true;
          this.Modal = 'payment';
      },
    onClickHandler(id) {
      this.paginate = id;
      this.currentPage = id;
      this.getItems();
    },
    async getEmployees() {
      const response = await Employees(null, 1000);
    },
    onModal(id) {
      this.service_id = id;
      this.isPaymentModal = true;
    },

    getName(val) {
      return useConterStore().getName(val);
    },
    openModal() {
      const modal = document.querySelector(".modal");
      modal.classList.remove("hidden");
    },

    async getItems() {
      const response = await debtorTreatments(this.currentPage, this.paginateCount);
      this.pagination = response.data.pagination;
      this.last_page = response.data.pagination.last_page;
      this.current_page = response.data.pagination.currentPage;
      this.items = response.data.items;
    },
    async onPayment(){

        if(this.Modal == 'debt'){
            this.saveOwed();
            return true;
        }else if(this.Modal == 'discount'){
            this.sendDiscount();
            return true;
        }

        if (this.userPayments < this.Amount){
            Alert( 'error', this.getName('PaymentError'));
            return false;
        }
        const data = {
            patient_id: this.PatientId,
            payment_type_id: this.PaymentType,
            treatment_id: this.UpdateId,
            amount: this.Amount
        }

        const response = await paymentCreate(data);
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
    async getModel() {
      const response = await patientShow(this.$route.query.id);

      if (response.status) {
      }
    },
    async editPassword(val) {
      this.password_1 = val;
      if (val == this.password_2) {
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

      const response = await deptorTreatmentSearch(data);
        console.log('respons', response)
        this.items = response.data.items;

    },
    async onDelete(val) {
      var message = "Вы уверены, что хотите это удалить?";
      if (confirm(message)) {
        const response = await patientDelete(val);
        if (response.status == true) {
          Alert("success", "Deleted successfully !");
          this.getItems();
        }
      }
    },
    onCheck(id){
        return  window.location.origin + '#/check' + '?id=' + id;
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
        }else if (e == 7){
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

    watch:{
        UpdateId: function(newVal, oldVal) { // watch it
            this.getModal()
        }
    },
  mounted() {
    this.getItems();
    this.getEmployee();
    this.getDate();
    this.getPaymentTypes()
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
    .button-box0{
        position: relative;
    }
    .button-box0:hover{
        .button-box01{
            display: flex;
        }
    }
    .button-box01{
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: space-between;
        top: -40px;
        right: 0px;
        background: #24303f;
        border: 1px solid #3C50E0;
        padding: 10px;
        display: none;
    }
    .btns{
        i{
            margin: 5px 8px ;
        }
    }
</style>
