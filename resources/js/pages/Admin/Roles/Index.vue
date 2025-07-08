<script setup lang="ts">
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/vue3';
import { Pencil, Plus, Trash2 } from 'lucide-vue-next';

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
                <Link
                    :href="route('admin.roles.create')"
                    class="inline-flex rounded-lg bg-green-700 px-3 py-2 text-xs font-medium text-white hover:bg-green-800 focus:ring-4 focus:ring-green-300 focus:outline-none dark:bg-green-600"
                >
                    <Plus class="mr-2 h-4 w-4" />Ajouter un groupe
                </Link>
            </div>
            <div class="overflow-x-auto p-3">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-[100px]">ID</TableHead>
                            <TableHead>Nom</TableHead>
                            <TableHead>Liste des Permissions</TableHead>
                            <TableHead>Actions</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="role in roles" :key="role.id">
                            <TableCell class="font-medium">{{ role.id }}</TableCell>
                            <TableCell>{{ role.name }}</TableCell>
                            <TableCell>
                                <span
                                    v-for="permission in role.permissions"
                                    :key="permission.id"
                                    class="mr-1 rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300"
                                >
                                    {{ permission.name }}
                                </span>
                            </TableCell>
                            <TableCell>
                                <Link
                                    :href="route('admin.roles.show', role.id)"
                                    class="inline-flex rounded-lg bg-gray-700 px-3 py-2 text-xs font-medium text-white hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:bg-gray-600"
                                >
                                    <Pencil class="mr-2 h-4 w-4" />Show
                                </Link>
                                <Link
                                    :href="route('admin.roles.edit', role.id)"
                                    class="mx-2 inline-flex rounded-lg bg-blue-700 px-3 py-2 text-xs font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:bg-blue-600"
                                >
                                    <Pencil class="mr-2 h-4 w-4" />Edit
                                </Link>
                                <button
                                    @click="DeleteRole(role.id)"
                                    class="inline-flex rounded-lg bg-red-700 px-3 py-2 text-xs font-medium text-white hover:bg-red-800 focus:ring-4 focus:ring-red-300 focus:outline-none dark:bg-red-600"
                                >
                                    <Trash2 class="mr-2 h-4 w-4" />Delete
                                </button>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </AppLayout>
</template>
