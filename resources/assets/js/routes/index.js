import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Auth from '../pages/auth'
import Login from '../pages/auth/login'
import Register from '../pages/auth/register'
import User from '../pages/user'
import Admin from '../pages/admin'
import oneMessage from '../pages/admin/one-message'
import NotFound from '../pages/error/notFoundPage'
import ForbiddenPage from '../pages/error/forbidden'

const routes = [
  {
    path: '/',
    redirect: {name: 'login'}
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
    path: '/user',
    name: 'user',
    component: User,
    meta: {
      auth: {
        roles: 'user',
        redirect: {name: 'login'},
        forbiddenRedirect: '/403'
      }
    }
  },
  {
    path: '/admin',
    name: 'admin',
    component: Admin,
    meta: {
      auth: true
    }
  },
  {
    path: '/message/:id',
    name: 'oneMessage',
    component: oneMessage
  },
  {
    path: '/403',
    name: '403',
    component: ForbiddenPage,
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