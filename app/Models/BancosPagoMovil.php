<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BancosPagoMovil extends Model
{
    protected $table = 'bancos_pago_movil';
    protected $fillable = [
        'banco',
        'codigo',
        'rif',
        'telefono',
        'is_main',
    ];
}
