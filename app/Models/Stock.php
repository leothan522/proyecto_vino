<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use SoftDeletes;

    protected $table = 'stocks';
    protected $fillable = [
        'almacenes_id',
        'productos_id',
        'disponibles',
        'comprometidos',
        'vendidos',
    ];

    public function almacen(): BelongsTo
    {
        return $this->belongsTo(Almacen::class, 'almacenes_id', 'id');
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'productos_id', 'id');
    }

}
