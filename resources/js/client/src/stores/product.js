import axios, { api } from '@/lib/axios';
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
                const response = await axios.get(api(`/products?page=${page}`));
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
                await axios.post(api('/products'), product);
                this.router.replace({ name: 'product.list' });
            } catch (error) {
                if (error.response?.status === 422) {
                    this.productErrors = error.response.data.errors;
                }
            } finally {
                this.processing = false;
            }
        },

        async fetchProduct(id) {
            try {
                const response = await axios.get(api(`/products/${id}`));
                return response.data.data || response.data;
            } catch (error) {
                console.error('Error fetching product:', error);
                throw error;
            }
        },

        async updateProduct(product, id) {
            this.clearErrors();
            this.processing = true;
            try {
                if (product.image instanceof File) {
                    const formData = new FormData();
                    formData.append('_method', 'PATCH');
                    formData.append('title', product.title);
                    formData.append('price', product.price);
                    formData.append('description', product.description);
                    formData.append('image', product.image);

                    await axios.post(api(`/products/${id}`), formData);
                } else {
                    await axios.patch(api(`/products/${id}`), product);
                }

                this.router.replace({ name: 'product.list' });
            } catch (error) {
                if (error.response?.status === 422) {
                    this.productErrors = error.response.data.errors;
                }
            } finally {
                this.processing = false;
            }
        },

        async deleteProduct(id) {
            try {
                await axios.delete(api(`/products/${id}`));
                if (this.products.length === 1 && this.meta.current_page > 1) {
                    await this.fetchProducts(this.meta.current_page - 1);
                } else {
                    await this.fetchProducts(this.meta.current_page);
                }
            } catch (error) {
                console.error('Error deleting product:', error);
            }
        },
    },
});
