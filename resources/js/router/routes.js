export default[
    // DASHBOARD
    {
        path: '/',
        component: () => import('@/pages/Loader/index.vue'),
    },
    {
        path: '/login',
        component: () => import('@/pages/Login/index.vue'),
    },
    {
        path: '/register',
        component: () => import('@/pages/Register/index.vue'),
    },
    {
        path: '/admin',
        component: () => import('@/pages/Dashboard/index.vue'),
    },
    {
        path: '/:pathMatch(.*)*',
        component: () => import('@/pages/Error/index.vue')
    },
    // Qolgan barcha admin panel routlari admin so'zidan keyin ketadi
    {
        path: '/admin',
        component: () => import('@/pages/Dashboard/index.vue'),
    },
]
