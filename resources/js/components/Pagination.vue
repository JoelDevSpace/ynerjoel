<script setup lang="ts">
import { ChevronLeft, ChevronRight } from 'lucide-vue-next';
defineProps({
    data: {
        type: Object,
        required: true,
    },
    updatedPageNumber: {
        type: Function,
        required: true,
    },
});
</script>

<template>
    <div class="mx-auto w-full py-6">
        <div class="mx-auto max-w-none">
            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                    <div class="flex flex-1 justify-between sm:hidden" />
                    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Resultats
                                <!-- space -->
                                <span class="font-medium">{{ data.from }}</span>
                                <!-- space -->
                                à
                                <!-- space -->
                                <span class="font-medium">{{ data.to }}</span>
                                <!-- space -->
                                sur
                                <!-- space -->
                                <span class="font-medium">
                                    {{ data.total }}
                                </span>
                                <!-- space -->
                                au total.
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                <button
                                    @click.prevent="updatedPageNumber(link)"
                                    v-for="(link, index) in data.links"
                                    :key="index"
                                    :disabled="link.active || !link.url"
                                    class="relative inline-flex items-center border px-4 py-2 text-xs font-medium"
                                    :class="{
                                        'z-10 border-indigo-500 bg-indigo-50 text-indigo-600': link.active,
                                        'border-gray-300 bg-white text-gray-500 hover:bg-gray-50': !link.active,
                                    }"
                                >
                                    <ChevronLeft class="mr-2 h-4 w-2" v-if="link.label === 'Précédent'" />
                                    <span v-html="link.label"></span>
                                    <ChevronRight class="ml-2 h-4 w-4" v-if="link.label === 'Suivant'" />
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
