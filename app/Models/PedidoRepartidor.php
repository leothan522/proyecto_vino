<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PedidoRepartidor extends Model
{
    protected $table = 'pedidos_repartidores';
    protected $fillable = [
        'pedidos_id',
        'repartidores_id'
    ];

    public function repartidor(): BelongsTo
    {
        return $this->belongsTo(Repartidor::class, 'repartidores_id', 'id');
    }

    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class, 'pedidos_id', 'id');
    }

}
