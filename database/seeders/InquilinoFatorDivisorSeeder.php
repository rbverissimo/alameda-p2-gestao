<?php

namespace Database\Seeders;

use App\Models\InquilinoFatorDivisor;
use Illuminate\Database\Seeder;

class InquilinoFatorDivisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fator = new InquilinoFatorDivisor();
        $fator->inquilino_id = 1;
        $fator->fatorDivisor = 0.9;
        $fator->save();

        $fator = new InquilinoFatorDivisor();
        $fator->inquilino_id = 2;
        $fator->fatorDivisor = 0.95;
        $fator->save();

        $fator = new InquilinoFatorDivisor();
        $fator->inquilino_id = 3;
        $fator->fatorDivisor = 0.9;
        $fator->save();

        $fator = new InquilinoFatorDivisor();
        $fator->inquilino_id = 4;
        $fator->fatorDivisor = 1.05;
        $fator->save();

        $fator = new InquilinoFatorDivisor();
        $fator->inquilino_id = 5;
        $fator->fatorDivisor = 1.2;
        $fator->save();
    }
}
