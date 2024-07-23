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
            UsuariosSeeder::class,
            ImobiliariaSeeder::class,
            TipoContaSeeder::class,
            TipoPrestadorSeeder::class,
            TipoComprovanteSeeder::class,
            TiposServicosSeeder::class
        ]);
    }
}