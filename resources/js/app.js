
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import Buefy from 'buefy';
// import 'buefy/dist/buefy.css';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(Buefy);
Vue.component('login-component', require('./components/login.vue').default);
Vue.component('teacher-login-component', require('./components/teacher-login.vue').default);
Vue.component('admin-login-component', require('./components/admin-login.vue').default);
const app = new Vue({
    el: '#app'
});
