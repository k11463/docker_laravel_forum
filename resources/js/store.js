import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        toast: false
    },
    mutations: {
        ChangeToast(state) {
            state.toast = !state.toast;
        }
    },
    actions: {
        ChangeToast({ commit }) {
            commit('ChangeToast');
        }
    },
})

export default store;
