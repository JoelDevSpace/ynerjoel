<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Adresse extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'type',
        'adresse',
        'adresse_complement',
        'lieu-dit',
        'code_postal',
        'ville',
        'pays',
        'parcelle_cadastrale_1',
        'parcelle_cadastrale_2',
        'parcelle_cadastrale_3',
    ];


    public function adressable(): MorphTo
    {
        return $this->morphTo();
    }

}
