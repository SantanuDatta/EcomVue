import axios from '@/axios';
import router from '@/router';
import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        authUser: null,
        isAuthenticated: false,
        processing: false,
        authErrors: {},
    }),
    getters: {
        user: (state) => state.authUser,
        errors: (state) => state.authErrors,
    },
    actions: {
        async clearErrors() {
            this.authErrors = {};
        },
        async fetchCsrfCookie() {
            await axios.get('/sanctum/csrf-cookie');
        },
        async fetchUser() {
            const response = await axios.get('/api/user');
            this.authUser = response.data;
            this.isAuthenticated = true;
            return response;
        },
        async register(data) {
            this.clearErrors();
            await this.fetchCsrfCookie();
            this.processing = true;
            try {
                await axios.post('/register', data);
                await this.fetchUser();
                router.push({ name: 'app.dashboard' });
            } catch (error) {
                if (error.response?.status === 422) {
                    this.authErrors = error.response.data.errors;
                }
            } finally {
                this.processing = false;
            }
        },
        async login(data) {
            this.clearErrors();
            await this.fetchCsrfCookie();
            this.processing = true;
            try {
                await axios.post('/login', data);
                await this.fetchUser();
                router.push({ name: 'app.dashboard' });
            } catch (error) {
                if (error.response?.status === 422) {
                    this.authErrors = error.response.data.errors;
                }
            } finally {
                this.processing = false;
            }
        },
        async logout() {
            try {
                await axios.post('/logout');
            } finally {
                this.authUser = null;
                this.isAuthenticated = false;
                this.clearErrors();
                router.push({ name: 'login' });
            }
        },
    },
});
