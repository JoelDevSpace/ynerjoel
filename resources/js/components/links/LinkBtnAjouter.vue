<script setup lang="ts">
import { Method } from '@inertiajs/core';
import { Link } from '@inertiajs/vue3';
import { Plus } from 'lucide-vue-next';

interface Props {
    href: string;
    tabindex?: number;
    method?: Method;
    as?: string;
    text?: string;
}

defineProps<Props>();
</script>

<template>
    <Link
        :href="href"
        :tabindex="tabindex"
        :method="method"
        :as="as"
        class="inline-flex h-9 justify-center rounded-lg bg-green-700 px-3 py-2 text-xs font-medium text-white hover:bg-green-800 focus:ring-4 focus:ring-green-300 focus:outline-none dark:bg-green-600"
        ><Plus class="mr-2 h-4 w-4" /> Ajouter {{ text }}
        <slot />
    </Link>
</template>
