<?php

namespace App\Enums\Admin;

enum ActionsEnum: string
{
    case LISTER = "Lister";
    case VOIR = "Voir";
    case CREER = "Créer";
    case MODIFIER = "Modifier";
    case SUPPRIMER = "Supprimer";
    public static function options(): array
    {
        return array_map(
            fn($case) => ['value' => $case->name, 'name' => $case->value],
            self::cases()
        );
    }
}
