<script setup>
import ErrorLabel from "@/components/auth/ErrorLabel.vue";
import PrimaryButton from "@/components/auth/PrimaryButton.vue";
import TextInput from "@/components/auth/TextInput.vue";
import GuestLayout from "@/layouts/GuestLayout.vue";
import { useAuthStore } from "@/stores/auth";
import { onMounted, onUnmounted, ref } from "vue";

const authStore = useAuthStore();

const form = ref({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
});

onMounted(() => {
  authStore.clearErrors();
});

onUnmounted(() => {
  authStore.clearErrors();
});
</script>

<template>
  <GuestLayout title="Register for an account">
    <form
      class="space-y-6"
      method="POST"
      @submit.prevent="authStore.register(form)"
    >
      <div>
        <label
          for="name"
          class="block text-sm font-medium leading-6 text-gray-900"
          >Full Name</label
        >
        <div class="mt-2">
          <TextInput
            id="name"
            name="name"
            type="name"
            v-model="form.name"
            autocomplete="name"
            :class="{
              'border-red-500 focus:ring-red-500': authStore.errors.name,
            }"
          />
          <ErrorLabel :errors="authStore.errors.name" />
        </div>
      </div>

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
        <label
          for="password"
          class="block text-sm font-medium leading-6 text-gray-900"
          >Password</label
        >
        <div class="mt-2">
          <TextInput
            id="password"
            name="password"
            type="password"
            v-model="form.password"
            :class="{
              'border-red-500 focus:ring-red-500': authStore.errors.password,
            }"
          />
          <ErrorLabel :errors="authStore.errors.password" />
        </div>
      </div>

      <div>
        <label
          for="password_confirmation"
          class="block text-sm font-medium leading-6 text-gray-900"
          >Confirm Password</label
        >
        <div class="mt-2">
          <TextInput
            id="password_confirmation"
            name="password_confirmation"
            type="password"
            v-model="form.password_confirmation"
            :class="{
              'border-red-500 focus:ring-red-500':
                authStore.errors.password_confirmation,
            }"
          />
          <ErrorLabel :errors="authStore.errors.password_confirmation" />
        </div>
      </div>

      <div>
        <PrimaryButton :processing="authStore.processing">
          Register
        </PrimaryButton>
      </div>
    </form>
    <p class="mt-10 text-center text-sm text-gray-500">
      Already a member?
      <RouterLink
        :to="{ name: 'login' }"
        class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500"
      >
        Login here
      </RouterLink>
    </p>
  </GuestLayout>
</template>
