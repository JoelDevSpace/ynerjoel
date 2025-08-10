<?php

namespace App\Enums\App;

enum SecteursFost: string
{
    case AGRI = "Agriculture";
    case BAR = "Résidentiel";
    case BAT = "Tertiaire";
    case IND = "Industrie";
    case RES = "Réseau";
    case TRA = "Transport";

    public function label(): string
    {
        return match ($this) {
            self::AGRI => "Agriculture",
            self::BAR => "Résidentiel",
            self::BAT => "Tertiaire",
            self::IND => "Industrie",
            self::RES => "Réseau",
            self::TRA => "Transport",
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
