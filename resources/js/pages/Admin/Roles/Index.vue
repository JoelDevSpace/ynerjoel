<script setup lang="ts">
import RoleShow from '@/components/admin/RoleShow.vue';
import LinkBntAjouter from '@/components/links/LinkBtnAjouter.vue';
import LinkBtnModifier from '@/components/links/LinkBtnModifier.vue';
import LinkBtnSupprimer from '@/components/links/LinkBtnSupprimer.vue';
import LinkBntVoir from '@/components/links/LinkBtnVoir.vue';
import Modal from '@/components/Modal.vue';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Groupes Utilisateurs',
        href: '/roles',
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
const showingRole = ref<Record<string, any> | undefined>(undefined);

const closeModal = () => {
    showRoleModal.value = false;
    showingRole.value = undefined;
};

const ShowRole = (role: Record<string, any>) => {
    showingRole.value = role;
    showRoleModal.value = true;
};

function DeleteRole(id: number) {
    if (confirm('Are you sure you want to delete this role?')) {
        router.delete(route('admin.roles.destroy', id), {
            preserveScroll: true,
            onSuccess: () => {
                console.log('role deleted successfully');
            },
            onError: (error) => {
                console.error('Error deleting role:', error);
            },
        });
    }
}
</script>

<template>
    <Head title="Groupes Utilisateurs" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div>
                <LinkBntAjouter :href="route('admin.roles.create')" :text="'un groupe'" />
            </div>
            <div class="overflow-x-auto p-3">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-[80px]">ID</TableHead>
                            <TableHead>Nom</TableHead>
                            <TableHead>Liste des Permissions</TableHead>
                            <TableHead>Actions</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="role in roles" :key="role.id">
                            <TableCell class="font-medium">{{ role.id }}</TableCell>
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
                            <TableCell>
                                <LinkBntVoir @click="ShowRole(role)" />
                                <LinkBtnModifier :href="route('admin.roles.edit', role.id)" />
                                <LinkBtnSupprimer @click="DeleteRole(role.id)" />
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
            <!-- Show Modal -->
            <Modal :show="showRoleModal" @close="closeModal">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900">Groupe Utilisateur</h2>
                    <RoleShow :role="showingRole" />
                </div>
            </Modal>
        </div>
    </AppLayout>
</template>
