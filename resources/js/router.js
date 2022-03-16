import VueRouter from 'vue-router';

import Home from './pages/Home';
import Signup from './pages/Signup';
import Login from './pages/Login';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/signup',
            name: 'signup',
            component: Signup,
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
    ],
});

export default router;
