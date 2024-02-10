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

];



const router = createRouter({
    routes,
    history: createWebHashHistory(import.meta.env.BASE_URL)
})




export default router;
