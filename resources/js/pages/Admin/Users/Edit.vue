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
        href: route('admin.users.index'),
    },
    {
        title: 'Modifier un utilisateur',
        href: route('admin.users.index'),
    },
];

const props = defineProps<{
    user: { name: ''; email: ''; id: null; password: '' };
    userRole?: Array<{
        id: number;
        name: string;
    }>;
    roles: Array<{
        id: number;
        name: string;
    }>;
}>();

const form = useForm({
    name: props.user.name || '',
    email: props.user.email || '',
    password: props.user.password || '',
    role: props.userRole && props.userRole.length > 0 ? props.userRole[0].id : '',
});
//v-if="role.id === userRole[0].id" selected=" "
</script>

<template>
    <Head title="Modification Utilisateur" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div>
                <LinkBtnRetour :href="route('admin.users.index')" />
            </div>
            <form class="flex w-1/3 flex-col gap-6" @submit.prevent="form.put(route('admin.users.update', { id: props.user.id }))">
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
                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-base text-gray-800 shadow-sm transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        :tabindex="4"
                    >
                        <option value="" class="text-gray-400">Sélectionner un groupe</option>
                        <option
                            v-for="role in roles"
                            :key="role.id"
                            :value="role.id"
                            class="text-gray-800"
                            :selected="props.userRole && props.userRole.length > 0 ? role.id === props.userRole[0].id : false"
                        >
                            {{ role.name }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.role" />
                </div>
                <div class="flex items-center gap-4">
                    <BtnModifier type="submit" />
                </div>
            </form>
        </div>
    </AppLayout>
</template>
