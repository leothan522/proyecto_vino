<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Carrito extends Model
{
    protected $table = 'carritos';
    protected $fillable = [
        'rowquid',
        'productos_id',
        'cantidad'
    ];

    public function producto() : BelongsTo
    {
        return $this->belongsTo(Producto::class, 'productos_id', 'id');
    }

}
