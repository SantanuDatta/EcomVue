<script setup>
import PrimaryButton from "@/components/auth/PrimaryButton.vue";
import TextInput from "@/components/auth/TextInput.vue";
import GuestLayout from "@/layouts/GuestLayout.vue";
</script>

<template>
  <GuestLayout title="Request new password">
    <form class="space-y-6" method="POST">
      <div>
        <div class="flex items-center justify-between">
          <label
            for="email"
            class="block text-sm font-medium leading-6 text-gray-900"
            >Email address</label
          >
          <div class="text-sm">
            <RouterLink
              :to="{ name: 'login' }"
              class="font-semibold text-indigo-600 hover:text-indigo-500"
              >Remember Password?</RouterLink
            >
          </div>
        </div>
        <div class="mt-2">
          <TextInput
            id="email"
            name="email"
            type="email"
            autocomplete="email"
          />
        </div>
      </div>

      <div>
        <PrimaryButton>
          Request Password
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
