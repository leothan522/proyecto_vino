<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        'bodega',
        'estatus',
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

    public function almacen(): BelongsTo
    {
        return $this->belongsTo(Almacen::class, 'almacenes_id', 'id');
    }

    public function pagos(): HasMany
    {
        return $this->hasMany(PedidoPago::class, 'pedidos_id', 'id');
    }

    public function promotor(): HasOne
    {
        return $this->hasOne(PromotorPedido::class, 'pedidos_id', 'id');
    }

    public function repartidor(): HasOne
    {
        return $this->hasOne(PedidoRepartidor::class, 'pedidos_id', 'id');
    }

}
