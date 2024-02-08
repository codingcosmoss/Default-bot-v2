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
        component: () => import('../components/Pages/Employees/Form/Form.vue'),
    },
    {
        path: '/employees/update',
        component: () => import('../components/Pages/Employees/Update/Form.vue'),
    },

];



const router = createRouter({
    routes,
    history: createWebHashHistory(import.meta.env.BASE_URL)
})




export default router;
