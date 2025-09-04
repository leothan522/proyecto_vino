<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Usuario Root
        $root = User::factory()->create([
            'name' => !empty(env('ROOT_NAME')) ? env('ROOT_NAME') : 'Administrador',
            'email' => !empty(env('ROOT_EMAIL')) ? env('ROOT_EMAIL') : 'admin@morros-devops.xyz',
            'email_verified_at' => now(),
            'password' => Hash::make(env('ROOT_PASSWORD') ? env('ROOT_PASSWORD') : 'admin1234'),
            'is_root' => 1,
        ]);

        //Usuario Administrador
        if ($root->email != 'admin@morros-devops.xyz') {
            $admin = User::factory()->create([
                'name' => 'Administrador',
                'email' => 'admin@morros-devops.xyz',
                'email_verified_at' => now(),
                'password' => Hash::make('admin1234'),
            ]);
            $admin->assignRole('admin');
        }

    }
}
