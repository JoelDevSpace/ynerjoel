<?php

namespace App\Enums\Admin;

enum ElementsEnum: string
{
    case utilisateur = "Utilisateur";
    case groupe = "Groupe Utilisateurs";
    case permission = "Permission";
    case fost = "Fost";
    case installateur = "Installateur";

    public function label(): string
    {
        return match ($this) {
            self::utilisateur => "Utilisateur",
            self::groupe => "Groupe Utilisateurs",
            self::permission => "Permission",
            self::fost => "Fost",
            self::installateur => "Installateur",
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
