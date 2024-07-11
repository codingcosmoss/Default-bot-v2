export default[

    // Docs routes start
    {
        path: '/admin/docs/dashboard',
        component: () => import('@/pages/Docs/Dashboard.vue'),
    },
    {
        path: '/admin/docs/tables',
        component: () => import('@/pages/Docs/Tables.vue'),
    },
    {
        path: '/admin/docs/forms',
        component: () => import('@/pages/Docs/Forms.vue'),
    },
    // Docs Routes finished

    // DASHBOARD
    {
        path: '/',
        component: () => import('@/pages/Loader/index.vue'),
    },
    {
        path: '/login',
        component: () => import('../pages/Login/index.vue'),
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
        component: () => import('@/pages/Loader/index.vue'),
    },

    // Qolgan barcha admin panel routlari admin so'zidan keyin ketadi
    {
        path: '/admin',
        component: () => import('@/pages/Dashboard/index.vue'),
    },
]
