<script setup>
import PrimaryButton from '@/components/global/PrimaryButton.vue';
import TextInput from '@/components/global/TextInput.vue';
import GuestLayout from '@/layouts/GuestLayout.vue';
</script>

<template>
    <GuestLayout title="Request new password">
        <form class="space-y-6" method="POST">
            <div>
                <div class="flex items-center justify-between">
                    <TextLabel for="email">Email</TextLabel>
                    <div class="text-sm">
                        <RouterLink :to="{ name: 'login' }" class="font-semibold text-indigo-600 hover:text-indigo-500"
                            >Remember Password?</RouterLink
                        >
                    </div>
                </div>
                <div class="mt-2">
                    <TextInput id="email" name="email" type="email" autocomplete="email" />
                </div>
            </div>

            <div>
                <PrimaryButton
                    :class="[
                        'flex w-full justify-center items-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-xs hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600',
                        $attrs.class,
                        {
                            'opacity-80 cursor-not-allowed': processing,
                            'cursor-pointer': !processing,
                        },
                    ]"
                >
                    Request Password
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
