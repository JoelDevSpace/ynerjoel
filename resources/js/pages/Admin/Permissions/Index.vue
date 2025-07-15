<script setup lang="ts">
import BtnConfirmSupprimer from '@/components/buttons/BtnConfirmSupprimer.vue';
import LinkBntAjouter from '@/components/links/LinkBtnAjouter.vue';
import LinkBtnAnnuler from '@/components/links/LinkBtnAnnuler.vue';
import LinkBtnModifier from '@/components/links/LinkBtnModifier.vue';
import LinkBtnSupprimer from '@/components/links/LinkBtnSupprimer.vue';
import Modal from '@/components/Modal.vue';
import Pagination from '@/components/Pagination.vue';
import SearchForm from '@/components/SearchForm.vue';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Administration',
        href: route('admin'),
    },
    {
        title: 'Liste des permissions',
        href: route('admin.permissions.index'),
    },
];

defineProps<{
    permissions: any;
}>();

const showDeleteModal = ref(false);
const deletingPermission = ref<Record<string, any> | undefined>(undefined);

const confirmDelete = (permission: Record<string, any>) => {
    deletingPermission.value = permission;
    showDeleteModal.value = true;
};

const form = useForm({});

const deletePermission = () => {
    if (!deletingPermission.value) return;
    form.delete(route('admin.permissions.destroy', deletingPermission.value.id), {
        onSuccess: () => {
            showDeleteModal.value = false;
            deletingPermission.value = undefined;
        },
    });
};
</script>

<template>
    <Head title="Permissions" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex flex-row justify-between">
                <SearchForm class="ml-20" />
                <LinkBntAjouter :href="route('admin.permissions.create')" :text="'une permission'" class="mr-60" />
            </div>
            <div class="overflow-x-auto p-3">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead>Module</TableHead>
                            <TableHead>Elément</TableHead>
                            <TableHead>Action</TableHead>
                            <TableHead>Actions</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="permission in permissions.data" :key="permission.id">
                            <TableCell class="capitalize">{{ permission.name.split('.')[0].toLowerCase() }}</TableCell>
                            <TableCell class="capitalize">{{ permission.name.split('.')[1].toLowerCase() }}</TableCell>
                            <TableCell class="capitalize">{{ permission.name.split('.')[2].toLowerCase() }}</TableCell>
                            <TableCell>
                                <LinkBtnModifier :href="route('admin.permissions.edit', permission.id)" />
                                <LinkBtnSupprimer @click="confirmDelete(permission)" class="text-red-600 hover:text-red-900" />
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
                <div v-if="permissions.last_page > 1" class="float-end">
                    <Pagination :pagination="permissions.links" />
                </div>
            </div>
        </div>
        <!-- permission Delete Confirmation Modal -->
        <Modal :show="showDeleteModal" @close="showDeleteModal = false">
            <div class="p-6">
                <h2 class="text-center text-lg font-medium text-gray-900">Supprimer une permission</h2>
                <p class="mt-8 text-gray-600">Etes-vous sur de vouloir supprimer la permission suivante ?</p>
                <p class="mt-2 w-full text-center text-xl capitalize">
                    Module : {{ deletingPermission && deletingPermission.name ? deletingPermission.name.split('.')[0].toLowerCase() : '' }}
                </p>
                <p class="mt-2 w-full text-center text-xl capitalize">
                    Elément : {{ deletingPermission && deletingPermission.name ? deletingPermission.name.split('.')[1].toLowerCase() : '' }}
                </p>
                <p class="mt-2 w-full text-center text-xl capitalize">
                    Action : {{ deletingPermission && deletingPermission.name ? deletingPermission.name.split('.')[2].toLowerCase() : '' }}
                </p>
                <div class="mt-6 flex justify-center space-x-4">
                    <LinkBtnAnnuler @click="showDeleteModal = false" />
                    <BtnConfirmSupprimer @click="deletePermission" :disabled="form.processing">Supprimer</BtnConfirmSupprimer>
                </div>
            </div>
        </Modal>
    </AppLayout>
</template>
