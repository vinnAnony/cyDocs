import Vue from 'vue'
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Login from "../components/auth/Login";
import SignUp from "../components/auth/SignUp";
import Welcome from "../components/pages/Welcome";
import Dashboard from "../components/pages/Dashboard";


const routes = [
    {
        path: '/',
        name: 'welcome',
        component: Vue.component("welcome-component", Welcome),
        meta: {
            guest: true
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Vue.component("login-component",Login),
        meta: {
            guest: true
        }
    },
    {
        path: '/signup',
        name: 'signup',
        component: Vue.component("signup-component",SignUp),
        meta: {
            guest: true
        }
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Vue.component("dashboard-component",Dashboard),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '*',
        redirect: '/'
    },
];

const router = new VueRouter({
    routes,
    mode: 'history',
    linkExactActiveClass: "text-white bg-indigo-600 rounded",

});

// Meta Handling
router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('cyDocsToken');
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!token){
            next({ name: 'login' });
        }
        else {
            next();
        }
    }else if (to.matched.some(record => record.meta.guest)) {
        if (localStorage.getItem('cyDocsToken') == null) {
            next()
        } else {
            next({ name: 'welcome' })
        }
    }else if (to.matched.some(record => record.meta.requiresAdmin)) {
        if (localStorage.getItem('cyDocsToken') !== null) {
            if (JSON.parse(localStorage.getItem('user')).isAdmin) {
                next()
            }else {
                next({ name: 'dashboard' })
            }
            next()
        } else {
            next({ name: 'login' })
        }
    }else {
        next()
    }


});

export default router
