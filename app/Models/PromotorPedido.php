<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PromotorPedido extends Model
{
    protected $table = 'promotores_pedidos';
    protected $fillable = [
        'promotores_id',
        'pedidos_id',
        'cantidad',
    ];

    public function promotor(): BelongsTo
    {
        return $this->belongsTo(Promotor::class, 'promotores_id', 'id');
    }

    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class, 'pedidos_id', 'id');
    }

}
