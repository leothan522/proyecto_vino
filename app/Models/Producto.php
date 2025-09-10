<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;

    protected $table = 'productos';
    protected $fillable = [
        'nombre',
        'tipos_id',
        'precio',
        'descripcion',
        'imagen_path',
        'is_active',
        'tipos_id',
    ];

    public function tipo(): BelongsTo
    {
        return $this->belongsTo(TipoProducto::class, 'tipos_id', 'id');
    }

}
