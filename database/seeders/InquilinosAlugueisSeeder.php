<?php

namespace Database\Seeders;

use App\Models\InquilinoAluguel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InquilinosAlugueisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::transaction(function ($closure) {
            $i = InquilinoAluguel::create([
                'inquilino' => 1,
                'valorAluguel' => 330.0,
                'inicioValidade' => 202302,
                'fimValidade' => 202501,
                'reajuste_previsto' => 4.5
            ]);
    
            $i->save();
    
            $i2 = InquilinoAluguel::create([
                'inquilino' => 2,
                'valorAluguel' => 550.0,
                'inicioValidade' => 202302,
                'fimValidade' => 202501,
                'reajuste_previsto' => 4.0
            ]);
    
            $i2->save();
    
            $i3 = InquilinoAluguel::create([
                'inquilino' => 3,
                'valorAluguel' => 440.0,
                'inicioValidade' => 202302,
                'reajuste_previsto' => 0.0
            ]);
    
            $i3->save();
    
            $i4 = InquilinoAluguel::create([
                'inquilino' => 4,
                'valorAluguel' => 600.0,
                'inicioValidade' => 202308,
                'fimValidade' => 202501,
                'reajuste_previsto' => 3.0
            ]);
    
            $i4->save();
    
            $i5 = InquilinoAluguel::create([
                'inquilino' => 5,
                'valorAluguel' => 550.0,
                'inicioValidade' => 202302,
                'fimValidade' => 202501,
                'reajuste_previsto' => 5.0
            ]);
    
            $i5->save(); 
        });
    }
}
