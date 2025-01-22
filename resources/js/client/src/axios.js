import router from '@/router';
import Axios, { AxiosError } from 'axios';

const axios = Axios.create({
    baseURL: import.meta.env.VITE_API_BASE_URL,
    withCredentials: true,
    withXSRFToken: true,
});

axios.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error instanceof AxiosError && error.response?.status === 401) {
            router.replace({ name: 'login' });
        }
        return Promise.reject(error);
    }
);

export default axios;
