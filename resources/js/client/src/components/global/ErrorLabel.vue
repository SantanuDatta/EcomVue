<template>
  <div v-if="errors?.length" class="space-y-1">
    <span
      v-for="(error, index) in errors"
      :key="index"
      class="text-red-500 block text-sm font-semibold"
    >
      {{ error }}
    </span>
  </div>
</template>

<script setup>
defineProps({
  errors: {
    type: Array,
    default: () => [],
  },
});
</script>
