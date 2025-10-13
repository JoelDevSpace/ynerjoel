<script setup lang="ts">
import BtnConfirmSupprimer from '@/components/buttons/BtnConfirmSupprimer.vue';
import InputField from '@/components/InputField.vue';
import LinkBntAjouter from '@/components/links/LinkBtnAjouter.vue';
import LinkBtnAnnuler from '@/components/links/LinkBtnAnnuler.vue';
import LinkBtnModifier from '@/components/links/LinkBtnModifier.vue';
import LinkBtnSupprimer from '@/components/links/LinkBtnSupprimer.vue';
import Modal from '@/components/Modal.vue';
import Pagination from '@/components/Pagination.vue';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { can } from '@/lib/can';
import { type BreadcrumbItem } from '@/types';
import { Head, router, useForm, usePage } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Administration',
        href: '#',
    },
    {
        title: 'Liste des permissions',
        href: route('admin.permissions.index'),
    },
];

defineProps({
    permissions: {
        type: Object,
        required: true,
    },
});

//Permission Search
const search = ref(usePage().props.searchTerm),
    pageNumber = ref(1);

const permissionsUrl = computed(() => {
    const url = new URL(route('admin.permissions.index'));
    url.searchParams.append('page', String(pageNumber.value));

    if (search.value) {
        url.searchParams.append('search', String(search.value));
    }

    return url;
});

const updatedPageNumber = (link: any) => {
    pageNumber.value = link.url.split('=')[1];
};
watch(
    () => permissionsUrl.value,
    (updatedPermissionsUrl) => {
        router.visit(updatedPermissionsUrl, {
            preserveScroll: true,
            preserveState: true,
            replace: true,
        });
    },
);
watch(
    () => search.value,
    (value) => {
        if (value) {
            pageNumber.value = 1;
        }
    },
);
//Permission Delete modal
const showDeleteModal = ref(false);
const deletingPermission = ref<Record<string, any> | undefined>(undefined);

const confirmDelete = (permission: Record<string, any>) => {
    deletingPermission.value = permission;
    showDeleteModal.value = true;
};

const form = useForm({});

const deletePermission = () => {
    if (!deletingPermission.value) return;
    form.delete(route('admin.permissions.destroy', deletingPermission.value), {
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
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl bg-gradient-to-tr from-amber-50 to-cyan-100 p-4">
            <div class="flex flex-row justify-between">
                <InputField
                    v-model="search"
                    type="search"
                    id="search"
                    label=""
                    autocomplete="off"
                    icon=""
                    placeholder="Chercher..."
                    class="rounded-4xl"
                />
                <LinkBntAjouter
                    v-if="can('admin.permission.creer')"
                    :href="route('admin.permissions.create')"
                    :text="'une permission'"
                    class="mt-2 mr-60"
                />
            </div>
            <div class="overflow-x-auto p-3">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead>Module</TableHead>
                            <TableHead>Elément</TableHead>
                            <TableHead>Action</TableHead>
                            <TableHead v-if="can('admin.permission.modifier') || can('admin.permission.supprimer')">Actions</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="permission in permissions.data" :key="permission.id">
                            <TableCell class="capitalize">{{ permission.name.split('.')[0].toLowerCase() }}</TableCell>
                            <TableCell class="capitalize">{{ permission.name.split('.')[1].toLowerCase() }}</TableCell>
                            <TableCell class="capitalize">{{ permission.name.split('.')[2].toLowerCase() }}</TableCell>
                            <TableCell v-if="can('admin.permission.modifier') || can('admin.permission.supprimer')">
                                <LinkBtnModifier v-if="can('admin.permission.modifier')" :href="route('admin.permissions.edit', permission)" />
                                <LinkBtnSupprimer
                                    v-if="can('admin.permission.supprimer')"
                                    @click="confirmDelete(permission)"
                                    class="text-red-600 hover:text-red-900"
                                />
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
                <Pagination :data="permissions" :updatedPageNumber="updatedPageNumber" />
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
