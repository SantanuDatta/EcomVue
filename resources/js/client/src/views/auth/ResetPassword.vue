<script setup>
import PrimaryButton from '@/components/global/PrimaryButton.vue';
import TextInput from '@/components/global/TextInput.vue';
import GuestLayout from '@/layouts/GuestLayout.vue';
</script>

<template>
    <GuestLayout title="Set new password">
        <form class="space-y-6" method="POST">
            <div>
                <TextLabel for="new-password">New Password</TextLabel>
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
                        <TextLabel for="repeat-password">Repeat Password</TextLabel>
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
                    Reset Password
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
