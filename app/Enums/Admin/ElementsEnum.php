<?php

namespace App\Enums\Admin;

enum ElementsEnum: string
{
    case utilisateur = "Utilisateur";
    case groupe = "Groupe Utilisateurs";
    case permission = "Permission";
    case fost = "Fost";
    case installateur = "Installateur";
    public static function options(): array
    {
        return array_map(
            fn($case) => ['value' => $case->name, 'name' => $case->value],
            self::cases()
        );
    }
}
