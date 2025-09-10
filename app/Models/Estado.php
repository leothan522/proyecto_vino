<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estado extends Model
{
    protected $table = 'estados';
    protected $fillable = [
        'estado',
        'iso_3166-2',
    ];

    public function municipios(): HasMany
    {
        return $this->hasMany(Municipio::class, 'id_estado', 'id');
    }

    public function ciudades(): HasMany
    {
        return $this->hasMany(Ciudad::class, 'id_estados', 'id');
    }

}
