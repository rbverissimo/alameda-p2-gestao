<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            EnderecoSeeder::class,
            ImovelSeeder::class,
            PessoaSeeder::class,
            TipoContaSeeder::class,
            TipoPrestadorSeeder::class,
            TipoComprovanteSeeder::class,
            SalaSeeder::class,
            InquilinoSeeder::class,
            InquilinoFatorDivisorSeeder::class,
            UsuarioMestreSeeder::class,
            UsuariosOperadoresSeeder::class,
            UsersImoveisSeeder::class
        ]);
    }
}