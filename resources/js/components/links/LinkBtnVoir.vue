<script setup lang="ts">
import { Pencil } from 'lucide-vue-next';
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button
        class="inline-flex w-28 justify-center rounded-lg bg-gray-700 px-3 py-2 text-xs font-medium text-white hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:bg-gray-600"
    >
        <Pencil class="mr-2 h-4 w-4" />Voir
        <slot />
    </button>
</template>
