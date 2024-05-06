<template>

<!--    Text, Logo , FormTitle , isError-->
  <Layout :isError = "isError" FormTitle = "Casmetologiya" >

      <Form >

          <Input
              Label = "Login"
              Pholder = "Enter your login"
              @onInput = "login = $event"
              :Value = "login"

          />

          <Input
              @onInput = "password = $event"
              Label = "Password"
              :Value = "password"
              Pholder = "Enter your password"
              Type = 'password'
          />

          <span style="display: flex; justify-content: center">
                   <loader-spinning v-if="Loader" style="margin: 0 auto; " />
          </span>
          <PrimaryButton v-if="!Loader" @click = "addForm" Title = "Sign in" ></PrimaryButton>
      </Form>

  </Layout>

</template>
<script >

    import Form from "./Form.vue";
    import Layout from "./Layout.vue";
    import InputText from "../../../ui-components/Form/InputText.vue";
    import PrimaryButton from "../../../ui-components/Form/PrimaryButton.vue";
    import {GetUser} from "../../../Api.js";
    import {Alert} from "@/Config.js";
    import axios from "axios";
    import Input from "../../../ui-components/Form/Input.vue";

    import { createRouter, createWebHashHistory } from 'vue-router';


    export default {
        components: {Input, PrimaryButton, InputText, Layout, Image, Form},
        data(){
            return{
                login: '',
                password: '',
                isError: false,
                Loader: false,

                // ___
                RolesArr: []
            }
        },
        methods:{
            async getUser(){

                const response = await GetUser();
                console.log(response)
                if (response.success == 200){
                    this.$router.push('/');
                }
            },
            async addForm(){
                try {
                    this.Loader = true;
                    let data = {
                        login : this.login,
                        password : this.password
                    }
                    const response = await axios.post('/login', data);

                    localStorage.setItem('lang', 'uz');
                    localStorage.setItem('0008a78764c2',  response.data.data);
                    if ( localStorage.getItem('darkMode' ) == null){
                        localStorage.setItem('darkMode', true );
                    }

                    if (response.data.success != undefined){
                        if (response.data.success == 200){

                            this.routePermission();
                            this.getUserLocal();
                            this.isError = false;
                            Alert('success', 'Login successfully !')
                        }else {
                            this.Loader = false;
                        }

                    }else {
                        this.isError = true;
                        this.Loader = false;
                    }


                } catch (error) {
                    this.Loader = false;
                    this.isError = true;
                }

            },
            async getUserLocal(){
                const response = await GetUser();
                localStorage.setItem('user', JSON.stringify(response.data));
                this.$router.push('/'); //  sizning hedef rout'ingiz nomi
            },
            async getPermissionUser(){

                const response = await GetUser();

                if (response.success == 200){

                    response.data.roles.forEach((e) => {
                        this.RolesArr.push(e.lang_name);
                    });

                    localStorage.setItem('roles',  this.caesarCipher( RolesArr.join(',') , 7) );
                }

            },
            caesarDecipher(input, shift) {
                if(input != null){
                    let result = '';
                    for (let i = 0; i < input.length; i++) {
                        let charCode = input.charCodeAt(i);
                        if (charCode >= 65 && charCode <= 90) {
                            result += String.fromCharCode(((charCode - 65 - shift + 26) % 26) + 65);
                        } else if (charCode >= 97 && charCode <= 122) {
                            result += String.fromCharCode(((charCode - 97 - shift + 26) % 26) + 97);
                        } else {
                            result += input[i];
                        }
                    }
                    return result;
                }
                return ',';

            },
            routePermission(){
                this.getPermissionUser();
                const routesArr = [

                    // DASHBOARD
                    {
                        path: '/',
                        name: 'public',
                        component: () => import('../Dashboard/index.vue'),
                    },
                    // {
                    //     path: '/components',
                    //     name: 'public',
                    //     component: () => import('../Components/Components.vue'),
                    // },

                    {
                        name: 'public',
                        path: '/login',
                        component: () => import('../Login/index.vue'),
                    },
                    {
                        name: 'public',
                        path: '/profile',
                        component: () => import('../Profile/index.vue'),
                    },

                    {
                        path: '/:pathMatch(.*)*',
                        name: 'public',
                        component: () => import('../Error/index.vue')
                    },

                    // Employees
                    {
                        name: 'employees',
                        path: '/employees',
                        component: () => import('../Employees/index.vue'),
                    },
                    {
                        name: 'employees',
                        path: '/employees/create',
                        component: () => import('../Employees/Create/Form.vue'),
                    },
                    {
                        name: 'employees',
                        path: '/employees/update',
                        component: () => import('../Employees/Update/Form.vue'),
                    },
                    {
                        name: 'employees',
                        path: '/employees/show',
                        component: () => import('../Employees/Show/index.vue'),
                    },
                    {
                        name: 'employees',
                        path: '/employees/edit-password',
                        component: () => import('../Employees/EditPassword/Form.vue'),
                    },
                    {
                        name: 'employees',
                        path: '/employees/calendar',
                        component: () => import('../Employees/Calendar/index.vue'),
                    },
                    // Services
                    {
                        name: 'services',
                        path: '/services',
                        component: () => import('../Services/index.vue'),
                    },
                    {
                        name: 'services',
                        path: '/service/create',
                        component: () => import('../Services/Create/Form.vue'),
                    },
                    {
                        name: 'services',
                        path: '/service/update',
                        component: () => import('../Services/Update/Form.vue'),
                    },
                    {
                        name: 'services',
                        path: '/service/show',
                        component: () => import('../Employees/Show/index.vue'),
                    },
                    {
                        name: 'services',
                        path: '/service/edit-password',
                        component: () => import('../Employees/EditPassword/Form.vue'),
                    },

                    // Service Categories
                    {
                        name: 'service_types',
                        path: '/service-categories',
                        component: () => import('../ServiceCategories/index.vue'),
                    },
                    {
                        name: 'service_types',
                        path: '/service-category/create',
                        component: () => import('../ServiceCategories/Create/CreateForm.vue'),
                    },
                    {
                        name: 'services',
                        path: '/service/update',
                        component: () => import('../Employees/Update/Form.vue'),
                    },
                    {
                        name: 'service_types',
                        path: '/service-category/show',
                        component: () => import('../ServiceCategories/Show/index.vue'),
                    },
                    {
                        name: 'services',
                        path: '/service/edit-password',
                        component: () => import('../Employees/EditPassword/Form.vue'),
                    },

                    // Patients

                    {
                        name: 'Patients',
                        path: '/patients',
                        component: () => import('../Patients/index.vue'),
                    },
                    {
                        name: 'Patients',
                        path: '/patient/create',
                        component: () => import('../Patients/Create/Form.vue'),
                    },
                    {
                        name: 'Patients',
                        path: '/patient/update',
                        component: () => import('../Patients/Update/Form.vue'),
                    },
                    {
                        name: 'login',
                        path: '/update',
                        component: () => import('../Patients/Update/Form.vue'),
                    },
                    {
                        name: 'Patients',
                        path: '/patient/show',
                        component: () => import('../Patients/Show/index.vue'),
                    },
                    {
                        name: 'services',
                        path: '/service/edit-password',
                        component: () => import('../Employees/EditPassword/Form.vue'),
                    },

                    // Diseases

                    {
                        name: 'diseases',
                        path: '/diseases',
                        component: () => import('../Diseases/index.vue'),
                    },
                    {
                        name: 'Treatmetns',
                        path: '/treatmetns',
                        component: () => import('../Treatments/index.vue'),
                    },
                    {
                        name: 'Treatmetns',
                        path: '/treatmetns/treatmetn',
                        component: () => import('../Treatments/Treatment/index.vue'),
                    },

                    // PaymentTypes

                    {
                        name: 'PaymentTypes',
                        path: '/payment-types',
                        component: () => import('../PaymentTypes/index.vue'),
                    },

                    // Payments
                    {
                        name: 'Payments',
                        path: '/payments',
                        component: () => import('../Payments/index.vue'),
                    },

                    // Warehouse
                    {
                        path: '/warehouses',
                        name: 'Warehouse',
                        component: () => import('../Warehouses/index.vue'),
                    },

                    // Warehouse
                    {
                        name: 'Warehouse',
                        path: '/filials',
                        component: () => import('../Filials/index.vue'),
                    },

                    // WarehouseCategory
                    {
                        name: 'Warehouse',
                        path: '/warehouse-categories',
                        component: () => import('../WarehouseCategories/index.vue'),
                    },

                    // Groups
                    {
                        name: 'Warehouse',
                        path: '/groups',
                        component: () => import('../Groups/index.vue'),
                    },
                    // Products
                    {
                        name: 'Warehouse',
                        path: '/products',
                        component: () => import('../Products/index.vue'),
                    },

                    {
                        name: 'Warehouse',
                        path: '/product/create',
                        component: () => import('../Products/Create/Form.vue'),
                    },
                    {
                        name: 'Warehouse',
                        path: '/product/update',
                        component: () => import('../Products/Update/Form.vue'),
                    },
                    // {
                    //     path: '/update',
                    //     component: () => import('../Patients/Update/Form.vue'),
                    // },
                    // {
                    //     path: '/patient/show',
                    //     component: () => import('../Patients/Show/index.vue'),
                    // },
                    // {
                    //     path: '/service/edit-password',
                    //     component: () => import('../Employees/EditPassword/Form.vue'),
                    // },

                    // collections
                    {
                        name: 'Warehouse',
                        path: '/collections',
                        component: () => import('../Collections/index.vue'),
                    },
                    {
                        name: 'Warehouse',
                        path: '/product-documents',
                        component: () => import('../ProductDocuments/index.vue'),
                    },

                    {
                        path: '/suppliers',
                        name: 'Warehouse',
                        component: () => import('../Suppliers/index.vue'),
                    },
                    {
                        name: 'Warehouse',
                        path: '/producy-documents/add-products',
                        component: () => import('../ProductDocuments/AddProducts/index.vue'),
                    },

                    {
                        name: 'Treatmetns',
                        path: '/treatmetn/add-service',
                        component: () => import('../Treatments/Treatment/AddService/index.vue'),
                    },
                    {
                        name: 'Treatmetns',
                        path: '/check',
                        component: () => import('../Treatments/Check.vue'),
                    },
                    {
                        name: 'Treatmetns',
                        path: '/debt-treatments',
                        component: () => import('../DebtorTreatments/index.vue'),
                    },

                    {
                        name: 'Telegram',
                        path: '/telegrams',
                        component: () => import('../Telegrams/index.vue'),
                    },

                    {
                        name: 'Settings',
                        path: '/settings',
                        component: () => import('../Settings/index.vue'),
                    },

                    {
                        name: 'PayingEmployees',
                        path: '/employees-payments',
                        component: () => import('../EmployeePayments/index.vue'),
                    },
                    {
                        name: 'PayingEmployees',
                        path: '/employees-payments/show',
                        component: () => import('../EmployeePayments/ShowTable/Table.vue'),
                    },

                    {
                        name: 'GivenMoney',
                        path: '/given-moneys',
                        component: () => import('../GivenMoneys/index.vue'),
                    },

                    {
                        name: 'login',
                        path: '/daily-staff-reports',
                        component: () => import('../DailyStaffReports/index.vue'),
                    },
                    {
                        name: 'DailyExpenses',
                        path: '/daily-cost',
                        component: () => import('../DailyCosts/index.vue'),
                    },

                    {
                        name: 'Reports',
                        path: '/reports',
                        component: () => import('../Reports/index.vue'),
                    }






                ];

                const routes = [];
//
                const roles = this.caesarDecipher( localStorage.getItem('roles'), 7).split(',');


                routesArr.forEach((route) => {

                    if (roles.includes(route.name) || route.name == 'public' ){
                        routes.push({
                            path: route.path,
                            component: route.component
                        });
                    }

                })


                const router = createRouter({
                    routes,
                    history: createWebHashHistory(import.meta.env.BASE_URL)
                });

                return router;

            }




        },
        mounted() {
            this.getUser()
        }
    }
</script>
