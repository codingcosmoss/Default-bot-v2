export default[

    // Docs routes start
    {
        path: '/admin/docs/dashboard',
        permission: 'public',
        component: () => import('@/pages/Docs/Dashboard.vue'),
    },
    {
        path: '/reset-password',
        permission: 'public',
        component: () => import('../pages/ResetPassword/index.vue'),
    },
    {
        path: '/admin/docs/tables',
        permission: 'public',
        component: () => import('@/pages/Docs/Tables.vue'),
    },
    {
        path: '/admin/docs/forms',
        permission: 'public',
        component: () => import('@/pages/Docs/Forms.vue'),
    },
    // Docs Routes finished

    // DASHBOARD
    {
        path: '/',
        permission: 'public',
        component: () => import('@/pages/Loader/index.vue'),
    },
    {
        path: '/login',
        permission: 'public',
        component: () => import('../pages/Login/index.vue'),
    },
    {
        path: '/redirect',
        permission: 'public',
        component: () => import('../pages/LoginLoader/index.vue'),
    },
    {
        path: '/register',
        permission: 'public',
        component: () => import('@/pages/Register/index.vue'),
    },
    {
        path: '/error',
        permission: 'public',
        component: () => import('../pages/Error/index.vue'),
    },
    {
        path: '/:pathMatch(.*)*',
        permission: 'public',
        component: () => import('../pages/NotFount/index.vue'),
    },

    // Qolgan barcha admin panel routlari admin so'zidan keyin ketadi
    {
        path: '/admin',
        permission: 'public',
        component: () => import('../pages/Dashboard/index.vue'),
    },
    {
        path: '/admin/profile',
        permission: 'public',
        component: () => import('../pages/Profile/index.vue'),
    },
    {
        path: '/admin/users',
        permission: 'Employees-index',
        component: () => import('../pages/Users/index.vue'),
    },
    {
        path: '/admin/users/show',
        permission: 'Employees-index',
        component: () => import('../pages/Users/show.vue'),
    },
    {
        path: '/admin/roles',
        permission: 'Role&Permissions-index',
        component: () => import('../pages/Roles/index.vue'),
    },
    {
        path: '/admin/roles/create',
        permission: 'Role&Permissions-create',
        component: () => import('../pages/Roles/create.vue'),
    },
    {
        path: '/admin/roles/update',
        permission: 'Role&Permissions-update',
        component: () => import('../pages/Roles/update.vue'),
    },
    {
        path: '/admin/settings',
        permission: 'Settings-index',
        component: () => import('../pages/Settings/index.vue'),
    },
   
]
