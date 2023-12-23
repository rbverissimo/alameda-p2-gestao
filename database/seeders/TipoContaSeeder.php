<?php

namespace Database\Seeders;

use App\Models\TipoConta;
use Illuminate\Database\Seeder;

class TipoContaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t1 = new TipoConta();
        $t1->codigo = 1000;
        $t1->descricao = 'Água - Saneago';

        $t2 = new TipoConta();
        $t2->codigo = 1001;
        $t2->descricao = 'Energia - Equatorial';

        $t1->save();
        $t2->save();
    }
}
