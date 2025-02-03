<template>
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <TableTitle
        title="Products"
        description="A list of all the products in your account including their name, title, email and role."
      />
      <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <button
          type="button"
          class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        >
          Add New Product
        </button>
      </div>
    </div>

    <BaseTable :columns="columns" :items="productStore.products">
      <template #row="{ item }">
        <td
          class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
        >
          <div class="h-11 w-11 flex-shrink-0">
            <img class="h-11 w-11 rounded-full" :src="item.image" alt="" />
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
          <a href="#" class="text-indigo-600 hover:text-indigo-900">
            Edit<span class="sr-only">, {{ item.title }}</span>
          </a>
          <a href="#" class="text-red-600 hover:text-red-900">
            Delete<span class="sr-only">, {{ item.title }}</span>
          </a>
        </td>
      </template>

      <template #pagination>
        <TablePagination :store="productStore" />
      </template>
    </BaseTable>
  </div>
</template>

<script setup>
import BaseTable from "@/components/table/BaseTable.vue";
import TablePagination from "@/components/table/TablePagination.vue";
import TableTitle from "@/components/table/TableTitle.vue";
import { useProductStore } from "@/stores/product";
import { onMounted } from "vue";

const productStore = useProductStore();

const columns = [
  { key: "image", label: "Image" },
  { key: "title", label: "Title" },
  { key: "price", label: "Price" },
  { key: "actions", label: "" },
];

onMounted(async () => {
  await productStore.fetchProducts();
});
</script>
