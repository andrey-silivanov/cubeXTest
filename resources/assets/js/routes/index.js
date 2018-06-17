import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Auth from '../pages/auth'
import Login from '../pages/auth/login'
import Register from '../pages/auth/register'
import Home from '../pages/home'

const routes = [
    {
        path: '/',
        redirect: { name: 'auth' }
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
                path: 'register',
                name: 'register',
                component: Register
            },
            {
                path: 'login',
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
    }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

export default router