<template>
  <div class="sm:flex-auto">
    <h1 class="text-base font-semibold leading-6 text-gray-900">{{ title }}</h1>
    <p class="mt-2 text-sm text-gray-700">
      {{ description }}
    </p>
  </div>
</template>

  <script setup>
const props = defineProps({
  title: {
    type: String,
  },
  description: {
    type: String,
  },
});
</script>
