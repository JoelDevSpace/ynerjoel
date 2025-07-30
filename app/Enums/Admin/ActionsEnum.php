<?php

namespace App\Enums\Admin;

enum ActionsEnum: string
{
    case lister = "Lister";
    case voir = "Voir";
    case creer = "Créer";
    case modifier = "Modifier";
    case supprimer = "Supprimer";
    public static function options(): array
    {
        return array_map(
            fn($case) => ['value' => $case->name, 'name' => $case->value],
            self::cases()
        );
    }
}
