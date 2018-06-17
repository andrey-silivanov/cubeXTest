import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Auth from '../pages/auth'
import Login from '../pages/auth/login'
import Register from '../pages/auth/register'

const routes = [
    {
        path: '/',
        redirect: { name: 'auth' }
    },
    {
        path: '/auth',
        name: 'auth',
        component: Auth,
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
    }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

export default router