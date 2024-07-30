<?php

namespace Database\Seeders;

use App\Models\Sala;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {      
        
        DB::transaction(function($closure){

            Sala::create([
                'imovelCodigo' => '1',
                'nomeSala' => 'Sala 1',
                'tipo_sala' => 1
            ]);
            
            Sala::create([
                'imovelCodigo' => '1',
                'nomeSala' => 'Casa 2',
                'tipo_sala' => 1
            ]);
            
            Sala::create([
                'imovelCodigo' => '1',
                'nomeSala' => 'Casa 3',
                'tipo_sala' => 1,
            ]);
            
            Sala::create([
                'imovelCodigo' => '1',
                'nomeSala' => 'Global',
                'tipo_sala' => 1
            ]);
        });
    }
}
