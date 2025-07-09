<script setup lang="ts">
import { Trash2 } from 'lucide-vue-next';
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button
        class="inline-flex w-28 justify-center rounded-lg bg-red-700 px-3 py-2 text-xs font-medium text-white hover:bg-red-800 focus:ring-4 focus:ring-red-300 focus:outline-none dark:bg-red-600"
    >
        <Trash2 class="mr-2 h-4 w-4" />Supprimer
        <slot />
    </button>
</template>
