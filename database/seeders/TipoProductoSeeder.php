<?php

namespace Database\Seeders;

use App\Models\TipoProducto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        TipoProducto::create([
            'nombre' => 'Vino Blanco',
            'imagen_path' => 'tipos-images/vino_blanco.jpg',
        ]);

        TipoProducto::create([
           'nombre' => 'Vino Rosado',
           'imagen_path' => 'tipos-images/vino_rosado.jpeg'
        ]);

        TipoProducto::create([
           'nombre' => 'Vino Tinto',
            'imagen_path' => 'tipos-images/vino_tinto.jpg'
        ]);

        TipoProducto::create([
            'nombre' => 'Vino de Manzana (Sidra)',
            'imagen_path' => 'tipos-images/sidra_manzana.jpg'
        ]);

        TipoProducto::create([
            'nombre' => 'Vinagre de Manzana',
            'imagen_path' => 'tipos-images/vinagre_manzana.jpg'
        ]);

    }
}
