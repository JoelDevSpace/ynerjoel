<script setup lang="ts">
import BtnConfirmSupprimer from '@/components/buttons/BtnConfirmSupprimer.vue';
import LinkBntAjouter from '@/components/links/LinkBtnAjouter.vue';
import LinkBtnAnnuler from '@/components/links/LinkBtnAnnuler.vue';
import LinkBtnModifier from '@/components/links/LinkBtnModifier.vue';
import LinkBtnSupprimer from '@/components/links/LinkBtnSupprimer.vue';
import LinkBntVoir from '@/components/links/LinkBtnVoir.vue';
import Modal from '@/components/Modal.vue';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { can } from '@/lib/can';
import showRole from '@/pages/admin/roles/showRole.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Administration',
        href: '#',
    },
    {
        title: 'Liste des groupes utilisateurs',
        href: route('admin.roles.index'),
    },
];

defineProps<{
    roles: Array<{
        id: number;
        name: string;
        permissions: Array<{
            id: number;
            name: string;
        }>;
    }>;
}>();

const showRoleModal = ref(false);
const showDeleteModal = ref(false);
const showingRole = ref<Record<string, any> | undefined>(undefined);
const deletingRole = ref<Record<string, any> | undefined>(undefined);

const closeModal = () => {
    showRoleModal.value = false;
    showingRole.value = undefined;
};

const ShowRole = (role: Record<string, any>) => {
    showingRole.value = role;
    showRoleModal.value = true;
};

const confirmDelete = (role: Record<string, any>) => {
    deletingRole.value = role;
    showDeleteModal.value = true;
};

const form = useForm({});

const deleteRole = () => {
    if (!deletingRole.value) return;
    form.delete(route('admin.roles.destroy', deletingRole.value), {
        onSuccess: () => {
            showDeleteModal.value = false;
            deletingRole.value = undefined;
        },
    });
};
</script>

<template>
    <Head title="Groupes Utilisateurs" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl bg-gradient-to-tr from-amber-50 to-cyan-100 p-4">
            <div>
                <LinkBntAjouter v-if="can('admin.groupe.creer')" :href="route('admin.roles.create')" :text="'un groupe'" />
            </div>
            <div class="overflow-x-auto p-3">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead>Nom du groupe</TableHead>
                            <TableHead>Liste des Permissions</TableHead>
                            <TableHead v-if="can('admin.groupe.voir') || can('admin.groupe.modifier') || can('admin.groupe.supprimer')"
                                >Actions</TableHead
                            >
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="role in roles" :key="role.id">
                            <TableCell>{{ role.name }}</TableCell>
                            <TableCell class="flex flex-row flex-wrap">
                                <span
                                    v-for="permission in role.permissions"
                                    :key="permission.id"
                                    class="mr-1 rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300"
                                >
                                    {{ permission.name }}
                                </span>
                            </TableCell>
                            <TableCell v-if="can('admin.groupe.voir') || can('admin.groupe.modifier') || can('admin.groupe.supprimer')">
                                <LinkBntVoir v-if="can('admin.groupe.voir')" @click="ShowRole(role)" />
                                <LinkBtnModifier v-if="can('admin.groupe.modifier')" :href="route('admin.roles.edit', role)" />
                                <LinkBtnSupprimer
                                    v-if="can('admin.groupe.supprimer')"
                                    @click="confirmDelete(role)"
                                    class="text-red-600 hover:text-red-900"
                                />
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
            <!-- Show Role Modal -->
            <Modal :show="showRoleModal" @close="closeModal">
                <div class="p-6">
                    <h2 class="text-center text-lg font-medium text-gray-900">Groupe Utilisateur</h2>
                    <showRole :role="showingRole" />
                </div>
            </Modal>
        </div>
        <!-- Delete Confirmation Modal -->
        <Modal :show="showDeleteModal" @close="showDeleteModal = false">
            <div class="p-6">
                <h2 class="text-center text-lg font-medium text-gray-900">Supprimer un groupe utilisateur</h2>
                <p class="mt-8 text-gray-600">Etes-vous sur de vouloir supprimer le groupe utilisateur suivant ?</p>
                <p class="mt-2 w-full text-center text-xl">{{ deletingRole && deletingRole.name ? deletingRole.name : '' }}</p>
                <div class="mt-6 flex justify-center space-x-4">
                    <LinkBtnAnnuler @click="showDeleteModal = false" />
                    <BtnConfirmSupprimer @click="deleteRole" :disabled="form.processing">Supprimer</BtnConfirmSupprimer>
                </div>
            </div>
        </Modal>
    </AppLayout>
</template>
