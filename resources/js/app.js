require('./bootstrap');
import Vue from 'vue';
window.Vue = require('vue').default;

Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('home', require('./pages/Home.vue').default);

const app = new Vue({
    el: '#app',
});
