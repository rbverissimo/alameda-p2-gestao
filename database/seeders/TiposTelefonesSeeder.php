<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposTelefonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = 'INSERT INTO TIPOS_TELEFONES(CODIGO, TIPO) VALUES (?,?)';
        $bindings = [ 
            [ 1000, 'Fixo - Residencial'],
            [ 1020,  'Fixo - Trabalho'],
            [ 1010, 'Celular - Pessoal'],
            [ 1030, 'Celular - Trabalho'],
            [ 1300, 'Orelhão próximo'] 
        ];

        foreach ($bindings as $bind) {
            DB::insert($sql, $bind);
        }
    }
}
