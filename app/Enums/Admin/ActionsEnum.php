<?php

namespace App\Enums\Admin;

enum ActionsEnum: string
{
    case lister = "Lister";
    case voir = "Voir";
    case creer = "Créer";
    case modifier = "Modifier";
    case supprimer = "Supprimer";

    public function label(): string
    {
        return match ($this) {
            self::lister => "Lister",
            self::voir => "Voir",
            self::creer => "Créer",
            self::modifier => "Modifier",
            self::supprimer => "Supprimer",
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function options(): array
    {
        return array_map(
            fn($case) => ['value' => $case->name, 'name' => $case->value],
            self::cases()
        );
    }
}
