<?php

namespace Database\Seeders;

use App\Models\Sala;
use Illuminate\Database\Seeder;

class SalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        Sala::create([
            'imovelCodigo' => '1',
            'nomeSala' => 'Sala 1',
            'qtdeFamilias' => '3',
            'qtdeMoradores' => '4'
        ]);
        
        Sala::create([
            'imovelCodigo' => '1',
            'nomeSala' => 'Casa 2',
            'qtdeFamilias' => '2',
            'qtdeMoradores' => '5'
        ]);
        
        Sala::create([
            'imovelCodigo' => '1',
            'nomeSala' => 'Casa 3',
        ]);
        
        Sala::create([
            'imovelCodigo' => '1',
            'nomeSala' => 'Global'
        ]);
    }
}
