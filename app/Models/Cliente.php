<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $table = 'clientes';
    protected $fillable = [
        'cedula',
        'nombre',
        'telefono',
        'parroquias_id',
        'direccion',
        'direccion2',
        'users_id',
    ];

    public function parroquia(): BelongsTo
    {
        return $this->belongsTo(Parroquia::class, 'parroquias_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

}
