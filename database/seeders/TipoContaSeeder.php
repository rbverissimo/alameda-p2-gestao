<?php

namespace Database\Seeders;

use App\Models\TipoConta;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoContaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::transaction(function () {
            TipoConta::create([
                'codigo' => 1000,
                'descricao' => 'Água - Saneago',
                'sistema' => 'S',
                'isFatorDivisor' => 'S'
            ]);

            TipoConta::create([
                'codigo' => 1001,
                'descricao' => 'Energia - Equatorial',
                'sistema' => 'S',
                'isFatorDivisor' => 'S'
            ]);

            TipoConta::create([
                'codigo' => 1002,
                'descricao' => 'Gás encanado',
                'sistema' => 'S',
                'isFatorDivisor' => 'N'
            ]);
        });

    }
}
