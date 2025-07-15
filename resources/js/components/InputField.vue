<script setup lang="ts">
import { Search } from 'lucide-vue-next';

const model = defineModel();
defineProps({
    label: String,
    icon: String,
    placeholder: {
        type: String,
        default: '',
    },
    type: {
        type: String,
        default: 'text',
    },
});
</script>

<template>
    <div class="flex">
        <label :for="label" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
            {{ label }}
        </label>

        <div class="relative rounded-md py-2">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2">
                <span class="grid place-content-center text-sm text-slate-400">
                    <Search />
                </span>
            </div>
            <input
                :type="type"
                :name="label"
                :placeholder="placeholder"
                v-model="model"
                class="block w-full rounded-xl border-amber-600 py-2 pr-3 pl-10 text-sm outline-0 placeholder:text-slate-400 focus:border-indigo-400 focus:ring-1 focus:ring-indigo-400 focus:ring-inset dark:text-slate-900"
            />
        </div>
    </div>
</template>
