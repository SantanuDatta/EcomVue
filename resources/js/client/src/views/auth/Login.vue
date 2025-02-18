<template>
    <GuestLayout title="Sign in to your account">
        <form class="space-y-6" method="POST" @submit.prevent="authStore.login(form)">
            <div>
                <TextLabel for="email">Email</TextLabel>
                <div class="mt-2">
                    <TextInput
                        id="email"
                        v-model="form.email"
                        name="email"
                        type="email"
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
                    <TextLabel for="password">Password</TextLabel>
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
                        v-model="form.password"
                        name="password"
                        type="password"
                        autocomplete="current-password"
                        :class="{
                            'border-red-500 focus:ring-red-500': authStore.errors.password,
                        }"
                    />
                    <ErrorLabel :errors="authStore.errors.password" />
                </div>
            </div>

            <div>
                <PrimaryButton
                    :processing="authStore.processing"
                    :class="[
                        'flex w-full justify-center items-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-xs hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600',
                        $attrs.class,
                        {
                            'opacity-80 cursor-not-allowed': processing,
                            'cursor-pointer': !processing,
                        },
                    ]"
                >
                    Sign in
                </PrimaryButton>
            </div>
        </form>
        <p class="mt-10 text-center text-sm text-gray-500">
            Not a member?
            {{ ' ' }}
            <RouterLink
                :to="{ name: 'register' }"
                class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500"
            >
                Register here
            </RouterLink>
        </p>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/layouts/GuestLayout.vue';
import TextLabel from '@/components/global/TextLabel.vue';
import TextInput from '@/components/global/TextInput.vue';
import ErrorLabel from '@/components/global/ErrorLabel.vue';
import PrimaryButton from '@/components/global/PrimaryButton.vue';
import { useAuthStore } from '@/stores/auth';
import { onMounted, onUnmounted, ref } from 'vue';

const authStore = useAuthStore();

const form = ref({
    email: '',
    password: '',
});

onMounted(() => {
    authStore.clearErrors();
});

onUnmounted(() => {
    authStore.clearErrors();
});
</script>
