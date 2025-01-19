<script setup>
import PrimaryButton from "@/components/auth/PrimaryButton.vue";
import TextInput from "@/components/auth/TextInput.vue";
import GuestLayout from "@/layouts/GuestLayout.vue";
</script>

<template>
  <GuestLayout title="Set new password">
    <form class="space-y-6" method="POST">
      <div>
        <label
          for="new-password"
          class="block text-sm font-medium leading-6 text-gray-900"
          >New Password</label
        >
        <div class="mt-2">
          <TextInput
            id="new-password"
            name="new-password"
            type="password"
            placeholder="Enter your new password"
          />
        </div>
        <div class="mt-2">
          <div class="flex items-center justify-between">
            <label
              for="repeat-password"
              class="block text-sm font-medium leading-6 text-gray-900"
              >Repeat Password</label
            >

            <div class="text-sm">
              <RouterLink
                :to="{ name: 'login' }"
                class="font-semibold text-indigo-600 hover:text-indigo-500"
                >Remember Password?</RouterLink
              >
            </div>
          </div>
        </div>
        <div class="mt-2">
          <TextInput
            id="repeat-password"
            name="repeat_password"
            type="password"
            placeholder="Repeat your new password"
          />
        </div>
      </div>

      <div>
        <PrimaryButton>
          Reset Password
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
