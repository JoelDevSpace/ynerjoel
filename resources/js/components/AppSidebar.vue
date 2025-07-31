<script setup lang="ts">
import NavMain from '@/components/NavMain.vue';
import NavProjects from '@/components/NavProjects.vue';
import NavUser from '@/components/NavUser.vue';
import SearchForm from '@/components/SearchForm.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarGroup,
    SidebarGroupLabel,
    SidebarHeader,
    SidebarMenuButton,
    type SidebarProps,
} from '@/components/ui/sidebar';
import { Link } from '@inertiajs/vue3';
import { ChartArea, ClipboardCheck, FolderOpen, Frame, LayoutGrid, PieChart, Settings, Wrench } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const props = defineProps<SidebarProps>();

const data = {
    navMain: [
        {
            title: 'Administration',
            url: '#',
            icon: Wrench,
            isActive: route().current('*admin*'),
            items: [
                {
                    title: 'Utilisateurs',
                    url: route('admin.users.index'),
                    permission: 'admin.utilisateur.lister',
                },
                {
                    title: 'Groupes Utilisateurs',
                    url: route('admin.roles.index'),
                    permission: 'admin.groupe.lister',
                },
                {
                    title: 'Permissions',
                    url: route('admin.permissions.index'),
                    permission: 'admin.permission.lister',
                },
            ],
        },
        {
            title: 'Exploitation',
            url: '#',
            icon: Settings,
            isActive: route().current('*exploitation*'),
            items: [
                {
                    title: 'Fosts',
                    url: route('exploitation.fosts.index'),
                    permission: 'exploit.fost.lister',
                },
                {
                    title: 'Installateurs',
                    url: route('exploitation.installateurs.index'),
                    permission: 'exploit.installateur.lister',
                },
            ],
        },
        {
            title: 'Activité',
            url: '#',
            icon: FolderOpen,
            items: [
                {
                    title: 'Introduction',
                    url: '#',
                },
                {
                    title: 'Get Started',
                    url: '#',
                },
                {
                    title: 'Tutorials',
                    url: '#',
                },
                {
                    title: 'Changelog',
                    url: '#',
                },
            ],
        },
        {
            title: 'Reporting',
            url: '#',
            icon: ChartArea,
            items: [
                {
                    title: 'Statistiques',
                    url: '#',
                },
                {
                    title: 'Team',
                    url: '#',
                },
                {
                    title: 'Billing',
                    url: '#',
                },
                {
                    title: 'Limits',
                    url: '#',
                },
            ],
        },
    ],
    projects: [
        {
            name: 'Todo list',
            url: route('todo'),
            icon: ClipboardCheck,
        },
        {
            name: 'Dossiers',
            url: '#',
            icon: PieChart,
        },
        {
            name: 'Lots',
            url: '#',
            icon: Frame,
        },
    ],
};
</script>

<template>
    <Sidebar v-bind="props">
        <SidebarHeader>
            <SidebarMenuButton size="lg" as-child>
                <Link :href="route('dashboard')">
                    <AppLogo />
                </Link>
            </SidebarMenuButton>
            <SearchForm />
        </SidebarHeader>
        <SidebarContent class="gap-0">
            <SidebarGroup>
                <SidebarGroupLabel class="group/label text-sm text-sidebar-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground">
                    <a :href="route('dashboard')" class="flex items-center">
                        <component :is="LayoutGrid" />
                        <span class="ml-2">Dashboard</span>
                    </a>
                </SidebarGroupLabel>
            </SidebarGroup>
            <NavMain :items="data.navMain" />
            <NavProjects :projects="data.projects" />
        </SidebarContent>
        <SidebarFooter>
            <NavUser />
        </SidebarFooter>
    </Sidebar>
</template>
