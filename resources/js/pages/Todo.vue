<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';

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
    countFosts: number;
}>();
</script>

<template>
    <Head title="Administration" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl bg-amber-100 p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <p>TODO Installateurs</p>
                    <ul>
                        <li>Infos de bases</li>
                        <li>Adresses - facturation / Siège / travaux / autre</li>
                        <li>Conditions de facturation / RIB ??</li>
                        <li>Contacts pour cet installateur</li>
                        <li>Contrats</li>
                        <li>Documents</li>
                        <li>Agreements / RGE ou autre</li>
                        <li>Route de connection spécifique vers un /app par exemple</li>
                    </ul>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <p>TODO</p>
                    <ul>
                        <li>CRUD Installateurs</li>
                        <li>CRUD contrats Installateurs</li>
                        <li>CRUD pour les types de clients</li>
                        <li>CRUD pour les types de personnes morales</li>
                        <li>Ajouter le paramétrage des contrôles sur les Fiches</li>
                        <li>CRUD Bénéficiaires</li>
                        <li>Dossiers</li>
                    </ul>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <p>TODO Design</p>
                    <ul>
                        <li>Changer la page d'accueil</li>
                        <li>Changer la page de login</li>
                        <li>tester les datatables</li>
                        <li>tester les onglets</li>
                        <li>tester les notifications</li>
                        <li>https://www.netlify.com/ a tester</li>
                        <li>(new Tighten)->notify(new NewPackage($event->package))</li>
                    </ul>
                </div>
            </div>
            <div
                class="relative grid min-h-[100vh] flex-1 auto-rows-min gap-4 rounded-xl border border-sidebar-border/70 md:min-h-min md:grid-cols-4 dark:border-sidebar-border"
            >
                <ul class="m-4">
                    <li>contient {{ countUsers }} utilisateurs</li>
                    <li>contient {{ countRoles }} groupes utilisateurs</li>
                    <li>contient {{ countPermissions }} permissions</li>
                    <li>contient {{ countFosts }} fosts</li>
                </ul>
                <div>
                    <p>TODO FAIT</p>
                    <ul>
                        <li class="line-through">CRUD fiches</li>
                        <li class="line-through">CRUD pour les permissions</li>
                        <li class="line-through">Faire fonctionner les droits utilisateur back et front (Gate et can)</li>
                        <li>
                            <p class="line-through">CRUD pour les types de fiche FOS <span class="no-underline"> Remplacé par un ENUM</span></p>
                        </li>
                        <li>
                            <p class="line-through">CRUD pour les secteurs des fiche FOS <span class="no-underline"> Remplacé par un ENUM</span></p>
                        </li>
                        <li class="bold text-red-700 line-through">Pagination</li>
                        <li class="line-through">toaster message flash</li>
                        <li class="line-through">Ajouter les search sur les pages index</li>
                        <li>
                            ID reference_to id_rerefence type_reference $table->string('adresse')->nullable();
                            $table->string('complement_adresse')->nullable(); $table->string('code_postal')->nullable();
                            $table->string('ville')->nullable(); $table->string('pays')->nullable();
                        </li>
                    </ul>
                </div>
                <PlaceholderPattern />
            </div>
        </div>
    </AppLayout>
</template>
