<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class Fost extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'code',
        'libelle',
        'denomination',
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
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'modification_user_id', 'id');
    }
    public function scopeSearch(Builder $query, Request $request)
    {
        return $query->where(function ($query) use ($request) {
            return $query->when($request->search, function ($query) use ($request) {
                return $query->where(function ($query) use ($request) {
                    $query->where('code', 'like', '%' . $request->search . '%')
                        ->orWhere('libelle', 'like', '%' . $request->search . '%');
                });
            });
        });
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }

}
