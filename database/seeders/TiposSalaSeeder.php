<?php

namespace Database\Seeders;

use App\Models\TipoSala;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposSalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            TipoSala::create([
                'id' => '1',
                'descricao' => 'Residencial',
                'sistema' => 'S'
            ]);
    
            TipoSala::create([
                'id' => '2',
                'descricao' => 'Comercial',
                'sistema' => 'S'
            ]);
    
            TipoSala::create([
                'id' => '3',
                'descricao' => 'Uso misto',
                'sistema' => 'S'
            ]);

            TipoSala::create([
                'id' => '4',
                'descricao' => 'Imóvel',
                'sistema' => 'S'
            ]);
        });
    }
}
