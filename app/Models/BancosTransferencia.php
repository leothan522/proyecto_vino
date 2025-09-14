<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BancosTransferencia extends Model
{
    protected $table = 'bancos_transferencias';
    protected $fillable = [
        'titular',
        'cuenta',
        'rif',
        'tipo',
        'banco',
        'is_main',
    ];
}
