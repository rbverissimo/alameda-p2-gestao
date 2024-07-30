<?php

namespace Database\Seeders;

use App\Models\Imobiliaria;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImobiliariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::transaction(function () {
            
            $usuario_id = User::where('name', 'testes')
                ->pluck('id')
                ->first();
    
            Imobiliaria::create([
                'nome' => 'Imobi Imóveis - Imobiliária Teste',
                'usuario_id' => $usuario_id
            ]);

            $usuario_id = User::where('name', 'Renato')
                ->pluck('id')
                ->first();
            
            Imobiliaria::create([
                'nome' => 'Imobiliária do Renato',
                'usuario_id' => $usuario_id
            ]);

        });
    }
}
