<script setup lang="ts">
import UserShow from '@/components/admin/UserShow.vue';
import LinkBntAjouter from '@/components/links/LinkBtnAjouter.vue';
import LinkBtnModifier from '@/components/links/LinkBtnModifier.vue';
import LinkBntVoir from '@/components/links/LinkBtnVoir.vue';
import Modal from '@/components/Modal.vue';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Administration | Gestion des utilisateurs',
        href: '/users',
    },
];

defineProps<{
    users: Array<{
        id: number;
        name: string;
        email: string;
        roles: Array<{
            id: number;
            name: string;
        }>;
    }>;
}>();

//User show modal
const showUserModal = ref(false);
const showingUser = ref<Record<string, any> | undefined>(undefined);

const ShowUser = (user: Record<string, any>) => {
    showingUser.value = user;
    showUserModal.value = true;
};

const closeModal = () => {
    showUserModal.value = false;
    showingUser.value = undefined;
};

//User delete modal
//const showDeleteModal = ref(false);
//const deletingUser = ref<Record<string, any> | undefined>(undefined);
/*const confirmDelete = (user: Record<string, any>) => {
    deletingUser.value = user;
    showDeleteModal.value = true;
};*/

//const form = useForm({});
</script>

<template>
    <Head title="Utilisateurs" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div>
                <LinkBntAjouter :href="route('admin.users.create')" :text="'un utilisateur'" />
            </div>
            <div class="overflow-x-auto p-3">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-[80px]">ID</TableHead>
                            <TableHead>Nom</TableHead>
                            <TableHead>Email</TableHead>
                            <TableHead>Roles</TableHead>
                            <TableHead>Actions</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="user in users" :key="user.id">
                            <TableCell class="font-medium">{{ user.id }}</TableCell>
                            <TableCell>{{ user.name }}</TableCell>
                            <TableCell>{{ user.email }}</TableCell>
                            <TableCell class="flex flex-row flex-wrap">
                                <span
                                    v-for="role in user.roles"
                                    :key="role.id"
                                    class="mr-1 rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300"
                                >
                                    {{ role.name }}
                                </span>
                            </TableCell>
                            <TableCell>
                                <LinkBntVoir @click="ShowUser(user)" />
                                <LinkBtnModifier :href="route('admin.users.edit', user.id)" />
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
            <!-- Show User Modal -->
            <Modal :show="showUserModal" @close="closeModal">
                <div class="p-6">
                    <h2 class="text-center text-lg font-medium text-gray-900">Utilisateur</h2>
                    <UserShow :user="showingUser" />
                </div>
            </Modal>
        </div>
    </AppLayout>
</template>
