<template>
  <label :for="forName" class="block text-sm font-medium leading-6 text-gray-900 cursor-pointer">
    <slot />
  </label>
</template>

<script setup>
defineProps({
  forName: {
    type: String,
    required: true
  }
});
</script>
