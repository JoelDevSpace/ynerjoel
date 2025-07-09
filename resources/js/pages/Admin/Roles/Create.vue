<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import LinkBtnRetour from '@/components/links/LinkBtnRetour.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { Save } from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Ajouter un groupe utilisateur',
        href: '/Roles/create',
    },
];

defineProps<{
    permissions: Array<{
        name: string;
        id: number;
    }>;
}>();

const form = useForm({
    name: '',
    permissions: [],
});
</script>

<template>
    <Head title="Ajout Groupe Utilisateur" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div>
                <LinkBtnRetour :href="route('admin.roles.index')" />
            </div>
            <form class="flex w-1/3 flex-col gap-6" @submit.prevent="form.post(route('admin.roles.store'))">
                <div class="grid gap-6">
                    <div class="grid gap-2">
                        <Label for="name">Nom :</Label>
                        <Input
                            id="name"
                            name="name"
                            type="text"
                            required
                            autofocus
                            :tabindex="1"
                            autocomplete="none"
                            v-model="form.name"
                            placeholder="Saisir le nom du role"
                        />
                        <p v-if="form.errors.name" class="mt-1\ text-sm text-red-500">{{ form.errors.name }}</p>
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                </div>
                <div class="grid gap-6">
                    <div class="grid gap-2">
                        <Label for="Permission">Permissions :</Label>
                        <label v-for="permission in permissions" :key="permission.id" class="flex items-center space-x-2">
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
                <div class="flex items-center gap-4">
                    <Button type="submit"><Save class="h-4 w-4" />Ajouter</Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
