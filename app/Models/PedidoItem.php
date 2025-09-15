<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PedidoItem extends Model
{
    protected $table = 'pedidos_items';
    protected $fillable = [
        'pedidos_id',
        'producto',
        'tipo',
        'precio',
        'descripcion',
        'imagen_path',
        'almacen',
        'cantidad',
        'productos_id',
        'almacenes_id',
    ];

    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class, 'pedidos_id', 'id');
    }
}
