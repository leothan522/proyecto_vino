<?php

namespace Database\Seeders;

use App\Models\Parroquia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VenezuelaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared(
            file_get_contents(storage_path('app/private/venezuela.sql'))
        );

        $parroquia = Parroquia::find(432);
        if ($parroquia){
            $parroquia->created_at = now();
            $parroquia->save();
        }
    }
}
