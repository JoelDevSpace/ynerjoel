<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fost extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'code',
        'libelle',
        'Denomination',
        'date_debut',
        'date_fin',
        'modification_user_id',
    ];
    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
