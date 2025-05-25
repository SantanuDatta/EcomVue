<template>
  <header class="bg-slate-200 shadow-sm">
    <nav
      class="mx-auto flex max-w-7xl items-center justify-between px-4 p-6 lg:px-8"
      aria-label="Global"
    >
      <div class="flex lg:flex-1">
        <RouterLink :to="{ name: 'home' }" class="-m-1.5 p-1.5">
          <span class="sr-only">EcomVue</span>
          <ApplicationLogo class="h-8 w-auto" alt="Your Company" />
        </RouterLink>
      </div>
      <PopoverGroup class="hidden lg:flex lg:gap-x-12">
        <a href="#" class="text-sm/6 font-semibold text-gray-900">Features</a>
        <a href="#" class="text-sm/6 font-semibold text-gray-900">Marketplace</a>
        <a href="#" class="text-sm/6 font-semibold text-gray-900">Company</a>
      </PopoverGroup>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <a href="#" class="text-sm/6 font-semibold text-gray-900"
          >Log in <span aria-hidden="true">&rarr;</span></a
        >
      </div>
    </nav>
  </header>
</template>

<script setup>
import ApplicationLogo from '@/components/ApplicationLogo.vue';
import { PopoverGroup } from '@headlessui/vue';
</script>
