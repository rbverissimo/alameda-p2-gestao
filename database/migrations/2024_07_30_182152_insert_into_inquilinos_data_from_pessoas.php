<?php

use App\Models\Inquilino;
use App\Models\Pessoa;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InsertIntoInquilinosDataFromPessoas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            /**
             * @var Inquilino
             */
             $inquilinos = Inquilino::with('pessoa')->get();

             foreach ($inquilinos as $inquilino) {
                $pessoa = $inquilino->getRelation('pessoa');

                $inquilino->nome = $pessoa->nome;
                $inquilino->cpf = $pessoa->cpf;
                $inquilino->profissao = $pessoa->profissao;
                $inquilino->endereco_trabalho = $pessoa->endereco_trabalho;

                $inquilino->save();

            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::transaction(function(){

            /**
             * @var Inquilino
             */
            $inquilinos = Inquilino::with('pessoa')->get();

            foreach ($inquilinos as $inquilino) {

                $inquilino->nome = null;
                $inquilino->cpf = null;
                $inquilino->profissao = null;
                $inquilino->endereco_trabalho = null;

                $inquilino->save();
            }
        });
    }
}
