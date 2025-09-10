<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoProducto extends Model
{
    use SoftDeletes;

    protected $table = 'tipos_productos';
    protected $fillable = [
        'nombre',
        'imagen_path',
        'is_active'
    ];

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'tipos_id', 'id');
    }

}
