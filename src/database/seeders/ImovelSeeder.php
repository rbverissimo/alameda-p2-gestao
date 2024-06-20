<?php

namespace Database\Seeders;

use App\Models\Imovel;
use Illuminate\Database\Seeder;

class ImovelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imovel = new Imovel();
        $imovel->nomeFantasia = 'Alameda P2';
        $imovel->qtdeCasas = 3;
        $imovel->endereco = 1;

        $imovel->save();

    }
}
