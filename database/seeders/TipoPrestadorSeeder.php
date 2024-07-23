<?php

namespace Database\Seeders;

use App\Models\TipoPrestador;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoPrestadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {  
            TipoPrestador::create([
                'codigoSistema' => '0001',
                'tipo' => 'Pedreiro'
            ]);
    
            TipoPrestador::create([
                'codigoSistema' => '0002',
                'tipo' => 'Eletricista'
            ]);
    
            TipoPrestador::create([
                'codigoSistema' => '0003',
                'tipo' => 'Encanador'
            ]);
    
            TipoPrestador::create([
                'codigoSistema' => '0004',
                'tipo' => 'Chaveiro'
            ]);
    
            TipoPrestador::create([
                'codigoSistema' => '0010',
                'tipo' => 'Serviços Gerais'
            ]);
    
            TipoPrestador::create([
                'codigoSistema' => '0100',
                'tipo' => 'Empresa de Construção e Reforma'
            ]);
        });
    }
}
