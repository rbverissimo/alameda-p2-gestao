<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsuariosOperadoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Renato',
            'email' => 'renatobarbosaverissimo@gmail.com',
            'password' => 'Guitarra12@'
        ]);

        User::create([
            'name' => 'Marivalda',
            'email' => 'm_bverissimo@yahoo.com.br',
            'password' => 'marivalda$acesso@90'
        ]);
    }
}
