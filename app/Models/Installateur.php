<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\Adresse;
class Installateur extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'designation_juridique',
        'nom_commercial',
        'siren',
        'num_etablissement',
        'numero_tva',
        'telephone',
        'email',
        'site_web',
        'actif',
        'modification_user_id',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'modification_user_id', 'id');
    }
    public function adresses(): MorphMany
    {
        return $this->morphMany(Adresse::class, 'adressable');
    }
    public function scopeSearch(Builder $query, Request $request)
    {
        return $query->where(function ($query) use ($request) {
            return $query->when($request->search, function ($query) use ($request) {
                return $query->where(function ($query) use ($request) {
                    $query->where('designation_juridique', 'like', '%' . $request->search . '%')
                        ->orWhere('nom_commercial', 'like', '%' . $request->search . '%');
                });
            });
        });
    }
}
