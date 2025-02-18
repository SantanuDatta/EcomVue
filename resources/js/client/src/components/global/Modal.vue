<template>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" class="relative z-10" @close="close">
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black/25" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center">
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel
                            class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                        >
                            <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">
                                {{ title }}
                            </DialogTitle>

                            <div class="mt-2">
                                <slot name="content">
                                    <p class="text-sm text-gray-500">
                                        {{ message }}
                                    </p>
                                </slot>
                            </div>

                            <div class="mt-4 flex justify-end space-x-3">
                                <slot name="actions">
                                    <button
                                        v-if="showCancel"
                                        class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 cursor-pointer"
                                        @click="handleCancel"
                                    >
                                        {{ cancelText }}
                                    </button>
                                    <button
                                        v-if="showConfirm"
                                        class="inline-flex justify-center rounded-md border border-transparent"
                                        :class="[confirmButtonClass]"
                                        @click="handleConfirm"
                                    >
                                        {{ confirmText }}
                                    </button>
                                </slot>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle } from '@headlessui/vue';

const props = defineProps({
    isOpen: {
        type: Boolean,
        required: true,
    },
    title: {
        type: String,
        default: '',
    },
    message: {
        type: String,
        default: '',
    },
    showCancel: {
        type: Boolean,
        default: true,
    },
    showConfirm: {
        type: Boolean,
        default: true,
    },
    cancelText: {
        type: String,
        default: 'Cancel',
    },
    confirmText: {
        type: String,
        default: 'Confirm',
    },
    confirmButtonClass: {
        type: String,
        default:
            'bg-red-100 px-4 py-2 text-sm font-medium text-red-900 hover:bg-red-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 cursor-pointer',
    },
});

const emit = defineEmits(['close', 'cancel', 'confirm']);

const close = () => emit('close');
const handleCancel = () => emit('cancel');
const handleConfirm = () => emit('confirm');
</script>
