<script setup lang="ts">
import { Method } from '@inertiajs/core';
import { Link } from '@inertiajs/vue3';
import { Pencil } from 'lucide-vue-next';

interface Props {
    href: string;
    tabindex?: number;
    method?: Method;
    as?: string;
}

defineProps<Props>();
</script>

<template>
    <Link
        :href="href"
        :tabindex="tabindex"
        :method="method"
        :as="as"
        class="mx-2 inline-flex w-28 justify-center rounded-lg bg-blue-700 px-3 py-2 text-xs font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:bg-blue-600"
        ><Pencil class="mr-2 h-4 w-4" /> Modifier
        <slot />
    </Link>
</template>
