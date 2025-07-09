<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Save, Undo2 } from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Modifier un groupe utilisateur',
        href: '/Roles/edit',
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
                <Link
                    :href="route('admin.roles.index')"
                    class="inline-flex rounded-lg bg-blue-700 px-3 py-2 text-xs font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:bg-blue-600"
                >
                    <Undo2 class="mr-2 h-4 w-4" />
                    back
                </Link>
            </div>
            <form class="flex w-1/3 flex-col gap-6" @submit.prevent="form.put(route('admin.roles.update', { id: role.id }))">
                <div class="grid gap-6">
                    <div class="grid gap-2">
                        <Label for="name">Nom :</Label>
                        <Input id="name" type="text" required autofocus :tabindex="1" v-model="form.name" placeholder="Saisir le nom du role" />
                        <p v-if="form.errors.name" class="mt-1\ text-sm text-red-500">{{ form.errors.name }}</p>
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                </div>

                <div class="grid gap-6">
                    <div class="grid gap-2">
                        <Label for="Permission">Permissions :</Label>
                        <label v-for="permission in permissions" :key="permission" class="flex items-center space-x-2">
                            <input
                                :value="permission"
                                type="checkbox"
                                class="form-checkbox h-5 w-5 rounded text-blue-600 focus:ring-2 focus:ring-blue-500"
                                v-model="form.permissions"
                            />
                            <span class="text-sm text-gray-600 capitalize">{{ permission }}</span>
                        </label>
                        <InputError class="mt-2" :message="form.errors.permissions" />
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-4">
                    <Button type="submit"><Save class="h-4 w-4" />Modifier</Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
