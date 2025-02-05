<template>
  <div class="inline-block min-w-full mt-8 align-middle">
    <div :class="className">
      <slot />
    </div>
  </div>
</template>

<script setup>
defineProps({
  className: {
    type: String,
    default: "overflow-hidden shadow sm:rounded-lg bg-white p-6",
  },
});
</script>
