<template>

  <!-- Breadcrumb Start -->
  <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between" style="justify-content: flex-end">
    <nav>
      <ol class="flex items-center gap-2">
        <li>
          <a  class="font-medium cursor-pointer" @click="this.$router.push('/services')">
            {{ getName("services") }} /</a
          >
        </li>
        <li class="font-medium text-primary">{{ getName("create") }}</li>
      </ol>
    </nav>
  </div>
  <!-- Breadcrumb End -->

  <!-- ====== Form Layout Section Start -->
  <div class="grid grid-cols-1 gap-9 sm:grid-cols-2">
    <div class="flex flex-col gap-9">
      <!-- Contact Form -->

      <div
        class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark"
      >
        <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
          <h3 class="font-semibold text-black dark:text-white">
            {{ getName("services") }}
          </h3>
        </div>
        <form action="#">
          <div class="p-6.5">
            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
              <Input
                :Couple="false"
                :Label="getName('name_content')"
                @onInput="name = $event"
                :isError="hasKey('name')"
                :message="errorObj['name']"
                :Value="name"
              />
              <Input
                :Couple="false"
                :Label="getName('code')"
                @onInput="code = $event"
                :isError="hasKey('code')"
                :message="errorObj['code']"
                :Value="code"
              />
            </div>

            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
              <Input
                :Couple="false"
                :Label="getName('price')"
                @onInput="price = $event"
                :isError="hasKey('price')"
                :message="errorObj['price']"
                :Value="price"
                Type="number"
              />

              <Select
                :Couple="false"
                :Label="getName('category')"
                @onSelect="this.category = $event"
                :isError="hasKey('category_id')"
                :message="errorObj['category_id']"
              >
                <option>---</option>
                <option
                  v-for="category in categories"
                  :value="category.id"
                  :selected="category.id == this.category"
                >
                  {{ category.name }}
                </option>
              </Select>

            </div>

            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
              <Input
                :Couple="false"
                :Label="getName('material_price')"
                @onInput="material_price = $event"
                :isError="hasKey('material_price')"
                :message="errorObj['material_price']"
                Type="number"
                :Value = "0"
              />
              <Input
                :Couple="false"
                :Label="getName('technic_price')"
                @onInput="technic_price = $event"
                :isError="hasKey('technic_price')"
                :message="errorObj['technic_price']"
                Type="number"
                :Value = "0"
              />
            </div>

              <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">

                  <Select
                      :Couple="false"
                      :Label="getName('Collection')"
                      @onSelect="this.CollectionId = $event"
                      :isError="hasKey('collection_id')"
                      :message="errorObj['collection_id']"
                  >
                      <option :value="null" >---</option>
                      <option
                          v-for="collection in Collections"
                          :value="collection.id"
                          :selected="collection.id == this.CollectionId"
                      >
                          {{ collection.name }}
                      </option>
                  </Select>
              </div>
          </div>
        </form>
      </div>
    </div>

    <div class="flex flex-col gap-9">
      <!-- Sign In Form -->
      <div
        class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark"
      >
        <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
          <h3 class="font-semibold text-black dark:text-white"></h3>
        </div>

        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row p-6.5">
          <Input
            :Couple="false"
            Type="number"
            :Label="getName('Serial_number')"
            @onInput="order = $event"
            :isError="hasKey('order')"
            :message="errorObj['order']"
            :Value="order"
          />

          <Select
            :Couple="false"
            :Label="getName('status')"
            @onSelect="this.status = $event"
          >
            <option :value="1">Active</option>
            <option :value="0">Inactive</option>

          </Select>
        </div>


        <div class="check02">
          <p class=" block text-black dark:text-white" >
            {{ getName('personal_procent') }}
          </p>
        </div>

        <DinamicForm :isLoader ="false" :summError ="summError" :errors="FormErrors" @Data ="personalProcents = $event, validate(personalProcents)"></DinamicForm>



          <div class=" pl-7 p-6.5" style="display: flex; justify-content: center">

              <loader-spinning v-if="Loader" style="margin: 0 auto; " />
              <button v-if="!Loader" @click="create" class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray">
                  {{getName('create')}}
              </button>

          </div>


      </div>
    </div>
  </div>
  <!-- ====== Form Layout Section End -->
