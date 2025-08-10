<?php

namespace App\Enums\Admin;

enum ModulesEnum: string
{
    case admin = "Administration";
    case exploit = "Exploitation";
    case config = "Configuration";
    case dossier = "Dossiers";
    case stats = "Statistiques";

    public function label(): string
    {
        return match ($this) {
            self::admin => "Administration",
            self::exploit => "Exploitation",
            self::config => "Configuration",
            self::dossier => "Dossiers",
            self::stats => "Statistiques",
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
