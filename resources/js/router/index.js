import { createRouter, createWebHashHistory } from 'vue-router';
import siteRoutes from './routes.js';
import docs from './docs.js';

const routes = Object.assign(siteRoutes, docs);
const router = createRouter({
    routes,
    history: createWebHashHistory(import.meta.env.BASE_URL)
})

export default router;
