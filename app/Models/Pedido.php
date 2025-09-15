<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes;

    protected $table = 'pedidos';
    protected $fillable = [
        'codigo',
        'cedula',
        'nombre',
        'parroquia',
        'telefono',
        'direccion',
        'direccion2',
        'subtotal',
        'entrega',
        'total',
        'rowquid',
        'is_process',
        'users_id',
        'almacenes_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(PedidoItem::class, 'pedidos_id', 'id');
    }

}
