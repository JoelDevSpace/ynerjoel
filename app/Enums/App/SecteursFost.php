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
    public static function options(): array
    {
        return array_map(
            fn($case) => ['value' => $case->name, 'name' => $case->value],
            self::cases()
        );
    }
}
