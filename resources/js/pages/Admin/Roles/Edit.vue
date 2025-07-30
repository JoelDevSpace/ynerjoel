<script setup lang="ts">
import BtnModifier from '@/components/buttons/BtnModifier.vue';
import InputError from '@/components/InputError.vue';
import LinkBtnRetour from '@/components/links/LinkBtnRetour.vue';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Administration',
        href: route('admin'),
    },
    {
        title: 'Utilisateurs',
        href: route('admin.roles.index'),
    },
    {
        title: 'Modifier un groupe utilisateurs',
        href: route('admin.roles.index'),
    },
];
const props = defineProps<{
    role: { name: string; id: number | null };
    permissions: string[];
    rolePermissions: string[];
}>();

const form = useForm({
    name: props.role.name || '',
    permissions: props.rolePermissions ? [...props.rolePermissions] : [],
});
</script>

<template>
    <Head title="Modification Groupe Utilisateur" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div>
                <LinkBtnRetour :href="route('admin.roles.index')" />
            </div>
            <form class="flex flex-col gap-6" @submit.prevent="form.put(route('admin.roles.update', { id: role.id }))">
                <div class="grid w-1/3 gap-6">
                    <div class="grid gap-2">
                        <Label for="name">Nom :</Label>
                        <Input id="name" type="text" required autofocus :tabindex="1" v-model="form.name" placeholder="Saisir le nom du role" />
                        <p v-if="form.errors.name" class="mt-1\ text-sm text-red-500">{{ form.errors.name }}</p>
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                </div>

                <div class="grid gap-6">
                    <div class="flex flex-col gap-2">
                        <Label for="Permission">Permissions :</Label>
                        <div class="flex flex-wrap gap-2">
                            <label v-for="permission in permissions" :key="permission" class="flex w-1/5 items-center space-x-2">
                                <input
                                    :value="permission"
                                    type="checkbox"
                                    class="form-checkbox h-5 w-5 rounded text-blue-600 focus:ring-2 focus:ring-blue-500"
                                    v-model="form.permissions"
                                />
                                <span class="text-sm text-gray-600 capitalize">{{ permission }}</span>
                            </label>
                        </div>
                        <InputError class="mt-2" :message="form.errors.permissions" />
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-4">
                    <BtnModifier type="submit" />
                </div>
            </form>
        </div>
    </AppLayout>
</template>
