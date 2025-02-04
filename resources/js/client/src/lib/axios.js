import router from '@/router';
import { useAuthStore } from '@/stores/auth';
import { useProgressStore } from '@/stores/global/progress';
import Axios, { AxiosError } from 'axios';

const axios = Axios.create({
    baseURL: import.meta.env.VITE_API_BASE_URL,
    withCredentials: true,
    withXSRFToken: true,
});

axios.interceptors.request.use(
    (config) => {
        useProgressStore().start();
        return config;
    },
    (error) => {
        useProgressStore().done();
        return Promise.reject(error);
    }
);

axios.interceptors.response.use(
    (response) => {
        useProgressStore().done();
        return response;
    },
    async (error) => {
        useProgressStore().done();
        const authStore = useAuthStore();

        switch (error instanceof AxiosError && error.response?.status) {
            case 401:
                authStore.cleanState();
                router.replace({ name: 'login' });
                break;
            case 404:
                router.replace({ name: 'pageNotFound' });
                break;
            case 419:
                authStore.cleanState();
                router.replace({ name: 'login' });
                break;
            case 500:
                router.replace({ name: 'internalServerError' });
                break;
        }
        return Promise.reject(error);
    }
);

export default axios;
