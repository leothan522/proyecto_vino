<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotor extends Model
{
    use SoftDeletes;

    protected $table = 'promotores';
    protected $fillable = [
        'codigo',
        'inicio_comision',
        'meses_comision',
        'stock_vendidos',
        'is_active',
        'users_id',
        'image_qr',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function pedidos(): HasMany
    {
        return $this->hasMany(PromotorPedido::class, 'promotores_id', 'id');
    }

}
