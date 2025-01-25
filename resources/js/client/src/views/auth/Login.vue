<script setup>
import ErrorLabel from "@/components/auth/ErrorLabel.vue";
import PrimaryButton from "@/components/auth/PrimaryButton.vue";
import TextInput from "@/components/auth/TextInput.vue";
import GuestLayout from "@/layouts/GuestLayout.vue";
import { useAuthStore } from "@/stores/auth";
import { onMounted, onUnmounted, ref } from "vue";

const authStore = useAuthStore();

const form = ref({
  email: "",
  password: "",
});

onMounted(() => {
  authStore.clearErrors();
});

onUnmounted(() => {
  authStore.clearErrors();
});
</script>

<template>
  <GuestLayout title="Sign in to your account">
    <form
      class="space-y-6"
      method="POST"
      @submit.prevent="authStore.login(form)"
    >
      <div>
        <label
          for="email"
          class="block text-sm font-medium leading-6 text-gray-900"
          >Email address</label
        >
        <div class="mt-2">
          <TextInput
            id="email"
            name="email"
            type="email"
            v-model="form.email"
            autocomplete="email"
            :class="{
              'border-red-500 focus:ring-red-500': authStore.errors.email,
            }"
          />
          <ErrorLabel :errors="authStore.errors.email" />
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label
            for="password"
            class="block text-sm font-medium leading-6 text-gray-900"
            >Password</label
          >
          <div class="text-sm">
            <RouterLink
              :to="{ name: 'forgetPassword' }"
              class="font-semibold text-indigo-600 hover:text-indigo-500"
              >Forgot Password?</RouterLink
            >
          </div>
        </div>
        <div class="mt-2">
          <TextInput
            id="password"
            name="password"
            type="password"
            v-model="form.password"
            autocomplete="current-password"
            :class="{
              'border-red-500 focus:ring-red-500': authStore.errors.password,
            }"
          />
          <ErrorLabel :errors="authStore.errors.password" />
        </div>
      </div>

      <div>
        <PrimaryButton :processing="authStore.processing">
          Sign in
        </PrimaryButton>
      </div>
    </form>
    <p class="mt-10 text-center text-sm text-gray-500">
      Not a member?
      {{ " " }}
      <RouterLink
        :to="{ name: 'register' }"
        class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500"
      >
        Register here
      </RouterLink>
    </p>
  </GuestLayout>
</template>
