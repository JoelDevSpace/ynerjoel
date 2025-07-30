<script setup lang="ts">
import BtnAjouter from '@/components/buttons/BtnAjouter.vue';
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
        href: '#',
    },
    {
        title: 'Utilisateurs',
        href: route('admin.users.index'),
    },
    {
        title: 'Ajouter un utilisateur',
        href: route('admin.users.create'),
    },
];

defineProps<{
    roles: Array<{
        id: number;
        name: string;
    }>;
}>();

const form = useForm({
    name: '',
    email: '',
    password: '',
    role: '',
});
</script>

<template>
    <Head title="Ajout Utilisateur" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div>
                <LinkBtnRetour :href="route('admin.users.index')" />
            </div>
            <form class="flex w-1/3 flex-col gap-6" @submit.prevent="form.post(route('admin.users.store'))">
                <div class="grid gap-2">
                    <Label for="name">Nom :</Label>
                    <Input
                        id="name"
                        name="name"
                        type="text"
                        autofocus
                        :tabindex="1"
                        autocomplete="none"
                        v-model="form.name"
                        placeholder="Saisir le prénom et nom"
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div class="grid gap-2">
                    <Label for="email">Email :</Label>
                    <Input id="email" name="email" type="email" v-model="form.email" placeholder="Saisir l'email" :tabindex="2" />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
                <div class="grid gap-2">
                    <Label for="password">Mot de passe :</Label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        :tabindex="3"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-base shadow-sm transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        v-model="form.password"
                        placeholder="Renseigner un mot de passe"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>
                <div class="grid gap-2">
                    <Label for="role">Groupe utilisateur :</Label>
                    <select
                        id="role"
                        v-model="form.role"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-base text-gray-400 shadow-sm transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        :tabindex="4"
                    >
                        <option value="">Sélectionner un groupe</option>
                        <option v-for="role in roles" :key="role.id" :value="role.id" class="text-gray-800">
                            {{ role.name }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.role" />
                </div>
                <div class="flex items-center gap-4">
                    <BtnAjouter type="submit" />
                </div>
            </form>
        </div>
    </AppLayout>
</template>
