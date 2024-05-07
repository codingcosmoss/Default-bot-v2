import { createRouter, createWebHashHistory } from 'vue-router';

const routes = [

    // DASHBOARD
    {
        path: '/',
        component: () => import('../components/Main/index.vue'),
    },
    {
        path: '/login',
        component: () => import('../components/Pages/Login/index.vue'),
    },
    {
        path: '/register',
        component: () => import('../components/Pages/Register/index.vue'),
    },
    {
        path: '/:pathMatch(.*)*',
        component: () => import('../components/Pages/Error/index.vue')
    },

    {
        path: '/admin',
        component: () => import('../components/Pages/Dashboard/index.vue'),
    },
    {
        path: '/admin/topic',
        component: () => import('../components/Pages/Topic/index.vue')
    }


];

const router = createRouter({
    routes,
    history: createWebHashHistory(import.meta.env.BASE_URL)
})

export default router;
