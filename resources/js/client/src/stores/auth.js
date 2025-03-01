import axios, { api } from '@/lib/axios';
import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        authUser: null,
        isAuthenticated: false,
        processing: false,
        isSessionVerified: false,
        authErrors: {},
    }),
    getters: {
        user: (state) => state.authUser,
        authenticated: (state) => state.isAuthenticated,
        errors: (state) => state.authErrors,
    },
    actions: {
        async verifySession() {
            if (!this.isAuthenticated && !this.isSessionVerified) {
                await this.fetchUser();
            }
        },
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
            try {
                const response = await axios.get(api('/user'));
                this.authUser = response.data;
                this.isAuthenticated = true;
            } catch (error) {
                this.cleanState();
            } finally {
                this.processing = false;
                this.isSessionVerified = true;
            }
        },
        async register(data) {
            this.clearErrors();
            this.processing = true;
            try {
                await this.fetchCsrfCookie();
                await axios.post(api('/register'), data);
                await this.fetchUser();
                this.router.replace({ name: 'app.dashboard' });
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
            this.processing = true;
            try {
                await this.fetchCsrfCookie();
                await axios.post(api('/login'), data);
                await this.fetchUser();
                this.router.replace({ name: 'app.dashboard' });
            } catch (error) {
                console.log(error);
                if (error.response?.status === 422) {
                    this.authErrors = error.response.data.errors;
                }
            } finally {
                this.processing = false;
            }
        },
        async logout() {
            try {
                await axios.post(api('/logout'));
            } finally {
                this.cleanState();
                this.clearErrors();
                this.router.replace({ name: 'login' });
            }
        },
    },
});
