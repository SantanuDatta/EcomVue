<template>
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <PageHeader title="Edit Product" description="Edit the details of your product." />
      <PageButton :to="{ name: 'product.list' }"> Back to Product List </PageButton>
    </div>
    <Card>
      <form class="space-y-6" method="POST" @submit.prevent="handleUpdate">
        <div class="grid md:grid-flow-col grid-rows-1 gap-4">
          <div class="col-span-1 md:col-span-6 space-y-2">
            <TextLabel for="title">Product Name</TextLabel>
            <TextInput
              id="title"
              v-model="form.title"
              type="text"
              :class="{
                'border-red-500 focus:ring-red-500': productStore.errors.title
              }"
            />
            <ErrorLabel :errors="productStore.errors.title" />

            <TextLabel for="price">Price</TextLabel>
            <TextInput
              id="price"
              v-model="form.price"
              type="text"
              :class="{
                'border-red-500 focus:ring-red-500': productStore.errors.price
              }"
            />
            <ErrorLabel :errors="productStore.errors.price" />

            <TextLabel for="description">Product Description</TextLabel>
            <textarea
              id="description"
              v-model="form.description"
              rows="3"
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
            ></textarea>
          </div>
          <div class="col-span-1 space-y-2">
            <div class="w-full flex justify-center">
              <img
                v-if="form.image"
                :src="form.image.preview || form.image"
                alt="Product Image"
                class="mt-4 h-50 w-50"
              />
            </div>
            <TextLabel for="file-upload">Upload New Image</TextLabel>
            <div
              class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10"
            >
              <div class="text-center">
                <PhotoIcon class="mx-auto size-12 text-gray-300" aria-hidden="true" />
                <div class="mt-4 flex text-sm/6 text-gray-600">
                  <label
                    for="file-upload"
                    class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-indigo-500"
                  >
                    <span>Upload a new image</span>
                    <input
                      id="file-upload"
                      name="image"
                      type="file"
                      accept="image/*"
                      class="sr-only"
                      @change="handleFileUpload"
                    />
                  </label>
                  <p class="pl-1">or drag and drop</p>
                </div>
                <p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
              </div>
            </div>
            <ErrorLabel :errors="productStore.errors.image" />
          </div>
        </div>
        <div class="grid place-items-end w-full">
          <PrimaryButton
            :processing="productStore.processing"
            :class="[
              'block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600',
              $attrs.class,
              {
                'opacity-80 cursor-not-allowed': productStore.processing,
                'cursor-pointer': !productStore.processing
              }
            ]"
          >
            Update Product
          </PrimaryButton>
        </div>
      </form>
    </Card>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { useRoute } from 'vue-router';
import { useProductStore } from '@/stores/product';
import PageHeader from '@/components/global/PageHeader.vue';
import PageButton from '@/components/global/PageButton.vue';
import Card from '@/components/global/BaseCard.vue';
import TextInput from '@/components/global/TextInput.vue';
import TextLabel from '@/components/global/TextLabel.vue';
import ErrorLabel from '@/components/global/ErrorLabel.vue';
import PrimaryButton from '@/components/global/PrimaryButton.vue';
import { PhotoIcon } from '@heroicons/vue/24/solid';

const route = useRoute();
const productStore = useProductStore();

const form = ref({
  title: '',
  price: '',
  description: '',
  image: null
});

onMounted(async () => {
  productStore.clearErrors();
  const product = await productStore.fetchProduct(route.params.id);
  if (product) {
    form.value = {
      title: product.title,
      price: product.price,
      description: product.description,
      image: product.image
    };
  }
});

onUnmounted(async () => {
  productStore.clearErrors();
  if (form.value.image?.preview) {
    URL.revokeObjectURL(form.value.image.preview);
  }
});

const handleFileUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    form.value.image = {
      file: file,
      preview: URL.createObjectURL(file)
    };
  }
};

const handleUpdate = async () => {
  let payload = {
    title: form.value.title,
    price: form.value.price,
    description: form.value.description
  };

  if (form.value.image?.file instanceof File) {
    payload.image = form.value.image.file;
  }

  await productStore.updateProduct(payload, route.params.id);
};
</script>
