import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Auth from '../pages/auth'
import Login from '../pages/auth/login'
import Register from '../pages/auth/register'
import Home from '../pages/home'
import NotFound from '../pages/error/notFoundPage'

const routes = [
    {
        path: '/',
        redirect: { name: 'login' }
    },
    {
        path: '/auth',
        name: 'auth',
        component: Auth,
        meta: {
            auth: false
        },
        children: [
            {
                path: '/register',
                name: 'register',
                component: Register
            },
            {
                path: '/login',
                name: 'login',
                component: Login
            }
        ]
    },
    {
        path: '/home',
        name: 'home',
        component: Home,
        meta: {
            auth: true
        }
    },
    {
        path: '/404',
        name: '404',
        component: NotFound,
    },
    {
        path: '*',
        redirect: '/404'
    }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

export default router