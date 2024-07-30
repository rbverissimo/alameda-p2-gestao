<?php

namespace Database\Seeders;

use App\Models\Inquilino;
use App\Models\Sala;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InquilinoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function($closure){


            $sala1 = Sala::select('id')->where('nomesala', 'Sala 1')->first();
            $casa2 = Sala::select('id')->where('nomesala', 'Casa 2')->first();

            $i = new Inquilino();
            $i->pessoacodigo = 1;
            $i->situacao = 'A';
            $i->salacodigo = $sala1->id;
            $i->qtdePessoasFamilia = 1;
            $i->save();
    
            $i2 = new Inquilino();
            $i2->pessoacodigo = 2;
            $i2->situacao = 'A';
            $i2->salacodigo = $casa2->id;
            $i2->qtdePessoasFamilia = 2;
            $i2->save();
    
            $i3 = new Inquilino();
            $i3->pessoacodigo = 3;
            $i3->situacao = 'A';
            $i3->salacodigo = $sala1->id;
            $i3->qtdePessoasFamilia = 1;
            $i3->save();
    
            $i4 = new Inquilino();
            $i4->pessoacodigo = 4;
            $i4->situacao = 'A';
            $i4->salacodigo = $casa2->id;
            $i4->qtdePessoasFamilia = 3;
            $i4->save();
    
            $i5 = new Inquilino();
            $i5->pessoacodigo = 5;
            $i5->situacao = 'A';
            $i5->salacodigo = $sala1->id;
            $i5->qtdePessoasFamilia = 2;
            $i5->save();
            
        });
    }
}