</template>
<script>
import Input from "./Inputs/Input.vue";
import { useConterStore } from "../../../../store/counter.js";
import Checkbox from "./Inputs/Checkbox.vue";
import {serviceCreate, service_categorys, collections} from "../../../../Api.js";
import { GET } from "../../../../Config.js";
import { Alert } from "../../../../Config.js";
import PrimaryButton from "../../../../ui-components/Form/PrimaryButton.vue";
import PrimaryButton2 from "../../../../ui-components/Form/PrimaryButton2.vue";
import Select from "./Inputs/Select.vue";
import DinamicForm from "../../../../ui-components/Form/DinamicForm.vue";
import Loader from "@/ui-components/Element/Loader.vue";
export default {
  data() {
    return {
      name: "",
      order: "",
      code: "",
      price: 0,
      category: "",
      material_price: "",
      technic_price: "",
      status: 1,
      isLoginError: false,
      errorObj: {},
      personal_procent: false,
      categories: [],
      personalProcents:[],
      FormErrors: [],
      summError: false,
    Collections: [],
        CollectionId: 0,
        Loader: false,

    };
  },
  components: {
    Select,
    PrimaryButton2,
    PrimaryButton,
    Checkbox,
    Input,
    DinamicForm,
  },
  methods: {
    getName(val) {
      return useConterStore().getName(val);
    },
      async getCollections(){
          const response = await collections(1, 1000);
          this.Collections = response.data.items;
      },

    async getCategories() {
      const response = await service_categorys(null, 1000);
      this.categories = response.data.items;
    },


    async create() {
        this.Loader = true;
      if (this.validate(this.personalProcents)) {
        let summData = [];
        this.personalProcents.forEach((item, index) => {
          let summ = 0;
          // Summ
          if (item.type == '%') {
              summ += (this.price*Number(item.procent))/100;
          }else{
              summ += Number(item.procent);
          }
          summData.push({
              employee_id: item.employee,
              amount: item.procent,
              result_price: summ,
              type: item.type,
          });

      });

        var data = {
          name: this.name,
          order: this.order,
          code: this.code,
          price: this.price,
          category_id: this.category,
          material_price: this.material_price,
          technic_price: this.technic_price,
          status: this.status,
            collection_id: this.CollectionId,
          personal_procents: summData,
        };

        const response = await serviceCreate(data);

        console.log('Response:', response);
        if (response.status) {
          Alert("success", "Created successfully !");
          this.$router.push("/services");
        } else {
          this.errorObj = response.data;
          this.Loader = false;
        }
      }else {
        Alert('error', 'There is an error in the form');
        this.Loader = false;
      }


    },
    validate(items){

      if (items.length == 0) {
        return true;
      }

      let errors = [];
      let summ = 0;
      items.forEach((item, index) => {
          if (
            item.employee == '' ||
            item.procent < 0 ||
            item.procent == ''
            ) {
              errors.push(index);
          }else if(
            item.type == '%' &&
            item.procent > 100
            ) {
              errors.push(index);
          }else if( item.procent.length > 1 ){
            if (item.procent.split('')[0] == 0) {
              errors.push(index);
            }
          }
          // Summ
          if (item.type == '%') {
              summ += (this.price*Number(item.procent))/100;
          }else{
              summ += Number(item.procent);
          }
          items.forEach((model, number)=>{
              if (number != index && model.employee == item.employee){
                  errors.push(index);
                  errors.push(number);
              }
          })

      });

      if (this.price < summ || this.price <= 0) {
          this.summError = true;
          return false;
      }else{
        this.summError = false;
      }

      this.FormErrors =  errors;

      if (errors.length == 0) {
          return true;
      }
      return false

    },
    hasKey(key) {
      return key in this.errorObj;
    },
  },
  mounted() {
    this.getCategories();
      this.getCollections()
  },
};
</script>

<style lang="scss">
.check02 {
  display: flex;
  padding: 0 25px;
  align-items: center;
  input {
    transform: scale(1.5);
  }
}

.list01 {
  padding: 5px 27px;
  display: flex;
  align-content: space-between;
  justify-content: space-between;
  flex-direction: column;
}
.btn {
  width: 60px;
  transform: scale(0.8);
}

.btn2 {
  margin: 20px 0;
  margin-top: 30px;
  margin-left: 10px;
  width: 60px;
  transform: scale(0.8);
}
.btn2 button {
  background: rgba(255, 0, 0, 0.8);
}
</style>
