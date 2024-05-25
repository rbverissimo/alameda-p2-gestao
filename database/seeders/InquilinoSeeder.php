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
        //$i->valorAluguel = 330.0;
        $i->pessoacodigo = 1;
        $i->situacao = 'A';
        $i->salacodigo = 1;
        $i->qtdePessoasFamilia = 1;
        $i->save();

        $i2 = new Inquilino();
        //$i2->valorAluguel = 550.0;
        $i2->pessoacodigo = 2;
        $i2->situacao = 'A';
        $i2->salacodigo = 2;
        $i2->qtdePessoasFamilia = 2;
        $i2->save();

        $i3 = new Inquilino();
        //$i3->valorAluguel = 440.0;
        $i3->pessoacodigo = 3;
        $i3->situacao = 'A';
        $i3->salacodigo = 1;
        $i3->qtdePessoasFamilia = 1;
        $i3->save();

        $i4 = new Inquilino();
        //$i4->valorAluguel = 600.0;
        $i4->pessoacodigo = 4;
        $i4->situacao = 'A';
        $i4->salacodigo = 2;
        $i4->qtdePessoasFamilia = 3;
        $i4->save();

        $i5 = new Inquilino();
        //$i5->valorAluguel = 550.0;
        $i5->pessoacodigo = 5;
        $i5->situacao = 'A';
        $i5->salacodigo = 1;
        $i5->qtdePessoasFamilia = 2;
        $i5->save();
    }
}
