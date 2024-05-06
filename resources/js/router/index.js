import { createRouter, createWebHashHistory } from 'vue-router';

const routes = [

    // DASHBOARD
    {
        path: '/',
        component: () => import('../components/Pages/Dashboard/index.vue'),
    },
    {
        path: '/login',
        component: () => import('../components/Pages/Login/index.vue'),
    },
    {
        path: '/:pathMatch(.*)*',
        component: () => import('../components/Pages/Dashboard/index.vue')
    },


];

const router = createRouter({
    routes,
    history: createWebHashHistory(import.meta.env.BASE_URL)
})

export default router;
