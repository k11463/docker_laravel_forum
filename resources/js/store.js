import Vue from 'vue';
import Vuex from 'vuex';

import toast from './store/toast.js';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {

    },
    mutations: {

    },
    actions: {
        SetToast({ commit }, payload) {
            window.localStorage.setItem("toast_status", payload.status);
            window.localStorage.setItem("toast_title", payload.title);
            window.localStorage.setItem("toast_content", payload.content);
        },
    },
    modules: {
        toast: toast
    }
});

export default store;
