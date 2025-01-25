import axios from '@/lib/axios';
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
        authenticated: (state) => state.isAuthenticated,
        errors: (state) => state.authErrors,
    },
    actions: {
        async clearErrors() {
            this.authErrors = {};
        },
        async fetchCsrfCookie() {
            await axios.get('/sanctum/csrf-cookie');
        },
        async cleanState() {
            this.authUser = null;
            this.isAuthenticated = false;
        },
        async fetchUser() {
            if (this.processing) return;
            this.processing = true;
            try {
                const response = await axios.get('/api/user');
                this.authUser = response.data;
                this.isAuthenticated = true;
            } catch (error) {
                this.cleanState();
            } finally {
                this.processing = false;
            }
        },
        async register(data) {
            this.clearErrors();
            await this.fetchCsrfCookie();
            this.processing = true;
            try {
                await axios.post('/register', data);
                await this.fetchUser();
                router.replace({ name: 'app.dashboard' });
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
                router.replace({ name: 'app.dashboard' });
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
                this.cleanState();
                this.clearErrors();
                router.replace({ name: 'login' });
            }
        },
    },
});
