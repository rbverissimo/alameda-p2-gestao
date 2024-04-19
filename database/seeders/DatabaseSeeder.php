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
            SalaSeeder::class,
            InquilinoSeeder::class,
            UsuarioMestreSeeder::class,
            UsuariosOperadoresSeeder::class
        ]);

        $this->call([InquilinoFatorDivisorSeeder::class]);

        $this->call([TipoComprovanteSeeder::class]);
    }
}