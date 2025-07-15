<?php

namespace App\Enums\Admin;

enum ElementsEnum: string
{
    case UTILISATEUR = "Utilisateur";
    case GROUPE = "Groupe Utilisateurs";
    case PERMISSION = "Permission";
    public static function options(): array
    {
        return array_map(
            fn($case) => ['value' => $case->name, 'name' => $case->value],
            self::cases()
        );
    }
}
