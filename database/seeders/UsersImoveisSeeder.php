<?php

namespace Database\Seeders;

use App\Models\UsuarioImovel;
use Illuminate\Database\Seeder;

class UsersImoveisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UsuarioImovel::create([
            'idUsuario' => 1,
            'idImovel' => 1
        ]);

        UsuarioImovel::create([
            'idUsuario' => 2,
            'idImovel' => 1
        ]);

        UsuarioImovel::create([
            'idUsuario' => 3,
            'idImovel' => 1
        ]);
    }
}
