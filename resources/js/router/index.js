import Vue from 'vue'
import VueRouter from 'vue-router';
Vue.use(VueRouter);


import Index from "../components/pages/Index";
import Home from "../components/pages/Home";
import Subscriptions from "../components/pages/Subscriptions";
import Favourites from "../components/pages/Favourites";
import MovieDetails from "../components/pages/MovieDetails";
import Account from "../components/pages/auth/Account";
import Dashboard from "../components/pages/admin/Dashboard";

import Admin from "../components/pages/admin/Admin";
import AdminMovies from "../components/pages/admin/AdminMovies";
import AdminUsers from "../components/pages/admin/AdminUsers";
import AdminSubscriptions from "../components/pages/admin/AdminSubscriptions";
import AdminGenres from "../components/pages/admin/AdminGenres";


const routes = [
    {
        path: '/',
        component: Vue.component("index-component", Index),
        children: [
            {
                path: '',
                name: 'home',
                component: Vue.component("home-component", Home),
            },
            {
                path: '/account',
                name: 'account',
                component: Vue.component("account-component",Account),
                meta: {
                    guest: true
                }
            },
            {
                path: '/subscriptions',
                name: 'subscriptions',
                component: Vue.component("subscriptions-component",Subscriptions),
                meta: {
                    requiresAuth: true
                }
            },
            {
                path: '/favourites',
                name: 'favourites',
                component: Vue.component("favourites-component",Favourites),
                meta: {
                    requiresAuth: true
                }
            },
            {
                path: '/movie-details',
                name: 'movie-details',
                component: Vue.component("detailed-component",MovieDetails),
                props: true,
                meta: {
                    requiresAuth: true
                }
            },
        ]
    },
    {
        path: '/admin',
        component: Vue.component("admin-component",Admin),
        meta: {
            requiresAdmin: true
        },
        children: [
            {
                path: '',
                name: 'dashboard',
                component: Vue.component("dashboard-component",Dashboard),
            },
            {
                path: 'movies',
                name: 'admin-movies',
                component: Vue.component("admin-movies-component",AdminMovies),
            },
            {
                path: 'users',
                name: 'admin-users',
                component: Vue.component("admin-users-component",AdminUsers),
            },
            {
                path: 'genres',
                name: 'admin-genres',
                component: Vue.component("admin-genres-component",AdminGenres),
            },
            {
                path: 'subscriptions',
                name: 'admin-subscriptions',
                component: Vue.component("admin-subscriptions-component",AdminSubscriptions),
            },
        ]
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
    const token = localStorage.getItem('jwToken');
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!token){
            next({ name: 'account' });
        }
        else {
            next();
        }
    }else if (to.matched.some(record => record.meta.guest)) {
        if (localStorage.getItem('jwToken') == null) {
            next()
        } else {
            next({ name: 'home' })
        }
    }else if (to.matched.some(record => record.meta.requiresAdmin)) {
        if (localStorage.getItem('jwToken') !== null) {
            if (JSON.parse(localStorage.getItem('user')).isAdmin) {
                next()
            }else {
                next({ name: 'dashboard' })
            }
            next()
        } else {
            next({ name: 'account' })
        }
    }else {
        next()
    }


});

export default router