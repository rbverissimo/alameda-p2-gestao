<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImoveisTiposContasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $registro_1 = [
            'imovel' => 1,
            'tipoconta' => 2
        ];

        $registro_2 = [
            'imovel' => 1,
            'tipoconta' => 2
        ];

        DB::insert('INSERT INTO IMOVEIS_TIPOS_CONTAS(IMOVEL, TIPOCONTA) VALUES(?, ?)', [$registro_1['imovel'], $registro_1['tipoconta']]);
        DB::insert('INSERT INTO IMOVEIS_TIPOS_CONTAS(IMOVEL, TIPOCONTA) VALUES(?, ?)', [$registro_2['imovel'], $registro_2['tipoconta']]);
    }
}
