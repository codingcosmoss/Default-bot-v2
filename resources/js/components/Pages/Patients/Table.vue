<template>
  <div class="col-span-12 xl:col-span-12">
    <div
      class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1"
    >
      <h4 class="mb-6 text-xl font-bold text-black dark:text-white">
        {{ getName("Patients") }}
      </h4>

      <div class="flex flex-col table_media_box">
        <div class="grid grid-cols-3 rounded-sm mb-2 sm:grid-cols-5 relative media_top_bar">
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
              <option value="last_name">{{ getName("last_name") }}</option>
              <option value="first_name">{{ getName("name") }}</option>
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
              @input="onPaginate($event.target.value)"
              class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary ml-4"
            >
              <option value="10">10</option>
              <option value="20">20</option>
              <option value="50">50</option>
              <option value="100">100</option>
            </select>
          </div>

          <div
            class="flex flex-wrap gap-5 xl:gap-20"
            style="position: absolute; right: 0px; top: 0"
          >
            <a
              @click="this.$router.push('/patient/create')"
              class="cursor-pointer inline-flex items-center justify-center rounded-md bg-primary py-3 px-10 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10"
            >
              {{ getName("create") }}
            </a>
          </div>
        </div>

        <TableHeader></TableHeader>

        <div
          v-for="(item, index) in items"
          style="grid-template-columns: 70px repeat(6, 1fr);"
          class=" databes_table grid grid-cols-7 border-b border-stroke dark:border-strokedark sm:grid-cols-7"
        >

            <div class="flex items-center  gap-3 p-2.5 xl:p-5 data_table">
                <div class="photo-img" :style="'background-image: url(' + item['image'][0]['url'] + ')'" >

                </div>
            </div>

            <div class="flex items-center  gap-3 p-2.5 xl:p-5 data_table">

                <p style ="white-space: nowrap" class="font-medium  text-black dark:text-white sm:block">{{ index + 1 }}.  {{ item.first_name }} {{item.last_name}}</p>
            </div>


          <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white">{{ item.phone }}</p>
          </div>

          <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white">{{ item.birthday }}</p>
          </div>

          <div class="flex items-center justify-center p-2.5 xl:p-5">
              <p class="font-medium dark:text-white status-text "
                 :class="getClass(item.payment_status)"
              >{{ getStatus(item.payment_status)  }}</p>
          </div>


          <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white">{{ item.created_at }}</p>
          </div>

          <div class="flex items-center justify-center p-2.5 sm:flex xl:p-5">
            <p class="font-medium text-meta-5">
              <i
                @click="
                  this.$router.push({ path: '/patient/update', query: { id: item.id } })
                "
                class="fa-solid setting-icon fa-pen-to-square"
              ></i>
              &nbsp;
              <i
                @click="
                  this.$router.push({ path: '/patient/show', query: { id: item.id } })
                "
                class="fa-solid setting-icon fa-eye"
              ></i>
              &nbsp;
              <i

                @click="(isModal = true), (patient_id = item.id), getDate(), TextData = ' ', getEmployee() "
                title="Bemorga biriktrish"
                class="fa-solid fa-calendar-plus setting-icon"
              ></i>
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

      <ModalLayout
        @onButton="addReseption()"
        :isModal="isModal"
        @closeModal="isModal = false"
        :Title="getName('AddDoctor')"
      >
        <Select
          :Label="getName('Doctor')"
          :isError="hasKey('user_id')"
          :message="errorObj['user_id']"
          @onSelect="Employee_id = $event"
        >
          <option selected>---</option>
          <option v-for="user in Employees" :value="user['id']">
            {{ user["name"] }}
          </option>
        </Select>

        <Input
          :Label="getName('ReceptionTime')"
          @onInput="DateTime = $event"
          :isError="hasKey('start')"
          :message="errorObj['start']"
          :Value="DateTime"
        />

        <InputTime
          :Label="getName('Duration') +' / minute'"
          style="width: 200px"
          @onInput="Time = $event"
          :isError="hasKey('hour')"
          :message="errorObj['hour']"
          :Value ="Time"
        />

        <Textarea :Value ="TextData" :Label="getName('Classification')" @onInput="TextData = $event" />
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
  patients,
  patientShow,
  patientDelete,
  patientsSearch,
  Employees,
  joinDr,
} from "../../../Api.js";
import CreateForm from "../ServiceCategories/Create/CreateForm.vue";
import Pagination01 from "../../../ui-components/Element/pagination-01.vue";
import Paginate from "../../../ui-components/Element/Paginate/paginate.vue";
import InputText from "../../../ui-components/Form/InputText.vue";
import Select from "./Create/Inputs/Select.vue";
import Textarea from "../../../ui-components/Form/Textarea.vue";
import InputDateTime from "../../../ui-components/Form/InputDateTime.vue";
import InputTime from "../../../ui-components/Form/InputTime.vue";
import Loader from "@/ui-components/Element/Loader.vue";
export default {
  components: {
      Loader,
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
      column: "sort_order",
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
    };
  },

  methods: {
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
    router() {
      return router;
    },
    async getEmployee() {
      const response = await Employees(null, 1000);
      this.Employees = response.data.employees;
    },
    async addReseption() {
      if (this.Employee_id == 0) {
        this.errorObj = {
          user_id: "You need to choose a doctor",
        };
        return false;
      }
      this.errorObj = [];

      var data = {
        user_id: this.Employee_id,
        patient_id: this.patient_id,
        start: this.DateTime,
        reception_description: this.TextData == '' ? '...': '',
        hour: this.Time,
      };

      var response = "";
      response = await joinDr(data);

      if (response.status) {
        this.isModal = false;
        this.Employee_id = 0;
        this.patient_id = 0;
        this.Time = '0';
        this.Employees = [];
        this.getEmployees();
        Alert("success", "Attached to Doctor !");
      } else {
        this.errorObj = response.data;
      }
    },
    validateTime(time) {
    // Regex orqali vaqtni formatni tekshiramiz
    const timeRegex = /^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/;

    // Kirish qiymatini tekshiramiz
    if (!timeRegex.test(time)) {
        return false; // Not valid
    }

    // Vaqtni soatlarga va daqiqalarga ajratamiz
    const parts = time.split(':');
    const hours = parseInt(parts[0], 10);
    const minutes = parseInt(parts[1], 10);

    // Soat va daqiqalarni tekshiramiz
    if (hours < 0 || hours > 23 || minutes < 0 || minutes > 59) {
        return false; // Not valid
    }

    return true; // Valid
},
    getDate() {
      const currentDate = new Date();
      const year = currentDate.getFullYear();
      const month = ("0" + (currentDate.getMonth() + 1)).slice(-2);
      const day = ("0" + currentDate.getDate()).slice(-2);
      const hours = ("0" + currentDate.getHours()).slice(-2);
      const minutes = ("0" + currentDate.getMinutes()).slice(-2);

      var result = `${year}-${month}-${day} ${hours}:${minutes}`;
      this.DateTime = result;
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
    async getEmployees() {
      const response = await Employees(null, 1000);
    },
    onModal(id) {
      this.service_id = id;
      this.isModal = true;
    },

    getName(val) {
      return useConterStore().getName(val);
    },
    openModal() {
      const modal = document.querySelector(".modal");
      modal.classList.remove("hidden");
    },

    async getItems() {
      const response = await patients(this.currentPage, this.paginateCount);

      this.pagination = response.data.pagination;
      this.last_page = response.data.pagination.last_page;
      this.current_page = response.data.pagination.currentPage;
      this.items = response.data.items;
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
      const response = await patientsSearch(data);
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
    this.getItems();
    this.getEmployee();
    this.getDate();
  },
};
</script>
<style>

.photo-img{
    width: 50px;
    height: 50px;
    margin-right:10px ;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    padding: 25px;
}
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

.unmount{
    background: #f71010 !important;
}
.status-text{
    background: #39aa07;
    padding: 3px 8px ;
    border-radius: 10px;
    font-weight: bold;
    color: white;
    white-space: nowrap;
}
.fullUnmount{
    background: #b9a505 !important;
}
.active {
  background: #10b981 !important;
  //color: #2E3A47 !important;
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
</style>
