<?php

namespace Database\Seeders;

use App\Models\Inquilino;
use Illuminate\Database\Seeder;

class InquilinoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = new Inquilino();
        $i->valorAluguel = 330;
        $i->pessoaCodigo = 1;
        $i->situacao = 'A';
        $i->salaCodigo = 1;
        $i->qtdePessoasFamilia = 1;
        $i->save();

        $i2 = new Inquilino();
        $i2->valorAluguel = 550;
        $i2->pessoaCodigo = 2;
        $i2->situacao = 'A';
        $i2->salaCodigo = 2;
        $i2->qtdePessoasFamilia = 2;
        $i2->save();

        $i3 = new Inquilino();
        $i3->valorAluguel = 440;
        $i3->pessoaCodigo = 3;
        $i3->situacao = 'A';
        $i3->salaCodigo = 1;
        $i3->qtdePessoasFamilia = 1;
        $i3->save();

        $i4 = new Inquilino();
        $i4->valorAluguel = 600;
        $i4->pessoaCodigo = 4;
        $i4->situacao = 'A';
        $i4->salaCodigo = 2;
        $i4->qtdePessoasFamilia = 3;
        $i4->save();

        $i5 = new Inquilino();
        $i5->valorAluguel = 550;
        $i5->pessoaCodigo = 5;
        $i5->situacao = 'A';
        $i5->salaCodigo = 1;
        $i5->qtdePessoasFamilia = 2;
        $i5->save();
    }
}
