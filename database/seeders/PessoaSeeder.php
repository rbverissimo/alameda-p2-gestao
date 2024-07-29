<?php

namespace Database\Seeders;

use App\Models\Pessoa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::transaction(function($closure){
            Pessoa::create([
                'nome' => 'Agmar',
                'telefone_celular' => '(62)98134-0903'
            ]);
    
            Pessoa::create([
                'nome' => 'Branca',
                'telefone_celular' => '(62)98204-6595'
            ]);
    
            Pessoa::create([
                'nome' => 'Ezequias',
                'telefone_celular' => '(62)99460-5658'
            ]);
    
            Pessoa::create([
                'nome' => 'Igor',
                'telefone_celular' => '(62)98143-2680'
            ]);
    
            Pessoa::create([
                'nome' => 'Paulo',
                'telefone_celular' => '(62)99213-7439' 
            ]);

            Pessoa::create([
                'nome' => 'Roberto Teste Oliveira',
                'telefone_fixo' => '6234563455',
                'telefone_celular' => '62996694548',
                'profissao' => 'Pedreiro',
                'cpf' => '32445322146'
            ]);

            Pessoa::create([
                'nome' => 'Higor Sanches',
                'telefone_fixo' => '6232334078',
                'telefone_celular' => '62991214430',
                'profissao' => 'Pedreiro',
                'cpf' => '00102232109'
            ]);
        });

    }
}
