<script setup lang="ts">
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button
        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none disabled:opacity-25"
    >
        <slot /> Annuler
    </button>
</template>
