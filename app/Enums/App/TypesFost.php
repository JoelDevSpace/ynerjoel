<?php

namespace App\Enums\App;

enum TypesFost: string
{
    case EQ = "Équipement";
    case SE = "Service";
    case TH = "Thermique";
    case UT = "Utilités";
    case EN = "Enveloppe";
    case BA = "Bâtiment";
    case CH = "Chaleur";
    case EC = "Eclairage";
    public static function options(): array
    {
        return array_map(
            fn($case) => ['value' => $case->name, 'name' => $case->value],
            self::cases()
        );
    }
}
