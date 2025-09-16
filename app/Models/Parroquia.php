<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Parroquia extends Model
{
    protected $table = 'parroquias';
    protected $fillable = [
        'id_municipio',
        'parroquia',
    ];

    public function municipio(): BelongsTo
    {
        return $this->belongsTo(Municipio::class, 'id_municipio', 'id');
    }

    public function clientes(): HasMany
    {
        return $this->hasMany(Cliente::class, 'parroquias_id', 'id');
    }

}
