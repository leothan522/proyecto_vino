<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    protected $table = 'galerias';
    protected $fillable = [
        'fecha',
        'titulo',
        'descripcion',
        'imagen_path',
    ];
}
