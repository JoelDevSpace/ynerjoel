<script setup lang="ts">
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from '@/components/ui/collapsible';
import {
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarMenuSub,
    SidebarMenuSubButton,
    SidebarMenuSubItem,
} from '@/components/ui/sidebar';
import { can } from '@/lib/can';
import { ChevronRight, type LucideIcon } from 'lucide-vue-next';

defineProps<{
    items: {
        title: string;
        url: string;
        icon?: LucideIcon;
        isActive?: boolean;
        permission?: string;
        items?: {
            title: string;
            url: string;
            permission?: string;
        }[];
    }[];
}>();
</script>

<template>
    <SidebarGroup>
        <SidebarGroupLabel>Gestion</SidebarGroupLabel>
        <SidebarMenu>
            <Collapsible v-for="item in items" :key="item.title" as-child :default-open="item.isActive" class="group/collapsible">
                <SidebarMenuItem>
                    <CollapsibleTrigger as-child>
                        <SidebarMenuButton :tooltip="item.title">
                            <a :href="item.url" class="flex">
                                <component :is="item.icon" v-if="item.icon" class="mr-2 h-5 w-5" />
                                <span>{{ item.title }}</span>
                            </a>
                            <ChevronRight class="ml-auto transition-transform duration-200 group-data-[state=open]/collapsible:rotate-90" />
                        </SidebarMenuButton>
                    </CollapsibleTrigger>
                    <CollapsibleContent>
                        <SidebarMenuSub>
                            <SidebarMenuSubItem v-for="subItem in item.items" :key="subItem.title">
                                <SidebarMenuSubButton as-child v-if="!subItem.permission || can(subItem.permission)">
                                    <a :href="subItem.url">
                                        <span>{{ subItem.title }}</span>
                                    </a>
                                </SidebarMenuSubButton>
                            </SidebarMenuSubItem>
                        </SidebarMenuSub>
                    </CollapsibleContent>
                </SidebarMenuItem>
            </Collapsible>
        </SidebarMenu>
    </SidebarGroup>
</template>
