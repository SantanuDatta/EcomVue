import './assets/index.css';

import { createApp, markRaw } from 'vue';
import { createPinia } from 'pinia';

import App from './App.vue';
import router from './router';
import { useAuthStore } from '@/stores/auth';

const app = createApp(App);
const pinia = createPinia();

app.use(
    pinia.use(({ store }) => {
        store.router = markRaw(router);
    })
);
const authStore = useAuthStore();

authStore.fetchUser().then(() => {
    app.use(router);
    app.mount('#app');
});
