<template>
  <div class="col-span-12 xl:col-span-12">
    <div
      class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1"
    >
      <h4 class="mb-6 text-xl font-bold text-black dark:text-white">
        {{ getName("GivenMoney") }}
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


        </div>

        <TableHeader></TableHeader>

        <div
          v-for="(item, index) in Items"
          class=" databes_table grid grid-cols-6 border-b border-stroke dark:border-strokedark sm:grid-cols-6"
        >
          <div class="flex items-center gap-3 p-2.5 xl:p-5">
            <p class="font-medium  text-black dark:text-white sm:block">
              {{ index + 1 }}. {{ item.doctor.name }}
            </p>
          </div>

          <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white">{{ item.doctor_givey_money_at }}</p>
          </div>

          <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white">{{ counterStore.formatNumber(item.doctor_result_sum) }} uzs</p>
          </div>

          <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white">{{ item.technic_or_doctor_payment_type	 }}</p>
          </div>

<!--          <div class="flex items-center justify-center p-2.5 xl:p-5">-->
<!--            <p class="font-medium text-black dark:text-white">{{ item.technic_or_doctor_payment_type }}</p>-->
<!--          </div>-->

          <div class="flex items-center justify-center p-2.5 xl:p-5" style="white-space: nowrap">
            <p class="font-medium text-black dark:text-white">{{ item.patient.first_name  }} {{item.patient.last_name}}</p>
          </div>

          <div class="flex items-center justify-center p-2.5 sm:flex xl:p-5">
            <p class="font-medium text-meta-5">
              &nbsp;
                <i
                    @click="
                  this.$router.push({ path: '/patient/show', query: { id: item.patient_id } })
                "
                    class="fa-solid setting-icon fa-eye"
                ></i>
              &nbsp;

            </p>
          </div>
        </div>

          <Loader v-if="Items.length == 0  && search == '' " ></Loader>

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
    import {diseasesSearch, givenMoneys} from "@/Api.js";
    import Paginate from "@/ui-components/Element/Paginate/paginate.vue";
    import Pagination01 from "@/ui-components/Element/pagination-01.vue";
    import {VueAwesomePaginate} from "vue-awesome-paginate";
    import Loader from "@/ui-components/Element/Loader.vue";
    import TableHeader from  './Table-header.vue';
    import {givenMoneysSearch} from "@/Api.js";
    export default {
        components: {Loader, VueAwesomePaginate, Pagination01, Paginate,TableHeader},
        setup(){
            const counterStore = useConterStore();
            return {counterStore}
        },

        data(){
            return{

                Items: [],
                search: '',
                column: 'updated_at',
                order: 'asc',
                paginateCount: 10,
                pagination: {},
                last_page: 0,
                currentPage: 1,
                errorObj: {},
                crud:'',

            }
        },
       methods:{

           async clickSearch(val, order){
               this.search = val;
               this.order = order;
               var data = {
                   'search': this.search,
                   'order' : this.order,
                   'column': this.column,
                   'paginate': this.paginateCount
               }
               const response = await givenMoneysSearch(data);
               console.log('Response:',response)
               this.Items = response.data.items;


           },
           async getModel(){
               const response = await givenMoneys();
               this.Items = response.data;
           },
           getName(val){
               return useConterStore().getName(val)
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
            this.getModel()
        }
    }
</script>

<style>
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
