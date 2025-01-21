import { useAuthStore } from '@/stores/auth';
import Axios from 'axios';

const axios = Axios.create({
    baseURL: import.meta.env.VITE_API_BASE_URL,
    withCredentials: true,
    withXSRFToken: true,
});

axios.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response?.status === 401) {
            const authStore = useAuthStore();
            authStore.authUser = null;
            authStore.isAuthenticated = false;

            if (router.currentRoute.value.name !== 'login') {
                router.push({ name: 'login' });
            }
        }
        return Promise.reject(error);
    }
);

export default axios;
