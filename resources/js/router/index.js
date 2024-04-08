import { createRouter, createWebHashHistory } from 'vue-router';
import {GetUser} from "@/Api.js";

let RolesArr = [];
async function getUser(){

    const response = await GetUser();

    if (response.success == 200){

        response.data.roles.forEach((e) => {
            RolesArr.push(e.lang_name);
        });

        localStorage.setItem('roles',  this.caesarCipher( RolesArr.join(',') , 7) );
    }

}

const routesArr = [

    // DASHBOARD
    {
        path: '/',
        name: 'public',
        component: () => import('../components/Pages/Dashboard/index.vue'),
    },
    // {
    //     path: '/components',
    //     name: 'public',
    //     component: () => import('../components/Pages/Components/Components.vue'),
    // },

    {
        name: 'public',
        path: '/login',
        component: () => import('../components/Pages/Login/index.vue'),
    },
    {
        name: 'public',
        path: '/profile',
        component: () => import('../components/Pages/Profile/index.vue'),
    },

    {
        path: '/:pathMatch(.*)*',
        name: 'public',
        component: () => import('../components/Pages/Error/index.vue')
    },

    // Employees
    {
        name: 'employees',
        path: '/employees',
        component: () => import('../components/Pages/Employees/index.vue'),
    },
    {
        name: 'employees',
        path: '/employees/create',
        component: () => import('../components/Pages/Employees/Create/Form.vue'),
    },
    {
        name: 'employees',
        path: '/employees/update',
        component: () => import('../components/Pages/Employees/Update/Form.vue'),
    },
    {
        name: 'employees',
        path: '/employees/show',
        component: () => import('../components/Pages/Employees/Show/index.vue'),
    },
    {
        name: 'employees',
        path: '/employees/edit-password',
        component: () => import('../components/Pages/Employees/EditPassword/Form.vue'),
    },
    {
        name: 'employees',
        path: '/employees/calendar',
        component: () => import('../components/Pages/Employees/Calendar/index.vue'),
    },
    // Services
    {
        name: 'services',
        path: '/services',
        component: () => import('../components/Pages/Services/index.vue'),
    },
    {
        name: 'services',
        path: '/service/create',
        component: () => import('../components/Pages/Services/Create/Form.vue'),
    },
    {
        name: 'services',
        path: '/service/update',
        component: () => import('../components/Pages/Services/Update/Form.vue'),
    },
    {
        name: 'services',
        path: '/service/show',
        component: () => import('../components/Pages/Employees/Show/index.vue'),
    },
    {
        name: 'services',
        path: '/service/edit-password',
        component: () => import('../components/Pages/Employees/EditPassword/Form.vue'),
    },

    // Service Categories
    {
        name: 'service_types',
        path: '/service-categories',
        component: () => import('../components/Pages/ServiceCategories/index.vue'),
    },
    {
        name: 'service_types',
        path: '/service-category/create',
        component: () => import('../components/Pages/ServiceCategories/Create/CreateForm.vue'),
    },
    {
        name: 'services',
        path: '/service/update',
        component: () => import('../components/Pages/Employees/Update/Form.vue'),
    },
    {
        name: 'service_types',
        path: '/service-category/show',
        component: () => import('../components/Pages/ServiceCategories/Show/index.vue'),
    },
    {
        name: 'services',
        path: '/service/edit-password',
        component: () => import('../components/Pages/Employees/EditPassword/Form.vue'),
    },

    // Patients

    {
        name: 'Patients',
        path: '/patients',
        component: () => import('../components/Pages/Patients/index.vue'),
    },
    {
        name: 'Patients',
        path: '/patient/create',
        component: () => import('../components/Pages/Patients/Create/Form.vue'),
    },
    {
        name: 'Patients',
        path: '/patient/update',
        component: () => import('../components/Pages/Patients/Update/Form.vue'),
    },
    {
        name: 'login',
        path: '/update',
        component: () => import('../components/Pages/Patients/Update/Form.vue'),
    },
    {
        name: 'Patients',
        path: '/patient/show',
        component: () => import('../components/Pages/Patients/Show/index.vue'),
    },
    {
        name: 'services',
        path: '/service/edit-password',
        component: () => import('../components/Pages/Employees/EditPassword/Form.vue'),
    },

    // Diseases

    {
        name: 'diseases',
        path: '/diseases',
        component: () => import('../components/Pages/Diseases/index.vue'),
    },
    {
        name: 'Treatmetns',
        path: '/treatmetns',
        component: () => import('../components/Pages/Treatments/index.vue'),
    },
    {
        name: 'Treatmetns',
        path: '/treatmetns/treatmetn',
        component: () => import('../components/Pages/Treatments/Treatment/index.vue'),
    },

    // PaymentTypes

    {
        name: 'PaymentTypes',
        path: '/payment-types',
        component: () => import('../components/Pages/PaymentTypes/index.vue'),
    },

    // Payments
    {
        name: 'Payments',
        path: '/payments',
        component: () => import('../components/Pages/Payments/index.vue'),
    },

    // Warehouse
    {
        path: '/warehouses',
        name: 'Warehouse',
        component: () => import('../components/Pages/Warehouses/index.vue'),
    },

    // Warehouse
    {
        name: 'Warehouse',
        path: '/filials',
        component: () => import('../components/Pages/Filials/index.vue'),
    },

    // WarehouseCategory
    {
        name: 'Warehouse',
        path: '/warehouse-categories',
        component: () => import('../components/Pages/WarehouseCategories/index.vue'),
    },

    // Groups
    {
        name: 'Warehouse',
        path: '/groups',
        component: () => import('../components/Pages/Groups/index.vue'),
    },
    // Products
    {
        name: 'Warehouse',
        path: '/products',
        component: () => import('../components/Pages/Products/index.vue'),
    },

    {
        name: 'Warehouse',
        path: '/product/create',
        component: () => import('../components/Pages/Products/Create/Form.vue'),
    },
    {
        name: 'Warehouse',
        path: '/product/update',
        component: () => import('../components/Pages/Products/Update/Form.vue'),
    },
    // {
    //     path: '/update',
    //     component: () => import('../components/Pages/Patients/Update/Form.vue'),
    // },
    // {
    //     path: '/patient/show',
    //     component: () => import('../components/Pages/Patients/Show/index.vue'),
    // },
    // {
    //     path: '/service/edit-password',
    //     component: () => import('../components/Pages/Employees/EditPassword/Form.vue'),
    // },

    // collections
    {
        name: 'Warehouse',
        path: '/collections',
        component: () => import('../components/Pages/Collections/index.vue'),
    },
    {
        name: 'Warehouse',
        path: '/product-documents',
        component: () => import('../components/Pages/ProductDocuments/index.vue'),
    },

    {
        path: '/suppliers',
        name: 'Warehouse',
        component: () => import('../components/Pages/Suppliers/index.vue'),
    },
    {
        name: 'Warehouse',
        path: '/producy-documents/add-products',
        component: () => import('../components/Pages/ProductDocuments/AddProducts/index.vue'),
    },

    {
        name: 'Treatmetns',
        path: '/treatmetn/add-service',
        component: () => import('../components/Pages/Treatments/Treatment/AddService/index.vue'),
    },
    {
        name: 'Treatmetns',
        path: '/check',
        component: () => import('../components/Pages/Treatments/Check.vue'),
    },
    {
        name: 'Treatmetns',
        path: '/debt-treatments',
        component: () => import('../components/Pages/DebtorTreatments/index.vue'),
    },

    {
        name: 'Telegram',
        path: '/telegrams',
        component: () => import('../components/Pages/Telegrams/index.vue'),
    },

    {
        name: 'Settings',
        path: '/settings',
        component: () => import('../components/Pages/Settings/index.vue'),
    },

    {
        name: 'PayingEmployees',
        path: '/employees-payments',
        component: () => import('../components/Pages/EmployeePayments/index.vue'),
    },
    {
        name: 'PayingEmployees',
        path: '/employees-payments/show',
        component: () => import('../components/Pages/EmployeePayments/ShowTable/Table.vue'),
    },

    {
        name: 'GivenMoney',
        path: '/given-moneys',
        component: () => import('../components/Pages/GivenMoneys/index.vue'),
    },

    {
        name: 'login',
        path: '/daily-staff-reports',
        component: () => import('../components/Pages/DailyStaffReports/index.vue'),
    },
    {
        name: 'DailyExpenses',
        path: '/daily-cost',
        component: () => import('../components/Pages/DailyCosts/index.vue'),
    },

    {
        name: 'Reports',
        path: '/reports',
        component: () => import('../components/Pages/Reports/index.vue'),
    }






];

const routes = [];
//
const roles = caesarDecipher( localStorage.getItem('roles'), 7).split(',');
function caesarDecipher(input, shift) {
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

}

routesArr.forEach((route) => {
    // console.log('Role:', roles);


    // routes.push({
    //     path: route.path,
    //     component: route.component
    // });

    if (roles.includes(route.name) || route.name == 'public' ){
        routes.push({
            path: route.path,
            component: route.component
        });
    }









    // console.log(route.path);
    // routes.push(route);

})


const router = createRouter({
    routes,
    history: createWebHashHistory(import.meta.env.BASE_URL)
})




export default router;
