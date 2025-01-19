import { useAuthStore } from '@/stores/auth';
import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/app',
        name: 'app',
        component: () => import('@/layouts/AppLayout.vue'),
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                path: 'dashboard',
                name: 'app.dashboard',
                component: () => import('@/views/Dashboard.vue'),
                meta: {
                    title: 'Dashboard',
                },
            },
        ],
    },
    {
        path: '/',
        name: 'home',
        component: () => import('@/views/Home.vue'),
        meta: {
            title: 'Home',
        },
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('@/views/auth/Login.vue'),
        meta: {
            title: 'Login',
            requiresGuest: true,
        },
    },
    {
        path: '/register',
        name: 'register',
        component: () => import('@/views/auth/Register.vue'),
        meta: {
            title: 'Register',
            requiresGuest: true,
        },
    },
    {
        path: '/forgot-password',
        name: 'forgetPassword',
        component: () => import('@/views/auth/ForgotPassword.vue'),
        meta: {
            title: 'Forgot Password',
            requiresGuest: true,
        },
    },
    {
        path: '/reset-password',
        name: 'resetPassword',
        component: () => import('@/views/auth/ResetPassword.vue'),
        meta: {
            title: 'Reset Password',
            requiresGuest: true,
        },
    },
    {
        path: '/page-not-found',
        name: 'pageNotFound',
        component: () => import('@/views/error/404.vue'),
        meta: {
            title: 'Page Not Found',
        },
    },
    {
        path: '/:pathMatch(.*)*',
        redirect: '/page-not-found',
        meta: {
            requiresGuest: true,
        },
    },
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

router.beforeEach(async (to, from, next) => {
    const authStore = useAuthStore();

    if (authStore.isAuthenticated && to.meta.requiresGuest) {
        return next({ name: 'app.dashboard' });
    }

    if (to.meta.requiresAuth) {
        try {
            await authStore.fetchUser();
            next();
        } catch (error) {
            return next({ name: 'login' });
        }
    } else {
        next();
    }
});

export default router;
