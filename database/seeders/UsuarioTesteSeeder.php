<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsuarioTesteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'testes',
            'email' => 'hotstreetbrasil@gmail',
            'password' => 'te$t3R@101'
        ]);
    }
}
