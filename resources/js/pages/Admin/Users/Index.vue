<script setup lang="ts">
import UserShow from '@/components/admin/UserShow.vue';
import BtnConfirmSupprimer from '@/components/buttons/BtnConfirmSupprimer.vue';
import InputField from '@/components/InputField.vue';
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
import { Head, router, useForm, usePage } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Administration',
        href: route('admin'),
    },
    {
        title: 'Liste des utilisateurs',
        href: route('admin.users.index'),
    },
];

defineProps({
    users: {
        type: Object,
        required: true,
    },
});

//User Search
const search = ref(usePage().props.searchTerm),
    pageNumber = ref(1);

const usersUrl = computed(() => {
    const url = new URL(route('admin.users.index'));
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
    () => usersUrl.value,
    (updatedUsersUrl) => {
        router.visit(updatedUsersUrl, {
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
const CancelDeleteUser = () => {
    showDeleteModal.value = false;
    deletingUser.value = undefined;
};
</script>

<template>
    <Head title="Utilisateurs" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex flex-row justify-between">
                <InputField
                    v-model="search"
                    type="search"
                    id="search"
                    label=""
                    autocomplete="off"
                    icon="magnifying-glass"
                    placeholder="Chercher..."
                />

                <LinkBntAjouter :href="route('admin.users.create')" :text="'un utilisateur'" class="mt-2 mr-60" />
            </div>
            <div class="overflow-x-auto p-3" v-if="Object.keys(users.data).length">
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
                <Pagination :data="users" :updatedPageNumber="updatedPageNumber" />
            </div>
            <div class="overflow-x-auto p-3" v-else>
                <p>Il n'y a pas de résultats pour cette recherche.</p>
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
        <Modal :show="showDeleteModal" @close="CancelDeleteUser">
            <div class="p-6">
                <h2 class="text-center text-lg font-medium text-gray-900">Supprimer un utilisateur</h2>
                <p class="mt-8 text-gray-600">Etes-vous sur de vouloir supprimer l'utilisateur suivant ?</p>
                <p class="mt-2 w-full text-center text-xl">
                    {{ deletingUser && deletingUser.name ? deletingUser.name : '' }} /
                    {{ deletingUser && deletingUser.email ? deletingUser.email : '' }}
                </p>
                <div class="mt-6 flex justify-center space-x-4">
                    <LinkBtnAnnuler @click="CancelDeleteUser" />
                    <BtnConfirmSupprimer @click="deleteUser" :disabled="form.processing">Supprimer</BtnConfirmSupprimer>
                </div>
            </div>
        </Modal>
    </AppLayout>
</template>
