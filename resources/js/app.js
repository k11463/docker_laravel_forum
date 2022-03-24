require('./bootstrap');
// import Vue from 'vue';

// window.Vue = require('vue').default;

import Vue from 'vue';

// import router from './router.js'
// import VueRouter from 'vue-router';
import store from './store.js';

window.Vue = Vue;
window.bootstrap = require('bootstrap/dist/js/bootstrap.bundle.js');
// Vue.use(VueRouter);

Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('toast', require('./components/Toast.vue').default);

Vue.component('home', require('./pages/Home.vue').default);
Vue.component('post', require('./pages/Post.vue').default);
Vue.component('signup', require('./pages/Signup.vue').default);
Vue.component('login', require('./pages/Login.vue').default);
Vue.component('create-post', require('./pages/CreatePost.vue').default);
Vue.component('edit-post', require('./pages/EditPost.vue').default);
Vue.component('single-post', require('./pages/SinglePost.vue').default);

const app = new Vue({
    el: '#app',
    store,
});
