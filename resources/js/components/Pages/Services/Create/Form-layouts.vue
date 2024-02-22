<template>
  <!-- Breadcrumb Start -->
  <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <nav>
      <ol class="flex items-center gap-2">
        <li>
          <a class="font-medium cursor-pointer" @click="this.$router.push('/services')">
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
              />
              <Input
                :Couple="false"
                :Label="getName('technic_price')"
                @onInput="technic_price = $event"
                :isError="hasKey('technic_price')"
                :message="errorObj['technic_price']"
                Type="number"
                :Value="technic_price"
              />
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
          <p class=" block text-black dark:text-white" style="ma">
            {{ getName('personal_procent') }}
          </p>
        </div>

        <DinamicForm :errors="FormErrors" @Data ="personalProcents = $event, validate(personalProcents)"></DinamicForm>

        <div class="pl-7 p-6.5">
          <button
            @click="create"
            class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray"
          >
            {{ getName("create") }}
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
import InputColor from "./Inputs/InputColor.vue";
import { serviceCreate, Employees, service_categorys } from "../../../../Api.js";
import { GET } from "../../../../Config.js";
import { Alert } from "../../../../Config.js";
import PrimaryButton from "../../../../ui-components/Form/PrimaryButton.vue";
import PrimaryButton2 from "../../../../ui-components/Form/PrimaryButton2.vue";
import Select from "./Inputs/Select.vue";
import DinamicForm from "../../../../ui-components/Form/DinamicForm.vue";
export default {
  data() {
    return {
      name: "",
      order: "",
      code: "",
      price: "",
      category: "",
      material_price: "",
      technic_price: "",
      status: 1,
      isLoginError: false,
      errorObj: {},
      personal_procent: false,
      categories: [],
      personalProcents:[],
      FormErrors: []
    
    };
  },
  components: {
    Select,
    PrimaryButton2,
    PrimaryButton,
    InputColor,
    Checkbox,
    Input,
    DinamicForm,
  },
  methods: {
    getName(val) {
      return useConterStore().getName(val);
    },

    async getCategories() {
      const response = await service_categorys(null, 1000);
      this.categories = response.data.items;
    },

    async create() {
      if (this.validate(this.personalProcents)) {
        Alert("success", "Created successfully !");
        return true;
          var data = {
          name: this.name,
          order: this.order,
          code: this.code,
          price: this.price,
          category_id: this.category,
          material_price: this.material_price,
          technic_price: this.technic_price,
          status: this.status,
          color: this.color,
          personal_procents: this.personalProcents,
        };
        const response = await serviceCreate(data);

        if (response.status) {
          Alert("success", "Created successfully !");
          this.$router.push("/services");
        } else {
          this.errorObj = response.data;
        }
      }

      Alert('error', 'There is an error in the form');
      
    },
    validate(items){
      console.log(items);
      if (items.length == 0) {
        return true;
      }
      let errors = []; 
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
      });

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
