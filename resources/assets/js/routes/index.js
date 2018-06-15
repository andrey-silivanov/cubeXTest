import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login from './../pages/login'
import Register from './../pages/register'

const routes = [
    {
        path: '/',
        redirect: { name: 'login' }
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
]

const router = new VueRouter({
    mode: 'history',
    routes
})

export default router