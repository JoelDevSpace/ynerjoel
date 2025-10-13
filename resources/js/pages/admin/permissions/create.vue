<script setup lang="ts">
import BtnAjouter from '@/components/buttons/BtnAjouter.vue';
import InputError from '@/components/InputError.vue';
import LinkBtnRetour from '@/components/links/LinkBtnRetour.vue';
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
        title: 'Permissions',
        href: route('admin.permissions.index'),
    },
    {
        title: 'Ajouter une permission',
        href: route('admin.permissions.create'),
    },
];

defineProps<{
    modules: any;
    elements: any;
    actions: any;
}>();

const form = useForm({
    module: '',
    element: '',
    action: '',
});
</script>

<template>
    <Head title="Ajouter une permission" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div>
                <LinkBtnRetour :href="route('admin.permissions.index')" />
            </div>
            <form class="flex w-1/3 flex-col gap-6" @submit.prevent="form.post(route('admin.permissions.store'))">
                <div class="grid gap-2">
                    <Label for="module">Module :</Label>
                    <select
                        id="module"
                        v-model="form.module"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-base text-gray-400 shadow-sm transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        :tabindex="4"
                    >
                        <option value="">Sélectionner un module</option>
                        <option v-for="module in modules" :key="module" :value="module.value" class="text-gray-800">
                            {{ module.name }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.module" />
                </div>
                <div class="grid gap-2">
                    <Label for="element">Elément :</Label>
                    <select
                        id="element"
                        v-model="form.element"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-base text-gray-400 shadow-sm transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        :tabindex="4"
                    >
                        <option value="">Sélectionner un élément</option>
                        <option v-for="element in elements" :key="element" :value="element.value" class="text-gray-800">
                            {{ element.name }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.element" />
                </div>
                <div class="grid gap-2">
                    <Label for="action">Action :</Label>
                    <select
                        id="action"
                        v-model="form.action"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-base text-gray-400 shadow-sm transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        :tabindex="4"
                    >
                        <option value="">Sélectionner une action</option>
                        <option v-for="action in actions" :key="action" :value="action.value" class="text-gray-800">
                            {{ action.name }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.action" />
                </div>

                <div class="flex items-center gap-4">
                    <BtnAjouter type="submit" />
                </div>
            </form>
        </div>
    </AppLayout>
</template>
