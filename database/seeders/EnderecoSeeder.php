<?php

namespace Database\Seeders;

use App\Models\Endereco;
use Illuminate\Database\Seeder;

class EnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Endereco::create([
            'cidade' => 'Goiânia',
            'logradouro' => 'Alameda P-2',
            'bairro' => 'Setor dos Funcionários',
            'numero' => 657,
            'cep' => '74543-030',
            'uf' => 'GO'
        ]);
    }
}
