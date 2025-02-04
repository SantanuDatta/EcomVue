import { useAuthStore } from '@/stores/auth';
import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/app',
        name: 'app',
        component: () => import('@/layouts/AppLayout.vue'),
        meta: {
            auth: true,
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
            {
                path: 'products',
                name: 'app.products',
                component: () => import('@/views/product/ProductList.vue'),
                meta: {
                    title: 'Products',
                },
            }
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
            guest: true,
        },
    },
    {
        path: '/register',
        name: 'register',
        component: () => import('@/views/auth/Register.vue'),
        meta: {
            title: 'Register',
            guest: true,
        },
    },
    {
        path: '/forgot-password',
        name: 'forgetPassword',
        component: () => import('@/views/auth/ForgotPassword.vue'),
        meta: {
            title: 'Forgot Password',
            guest: true,
        },
    },
    {
        path: '/reset-password',
        name: 'resetPassword',
        component: () => import('@/views/auth/ResetPassword.vue'),
        meta: {
            title: 'Reset Password',
            guest: true,
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
        path: '/internal-server-error',
        name: 'internalServerError',
        component: () => import('@/views/error/500.vue'),
        meta: {
            title: 'Internal Server Error',
        }
    },
    {
        path: '/:pathMatch(.*)*',
        redirect: '/page-not-found',
        meta: {
            guest: true,
        },
    },
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

router.beforeEach(async (to, from) => {
    const authStore = useAuthStore();

    await authStore.verifySession()

    if (authStore.user && to.meta.guest) {
        return { name: 'app.dashboard' };
    }

    if (!authStore.user && to.meta.auth) {
        return { name: 'login' };
    }
});

router.afterEach((to) => {
    const appName = import.meta.env.VITE_APP_NAME;
    const title = to.meta.title ? `${appName} | ${to.meta.title}` : appName;
    document.title = title;
});

export default router;
