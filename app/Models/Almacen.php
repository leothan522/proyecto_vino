<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Almacen extends Model
{
    use SoftDeletes;

    protected $table = 'almacenes';
    protected $fillable = [
        'nombre',
        'id_municipio',
        'is_main',
    ];

    public function municipio(): HasOne
    {
        return $this->hasOne(Municipio::class, 'id', 'id_municipio');
    }

    public function promotores(): HasMany
    {
        return $this->hasMany(Promotor::class, 'almacenes_id', 'id');
    }

    public function carrito(): HasMany
    {
        return $this->hasMany(Carrito::class, 'almacenes_id', 'id');
    }

}
