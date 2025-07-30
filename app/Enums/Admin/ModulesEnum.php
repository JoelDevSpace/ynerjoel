<?php

namespace App\Enums\Admin;

enum ModulesEnum: string
{
    case admin = "Administration";
    case exploit = "Exploitation";
    case config = "Configuration";
    case dossier = "Dossiers";
    case stats = "Statistiques";
    public static function options(): array
    {
        return array_map(
            fn($case) => ['value' => $case->name, 'name' => $case->value],
            self::cases()
        );
    }
}
