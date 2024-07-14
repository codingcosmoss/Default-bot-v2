import { createRouter, createWebHashHistory } from 'vue-router';
import routesArr from './routes.js';
import docs from './docs.js';
import {GetPermissionUser, users} from "@/helpers/api.js";

let routes = [];
let permissions = [];
async function fetchUserPermissions() {
    try {
        const response = await GetPermissionUser();
        permissions = response.data.permissions;
        localStorage.setItem('user', JSON.stringify(response.data));
    } catch (error) {
        permissions = [];
        console.error('Error fetching permissions:', error);
    }
}

await fetchUserPermissions();

routesArr.forEach(route => {
    // routes.push(route);
    if (route.permission === 'public' || permissions.includes(route.permission)) {
        routes.push(route);
    }
});

const router = createRouter({
    history: createWebHashHistory(import.meta.env.BASE_URL),
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        } else {
            return { top: 0, left: 0 };
        }
    }
});

export default router;
