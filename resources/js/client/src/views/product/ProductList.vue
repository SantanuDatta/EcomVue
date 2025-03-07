<template>
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <PageHeader
        title="List of Products"
        description="A list of all the products in your account including their name, title, email and role."
      />
      <PageButton :to="{ name: 'product.create' }">Add New Product</PageButton>
    </div>

    <BaseTable :columns="columns" :items="productStore.products">
      <template #row="{ item }">
        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
          <div class="h-11 w-11 flex-shrink-0">
            <img
              v-if="item.image"
              class="h-11 w-11 rounded-full"
              :src="item.image"
              :alt="item.title"
            />
            <PhotoIcon v-else class="h-11 w-11 rounded-full text-gray-300" />
          </div>
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
          {{ item.title }}
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
          {{ item.price }}
        </td>
        <td
          class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right space-x-2 text-sm font-medium sm:pr-6"
        >
          <RouterLink v-if="item" :to="{ name: 'product.edit', params: { id: item.id } }">
            Edit<span class="sr-only">, {{ item.title }}</span>
          </RouterLink>
          <button
            type="button"
            class="text-red-600 hover:text-red-900 cursor-pointer"
            @click="openDeleteModal(item)"
          >
            Delete<span class="sr-only">, {{ item.title }}</span>
          </button>
        </td>
      </template>
      <template #pagination>
        <TablePagination :store="productStore" />
      </template>
    </BaseTable>
    <DeleteModal
      :is-open="isDeleteModalOpen"
      title="Delete Product"
      message="Are you sure you want to delete this product?"
      @close="closeDeleteModal"
      @cancel="closeDeleteModal"
      @confirm="handleDeleteConfirm"
    />
  </div>
</template>

<script setup>
import BaseTable from '@/components/table/BaseTable.vue';
import TablePagination from '@/components/table/TablePagination.vue';
import PageHeader from '@/components/global/PageHeader.vue';
import PageButton from '@/components/global/PageButton.vue';
import DeleteModal from '@/components/global/BaseModal.vue';
import { useProductStore } from '@/stores/product';
import { onMounted, ref } from 'vue';
import { PhotoIcon } from '@heroicons/vue/24/outline';

const productStore = useProductStore();
const isDeleteModalOpen = ref(false);
const selectedProduct = ref(null);
const isDeleting = ref(false);
const errorMessage = ref('');

const columns = [
  { key: 'image', label: 'Image' },
  { key: 'title', label: 'Title' },
  { key: 'price', label: 'Price' },
  { key: 'actions', label: '' }
];

onMounted(async () => {
  await productStore.fetchProducts();
});

function openDeleteModal(product) {
  selectedProduct.value = product;
  isDeleteModalOpen.value = true;
  errorMessage.value = '';
}

function closeDeleteModal() {
  isDeleteModalOpen.value = false;
  selectedProduct.value = null;
  errorMessage.value = '';
}

async function handleDeleteConfirm() {
  if (!selectedProduct.value) return;

  isDeleting.value = true;
  try {
    await productStore.deleteProduct(selectedProduct.value.id);
    closeDeleteModal();
  } catch (error) {
    errorMessage.value = error.message || 'Error deleting product';
  } finally {
    isDeleting.value = false;
  }
}
</script>
