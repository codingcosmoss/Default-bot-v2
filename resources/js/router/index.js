import { createRouter, createWebHashHistory } from 'vue-router';


const routes = [

    // DASHBOARD
    {
        path: '/',
        component: () => import('../components/Pages/Components/Components.vue'),
    },

    {
        path: '/login',
        component: () => import('../components/Pages/Login/index.vue'),
    },

    {
        path: '/:pathMatch(.*)*',
        component: () => import('../components/Pages/Components/Components.vue'),
    },

    // Employees
    {
        path: '/employees',
        component: () => import('../components/Pages/Employees/index.vue'),
    },
    {
        path: '/employees/create',
        component: () => import('../components/Pages/Employees/Create/Form.vue'),
    },
    {
        path: '/employees/update',
        component: () => import('../components/Pages/Employees/Update/Form.vue'),
    },
    {
        path: '/employees/show',
        component: () => import('../components/Pages/Employees/Show/index.vue'),
    },
    {
        path: '/employees/edit-password',
        component: () => import('../components/Pages/Employees/EditPassword/Form.vue'),
    },
    {
        path: '/employees/calendar',
        component: () => import('../components/Pages/Employees/Calendar/index.vue'),
    },
    // Services
    {
        path: '/services',
        component: () => import('../components/Pages/Services/index.vue'),
    },
    {
        path: '/service/create',
        component: () => import('../components/Pages/Services/Create/Form.vue'),
    },
    {
        path: '/service/update',
        component: () => import('../components/Pages/Services/Update/Form.vue'),
    },
    {
        path: '/service/show',
        component: () => import('../components/Pages/Employees/Show/index.vue'),
    },
    {
        path: '/service/edit-password',
        component: () => import('../components/Pages/Employees/EditPassword/Form.vue'),
    },

    // Service Categories
    {
        path: '/service-categories',
        component: () => import('../components/Pages/ServiceCategories/index.vue'),
    },
    {
        path: '/service-category/create',
        component: () => import('../components/Pages/ServiceCategories/Create/CreateForm.vue'),
    },
    {
        path: '/service/update',
        component: () => import('../components/Pages/Employees/Update/Form.vue'),
    },
    {
        path: '/service-category/show',
        component: () => import('../components/Pages/ServiceCategories/Show/index.vue'),
    },
    {
        path: '/service/edit-password',
        component: () => import('../components/Pages/Employees/EditPassword/Form.vue'),
    },

    // Patients

    {
        path: '/patients',
        component: () => import('../components/Pages/Patients/index.vue'),
    },
    {
        path: '/patient/create',
        component: () => import('../components/Pages/Patients/Create/Form.vue'),
    },
    {
        path: '/patient/update',
        component: () => import('../components/Pages/Patients/Update/Form.vue'),
    },
    {
        path: '/update',
        component: () => import('../components/Pages/Patients/Update/Form.vue'),
    },
    {
        path: '/patient/show',
        component: () => import('../components/Pages/Patients/Show/index.vue'),
    },
    {
        path: '/service/edit-password',
        component: () => import('../components/Pages/Employees/EditPassword/Form.vue'),
    },

    // Diseases

    {
        path: '/diseases',
        component: () => import('../components/Pages/Diseases/index.vue'),
    },
    {
        path: '/treatmetns',
        component: () => import('../components/Pages/Treatments/index.vue'),
    },

    // PaymentTypes

    {
        path: '/payment-types',
        component: () => import('../components/Pages/PaymentTypes/index.vue'),
    },

    // Payments
    {
        path: '/payments',
        component: () => import('../components/Pages/Payments/index.vue'),
    },




];



const router = createRouter({
    routes,
    history: createWebHashHistory(import.meta.env.BASE_URL)
})




export default router;
