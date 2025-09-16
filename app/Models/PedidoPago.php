<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoPago extends Model
{
    use SoftDeletes;

    protected $table = 'pedidos_pagos';
    protected $fillable = [
        'pedidos_id',
        'metodo',
        'referencia',
        'monto',
        'titular',
        'cuenta',
        'rif',
        'tipo',
        'banco',
        'codigo',
        'telefono',
        'is_validated',
        'validated',
        'user_name',
        'user_email',
        'user_telefono',
        'users_id',
    ];

    public function pedido(): BelongsTo
    {
        return  $this->belongsTo(Pedido::class, 'pedidos_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

}
