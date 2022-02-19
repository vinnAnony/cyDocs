import Vue from 'vue'
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Login from "../components/auth/Login";
import SignUp from "../components/auth/SignUp";
import Welcome from "../components/pages/Welcome";
import Dashboard from "../components/pages/Dashboard";
import MyDocuments from "../components/pages/MyDocuments";
import FileManager from "../components/pages/FileManager";
import FileRequests from "../components/pages/FileRequests";
import Users from "../components/pages/Users";
import Configuration from "../components/pages/Configuration";
import NewFileRequest from "../components/pages/NewFileRequest";
import IncomingFileRequests from "../components/pages/IncomingFileRequests";


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
        path: '/my-documents',
        name: 'my-documents',
        component: Vue.component("my-documents-component",MyDocuments),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/file-manager',
        name: 'file-manager',
        component: Vue.component("file-manager-component",FileManager),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/file-requests',
        name: 'file-requests',
        component: Vue.component("file-requests-component",FileRequests),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/incoming-file-requests',
        name: 'incoming-file-requests',
        component: Vue.component("incoming-file-requests-component",IncomingFileRequests),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/file-requests/create',
        name: 'new-file-request',
        component: Vue.component("new-file-request-component",NewFileRequest),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/users',
        name: 'users',
        component: Vue.component("users-component",Users),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/configuration',
        name: 'configuration',
        component: Vue.component("configuration-component",Configuration),
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
