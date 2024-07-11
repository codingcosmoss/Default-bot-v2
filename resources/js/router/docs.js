export default[

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

]
