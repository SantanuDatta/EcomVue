import router from '@/router';
import { useAuthStore } from '@/stores/auth';
import Axios, { AxiosError } from 'axios';

const axios = Axios.create({
    baseURL: import.meta.env.VITE_API_BASE_URL,
    withCredentials: true,
    withXSRFToken: true,
});

axios.interceptors.response.use(
    (response) => response,
    async (error) => {
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
