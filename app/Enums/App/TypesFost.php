<?php

namespace App\Enums\App;

enum TypesFost: string
{
    case BA = "Bâtiment";
    case CH = "Chaleur";
    case EC = "Eclairage";
    case EN = "Enveloppe";
    case EQ = "Équipement";
    case SE = "Service";
    case TH = "Thermique";
    case UT = "Utilités";

    public static function options(): array
    {
        return array_map(
            fn($case) => ['value' => $case->name, 'name' => $case->value],
            self::cases()
        );
    }
}
