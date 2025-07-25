<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../../components/PlaceholderPattern.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Administration',
        href: '/admin',
    },
];

defineProps<{
    countUsers: number;
    countRoles: number;
    countPermissions: number;
}>();
</script>

<template>
    <Head title="Administration" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <p>TODO Administration</p>
                    <ul>
                        <li class="line-through">CRUD pour les permissions</li>
                        <li class="">Faire fonctionner les droits utilisateur back et front (Gate et can)</li>
                        <li>CRUD pour les types de clients</li>
                        <li>CRUD pour les types de personnes morales</li>
                        <li>CRUD pour les types de fiche FOS</li>
                        <li>CRUD pour les secteurs des fiche FOS</li>
                    </ul>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <p>TODO hors Administration</p>
                    <ul>
                        <li>CRUD fiches</li>
                        <li>CRUD Bénéficiaires</li>
                        <li>CRUD Installateurs</li>
                        <li>CRUD contrats Installateurs</li>
                        <li>Dossier</li>
                    </ul>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <p>TODO Design</p>
                    <ul>
                        <li class="bold text-red-700 line-through">Pagination</li>
                        <li class="line-through">toaster message flash</li>
                        <li class="line-through">Ajouter les search sur les pages index</li>
                        <li>tester les datatables</li>
                        <li>tester les onglets</li>
                        <li>contient {{ countUsers }} utilisateurs</li>
                        <li>contient {{ countRoles }} groupes utilisateurs</li>
                        <li>contient {{ countPermissions }} permissions</li>
                        <li>https://www.netlify.com/ a tester</li>
                        <li>(new Tighten)->notify(new NewPackage($event->package))</li>
                    </ul>
                </div>
            </div>
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                <PlaceholderPattern />
            </div>
        </div>
    </AppLayout>
</template>
