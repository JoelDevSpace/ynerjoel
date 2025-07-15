<?php

namespace App\Enums\Admin;

enum ModulesEnum: string
{
    case ADMIN = "Administration";
    case CONFIG = "Configuration";
    case DOSSIERS = "Dossiers";
    case STATS = "Statistiques";
    public static function options(): array
    {
        return array_map(
            fn($case) => ['value' => $case->name, 'name' => $case->value],
            self::cases()
        );
    }
}
