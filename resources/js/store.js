import Vue from 'vue';
import Vuex from 'vuex';

import toast from './store/toast.js';

Vue.use(Vuex);

const store = new Vuex.Store({
    // state: {
    //     toast: false
    // },
    // mutations: {
    //     ChangeToast(state) {
    //         state.toast = !state.toast;
    //     }
    // },
    // actions: {
    //     ChangeToast({ commit }) {
    //         commit('ChangeToast');
    //     }
    // },
    modules: {
        toast: toast
    }
});

export default store;
