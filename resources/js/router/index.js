import { createRouter, createWebHashHistory } from 'vue-router';


const routes = [

    // DASHBOARD
    {
        path: '/',
        component: () => import('../components/App.vue'),
    },
  
    {
        path: '/:pathMatch(.*)*',
        component: () => import('../components/App.vue'),
    },

];



const router = createRouter({
    routes,
    history: createWebHashHistory(import.meta.env.BASE_URL)
})




export default router;
