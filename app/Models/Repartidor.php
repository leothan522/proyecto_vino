<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Repartidor extends Model
{
    use SoftDeletes;

    protected $table = 'repartidores';
    protected $fillable = [
        'nombre',
        'telefono',
    ];

    public function pedidos(): HasMany
    {
        return $this->hasMany(PedidoRepartidor::class, 'repartidores_id', 'id');
    }

}
