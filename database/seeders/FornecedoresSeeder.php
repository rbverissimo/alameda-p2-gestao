<?php

namespace Database\Seeders;

use App\Models\Endereco;
use App\Models\Fornecedor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FornecedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::transaction(function($closure){
            Endereco::create([
                'cidade' => 'Goiânia',
                'logradouro' => 'Avenida Consolação',
                'bairro' => 'Nossa Sra. de Fátima',
                'numero' => 1717,
                'cep' => '74420-230',
                'uf' => 'GO'
            ]);

            Fornecedor::create([
                'nome_fornecedor' => 'Multicores',
                'cnpj' => '39830354000107',
                'telefone' => '6241035308',
                'endereco' => DB::getPdo()->lastInsertId()
            ]);

        });

        
    }
}
