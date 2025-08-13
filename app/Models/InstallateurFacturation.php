<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InstallateurFacturation extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'condition_paiement',
        'installateur_id',
    ];
    public function installateur(): BelongsTo
    {
        return $this->belongsTo(Installateur::class, 'installateur_id', 'id');
    }
}
