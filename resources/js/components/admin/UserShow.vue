<script setup lang="ts">
import { Label } from '@/components/ui/label';

const props = defineProps({
    user: {
        type: Object,
        default: () => ({
            id: null,
            name: '',
            email: '',
            roles: Array<{
                id: number;
                name: string;
            }>,
        }),
    },
});
</script>
<template>
    <div class="mt-4">
        <div class="mb-4 flex flex-row items-center">
            <Label class="min-w-24">Nom :</Label>
            <p class="px-2.5">{{ props.user.name }}</p>
        </div>
        <div class="mb-4 flex flex-row items-center">
            <Label class="min-w-24">Email :</Label>
            <p class="px-2.5">{{ props.user.email }}</p>
        </div>
        <div class="mb-4 flex flex-row items-center">
            <Label class="min-w-24">Appartient au groupe :</Label>
            <p class="flex flex-row flex-wrap">
                <span
                    v-if="user.roles.length === 0"
                    class="mb-2 ml-2 rounded-2xl bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300"
                    >aucun groupe</span
                >
                <span
                    v-for="role in user.roles"
                    :key="role.id"
                    class="mr-1 mb-2 rounded-2xl bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300"
                >
                    {{ role.name }}
                </span>
            </p>
        </div>
    </div>
</template>
