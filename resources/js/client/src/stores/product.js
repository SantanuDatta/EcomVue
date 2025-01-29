import axios from '@/lib/axios';
import { defineStore } from 'pinia';

export const useProductStore = defineStore('product', {
    state: () => ({
        products: [],
    }),
    actions: {
        async fetchProducts() {
            try {
                const response = await axios.get('/api/products');
                this.products = response.data.data;
            } catch (error) {
                console.error(error);
            }
        },
    },
});
