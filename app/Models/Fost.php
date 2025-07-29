<?php

namespace App\Models;

use \DateTimeInterface;
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
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'date_debut',
        'date_fin',
    ];
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
