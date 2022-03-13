import VueRouter from 'vue-router';

import Home from './pages/Home';
import Signup from './pages/Signup';
import Signin from './pages/Signin';

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
            path: '/signin',
            name: 'signin',
            component: Signin,
        },
    ],
});

export default router;
