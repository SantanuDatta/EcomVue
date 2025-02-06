import axios from '@/lib/axios';
import { createBasePaginationState } from '@/stores/global/pagination';
import { defineStore } from 'pinia';

export const useProductStore = defineStore('product', {
    state: () => ({
        products: [],
        ...createBasePaginationState(),
        productErrors: {},
        processing: false,
    }),

    getters: {
        errors: (state) => state.productErrors,
    },

    actions: {
        async clearErrors() {
            this.productErrors = {};
        },
        async fetchProducts(page = 1) {
            try {
                const response = await axios.get(`/api/products?page=${page}`);
                this.products = response.data.data;
                this.meta = response.data.meta;
                this.links = response.data.links;
            } catch (error) {
                console.error('Error fetching products:', error);
            }
        },

        async goToPage(page) {
            await this.fetchProducts(page);
        },

        async createProduct(product) {
            this.clearErrors();
            this.processing = true;
            try {
                if (product.image instanceof File) {
                    const form = new FormData();
                    form.append('title', product.title);
                    form.append('image', product.image);
                    form.append('description', product.description);
                    form.append('price', product.price);
                    product = form;
                }
                await axios.post('/api/products', product);
                this.router.replace({ name: 'product.list' });
            } catch (error) {
                if (error.response?.status === 422) {
                    this.productErrors = error.response.data.errors;
                }
            } finally {
                this.processing = false;
            }
        },
    },
});
