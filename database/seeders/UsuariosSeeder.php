<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
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
            
            User::create([
                'name' => 'testes',
                'email' => 'hotstreetbrasil@gmail',
                'password' => 'te$t3R@101'
            ]);
        });
    }
}
