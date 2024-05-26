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
    },
    {
        path: '/admin/words',
        component: () => import('../components/Pages/Words/index.vue')
    },
    {
        path: '/admin/word/create',
        component: () => import('../components/Pages/Words/create.vue')
    },
    {
        path: '/admin/word/update',
        component: () => import('../components/Pages/Words/update.vue')
    },
    {
        path: '/admin/save-words',
        component: () => import('../components/Pages/SavedWords/index.vue')
    },
    {
        path: '/admin/save-word/create',
        component: () => import('../components/Pages/SavedWords/create.vue')
    },
    {
        path: '/admin/save-word/update',
        component: () => import('../components/Pages/SavedWords/update.vue')
    },
    {
        path: '/admin/sources',
        component: () => import('../components/Pages/Sources/index.vue')
    },


];

const router = createRouter({
    routes,
    history: createWebHashHistory(import.meta.env.BASE_URL)
})

export default router;
