<script setup lang="ts">
import UserShow from '@/components/admin/UserShow.vue';
import BtnConfirmSupprimer from '@/components/buttons/BtnConfirmSupprimer.vue';
import LinkBntAjouter from '@/components/links/LinkBtnAjouter.vue';
import LinkBtnAnnuler from '@/components/links/LinkBtnAnnuler.vue';
import LinkBtnModifier from '@/components/links/LinkBtnModifier.vue';
import LinkBtnSupprimer from '@/components/links/LinkBtnSupprimer.vue';
import LinkBntVoir from '@/components/links/LinkBtnVoir.vue';
import Modal from '@/components/Modal.vue';
import Pagination from '@/components/Pagination.vue';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Administration',
        href: '/admin',
    },
    {
        title: 'Liste des utilisateurs',
        href: '/users',
    },
];

defineProps<{
    users: any;
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
const showDeleteModal = ref(false);
const deletingUser = ref<Record<string, any> | undefined>(undefined);
const confirmDelete = (user: Record<string, any>) => {
    deletingUser.value = user;
    showDeleteModal.value = true;
};

const form = useForm({});

const deleteUser = () => {
    if (!deletingUser.value) return;
    form.delete(route('admin.users.destroy', deletingUser.value.id), {
        onSuccess: () => {
            showDeleteModal.value = false;
            deletingUser.value = undefined;
        },
    });
};
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
                        <TableRow v-for="user in users.data" :key="user.id">
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
                                <LinkBtnSupprimer @click="confirmDelete(user)" class="text-red-600 hover:text-red-900" />
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
                <div v-if="users.last_page > 1" class="float-end">
                    <Pagination :pagination="users.links" />
                </div>
            </div>
            <!-- Show User Modal -->
            <Modal :show="showUserModal" @close="closeModal">
                <div class="p-6">
                    <h2 class="text-center text-lg font-medium text-gray-900">Utilisateur</h2>
                    <UserShow :user="showingUser" />
                </div>
            </Modal>
        </div>
        <!-- User Delete Confirmation Modal -->
        <Modal :show="showDeleteModal" @close="showDeleteModal = false">
            <div class="p-6">
                <h2 class="text-center text-lg font-medium text-gray-900">Supprimer un utilisateur</h2>
                <p class="mt-8 text-gray-600">Etes-vous sur de vouloir supprimer l'utilisateur suivant ?</p>
                <p class="mt-2 w-full text-center text-xl">
                    {{ deletingUser && deletingUser.name ? deletingUser.name : '' }} /
                    {{ deletingUser && deletingUser.email ? deletingUser.email : '' }}
                </p>
                <div class="mt-6 flex justify-center space-x-4">
                    <LinkBtnAnnuler @click="showDeleteModal = false" />
                    <BtnConfirmSupprimer @click="deleteUser" :disabled="form.processing">Supprimer</BtnConfirmSupprimer>
                </div>
            </div>
        </Modal>
    </AppLayout>
</template>
