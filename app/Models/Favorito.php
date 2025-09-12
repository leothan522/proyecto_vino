<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorito extends Model
{
    protected $table = 'favoritos';
    protected $fillable = [
        'users_id',
        'productos_id'
    ];

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'productos_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

}
