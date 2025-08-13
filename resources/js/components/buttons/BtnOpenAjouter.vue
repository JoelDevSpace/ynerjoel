<script setup lang="ts">
import { Plus } from 'lucide-vue-next';

defineProps({
    type: {
        type: String,
        default: 'button',
    },
    text: {
        type: String,
        default: '',
    },
});
</script>

<template>
    <button
        class="inline-flex h-9 justify-center rounded-lg bg-green-700 px-3 py-2 text-xs font-medium text-white hover:bg-green-800 focus:ring-4 focus:ring-green-300 focus:outline-none dark:bg-green-600"
        type="submit"
    >
        <Plus class="h-4 w-4" /> Ajouter {{ text }}
        <slot />
    </button>
</template>
