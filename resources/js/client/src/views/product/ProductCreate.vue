<template>
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <PageHeader
        title="Create New Product"
        description="A list of all the products in your account including their name, title, email and role."
      />
      <PageButton :to="{ name: 'product.list' }"
        >Back to Product List</PageButton
      >
    </div>
    <Card>
      <form
        class="space-y-6"
        method="POST"
        @submit.prevent="productStore.createProduct(form)"
      >
        <div class="grid md:grid-flow-col grid-rows-1 gap-4">
          <div class="col-span-1 md:col-span-6 space-y-2">
            <label
              for="title"
              class="block text-sm font-medium leading-6 text-gray-900"
              >Product Name</label
            >
            <input
              id="title"
              type="text"
              v-model="form.title"
              class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-xs ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            />
            <label
              for="price"
              class="block text-sm font-medium leading-6 text-gray-900"
              >Price</label
            >
            <input
              id="price"
              type="text"
              v-model="form.price"
              class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-xs ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            />
            <label
              for="description"
              class="block text-sm font-medium leading-6 text-gray-900"
              >Description</label
            >
            <textarea
              name="description"
              id="description"
              rows="3"
              v-model="form.description"
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
            />
          </div>
          <div class="col-span-1 space-y-2">
            <label
              for="file-upload"
              class="block text-sm font-medium leading-6 text-gray-900"
              >Upload Image</label
            >
            <div
              class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10"
            >
              <div class="text-center">
                <PhotoIcon
                  class="mx-auto size-12 text-gray-300"
                  aria-hidden="true"
                />
                <div class="mt-4 flex text-sm/6 text-gray-600">
                  <label
                    for="file-upload"
                    class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-indigo-500"
                  >
                    <span>Upload an image</span>
                    <input
                      id="file-upload"
                      name="image"
                      type="file"
                      @change="(file) => (form.image = file)"
                      class="sr-only"
                    />
                  </label>
                  <p class="pl-1">or drag and drop</p>
                </div>
                <p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
              </div>
            </div>
          </div>
        </div>
        <div class="grid place-items-end w-full">
          <button
            class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
          >
            Add New Product
          </button>
        </div>
      </form>
    </Card>
  </div>
</template>

<script setup>
import PageHeader from "@/components/global/PageHeader.vue";
import PageButton from "@/components/global/PageButton.vue";
import Card from "@/components/global/Card.vue";
import { PhotoIcon } from "@heroicons/vue/24/solid";
import { useProductStore } from "@/stores/product";
import { ref } from "vue";

const productStore = useProductStore();

const form = ref({
  title: "",
  price: "",
  image: "",
  description: "",
});
</script>
