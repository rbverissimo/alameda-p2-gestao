<?php

namespace Database\Seeders;

use App\Models\TipoPrestador;
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
            TipoPrestadorSeeder::class
        ]);
    }
}
