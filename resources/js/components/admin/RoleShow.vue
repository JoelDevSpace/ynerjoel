<script setup lang="ts">
import { Label } from '@/components/ui/label';

const props = defineProps({
    role: {
        type: Object,
        default: () => ({
            id: null,
            name: '',
            description: '',
            image: null,
        }),
    },
});
</script>
<template>
    <div class="mt-4">
        <div class="mb-4 flex flex-row items-center">
            <Label class="min-w-24">Nom :</Label>
            <p class="px-2.5">{{ props.role.name }}</p>
        </div>
        <div class="mb-4 flex flex-row items-center">
            <Label class="min-w-24">Liste des permissions :</Label>
            <p class="flex flex-row flex-wrap">
                <span
                    v-if="role.permissions.length === 0"
                    class="mb-2 ml-2 rounded-2xl bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300"
                    >aucune permission</span
                >
                <span
                    v-for="permission in role.permissions"
                    :key="permission.id"
                    class="mr-1 mb-2 rounded-2xl bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300"
                >
                    {{ permission.name }}
                </span>
            </p>
        </div>
    </div>
</template>
