<?php

namespace Database\Seeders;

use App\Models\TipoComprovante;
use Illuminate\Database\Seeder;

class TipoComprovanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tp = new TipoComprovante();
        $tp->codigoSistema = '1000';
        $tp->tipo = 'Pagamento total de contas da referência';
        $tp->save();

        $tp2 = new TipoComprovante();
        $tp2->codigoSistema = '1001';
        $tp2->tipo = 'Pagamento parcial de contas da referência';
        $tp2->save();

        $tp3 = new TipoComprovante();
        $tp3->codigoSistema = '1002';
        $tp3->tipo = 'Pagamento de aluguel da referência';
        $tp3->save();

        $tp4 = new TipoComprovante();
        $tp4->codigoSistema = '2000';
        $tp4->tipo = 'Compras de materiais';
        $tp4->save();
    }
}
