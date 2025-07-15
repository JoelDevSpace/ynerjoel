<script setup lang="ts">
import LinkBntAjouter from '@/components/links/LinkBtnAjouter.vue';
import LinkBtnModifier from '@/components/links/LinkBtnModifier.vue';
import Pagination from '@/components/Pagination.vue';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

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
</script>

<template>
    <Head title="Permissions" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div>
                <LinkBntAjouter :href="route('admin.permissions.create')" :text="'une permission'" />
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
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
                <div v-if="permissions.last_page > 1" class="float-end">
                    <Pagination :pagination="permissions.links" />
                </div>
            </div>
            <!-- Show User Modal -->
        </div>
        <!-- permission Delete Confirmation Modal -->
    </AppLayout>
</template>
