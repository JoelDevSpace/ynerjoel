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

    public function label(): string
    {
        return match ($this) {
            self::BA => "Bâtiment",
            self::CH => "Chaleur",
            self::EC => "Eclairage",
            self::EN => "Enveloppe",
            self::EQ => "Équipement",
            self::SE => "Service",
            self::TH => "Thermique",
            self::UT => "Utilités",
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
