<?php

namespace Database\Seeders;

use App\Models\Pessoa;
use Illuminate\Database\Seeder;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

    }
}
