<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ChevronLeft, ChevronRight } from 'lucide-vue-next';

defineProps<{
    pagination: Array<any>;
}>();
</script>

<template>
    <div>
        <div class="mt-8 flex flex-wrap">
            <template v-for="(link, key) in pagination" :key="key">
                <div v-if="link.url === null" class="mr-1 mb-1 flex rounded-4xl px-4 py-3 text-sm leading-4 text-gray-400">
                    <ChevronLeft class="mr-2 h-4 w-2" v-if="link.label === 'Précédent'" />
                    {{ link.label }}
                    <ChevronRight class="ml-2 h-4 w-4" v-if="link.label === 'Suivant'" />
                </div>
                <Link
                    v-else
                    class="mr-1 mb-1 flex rounded-4xl px-4 py-3 text-sm leading-4 hover:bg-blue-700 hover:text-white focus:border-primary focus:text-primary active:bg-blue-400 active:text-white"
                    :class="{ 'bg-blue-400 text-white': link.active }"
                    :href="link.url"
                >
                    <ChevronLeft class="mr-2 h-4 w-4" v-if="link.label === 'Précédent'" />
                    {{ link.label }}
                    <ChevronRight class="ml-2 h-4 w-4" v-if="link.label === 'Suivant'" />
                </Link>
            </template>
        </div>
    </div>
</template>
