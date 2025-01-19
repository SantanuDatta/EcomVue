<script setup>
const props = defineProps({
  class: {
    type: String,
    default: "h-8 w-auto",
  },
  src: {
    type: String,
    default:
      "https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600",
  },
  alt: {
    type: String,
    default: "Your Company",
  },
});
</script>

<template>
  <img :class="props.class" :src="props.src" :alt="props.alt" />
</template>
