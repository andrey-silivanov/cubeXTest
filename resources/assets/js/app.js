
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Vuesax from 'vuesax'
import 'vuesax/dist/vuesax.css' //vuesax styles

import axios from 'axios';
import VueAxios from 'vue-axios';

Vue.use(VueAxios, axios);
axios.defaults.baseURL = 'http://127.0.0.1:8000/api';

Vue.use(Vuesax, {
    theme:{
        colors:{
            primary:'#5b3cc4',
            success:'#1EC787',
            danger:'rgb(242, 19, 93)',
            warning:'rgb(255, 130, 0)',
            dark:'rgb(36, 33, 69)'
        }
    }
})

import Router from './routes'
import App from './App'

Vue.router = Router

Vue.use(require('@websanova/vue-auth'), {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
    authRedirect: '/auth/login'
})

App.router = Vue.router

new Vue(App).$mount('#app');
