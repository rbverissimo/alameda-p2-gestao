<?php

use App\Models\Pessoa;
use App\Models\Telefone;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterPessoasTableDropTelefonesColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        DB::transaction(function($closure){
            $pessoas = Pessoa::select('id','telefone_trabalho', 'telefone_fixo', 'telefone_celular')->get();

            $telefones_para_migrar = [];
            foreach($pessoas as $pessoa){

                if($pessoa->telefone_celular !== null){
                    $ddd_celular = array_slice($pessoa->telefone_celular, 0, 2);
                    $telefone_sem_ddd = array_slice($pessoa->telefone_celular, 2);
                    $tipo = 1010;

                    $telefones_para_migrar[] = [
                        'pessoa_id' => $pessoa->id,
                        'ddd' => $ddd_celular,
                        'telefone' => $telefone_sem_ddd,
                        'tipo_telefone' => $tipo
                    ];
                }

                if($pessoa->telefone_fixo !== null){
                    $ddd_fixo = array_slice($pessoa->telefone_fixo, 0, 2);
                    $telefone_sem_ddd = array_slice($pessoa->telefone_fixo, 2);
                    $tipo = 1000;

                    $telefones_para_migrar[] = [
                        'pessoa_id' => $pessoa->id,
                        'ddd' => $ddd_fixo,
                        'telefone' => $telefone_sem_ddd,
                        'tipo_telefone' => $tipo
                    ];
                }

                if($pessoa->telefone_trabalho !== null){
                    $ddd_trabalho = array_slice($pessoa->telefone_fixo, 0, 2);
                    $telefone_sem_ddd = array_slice($pessoa->telefone_fixo, 2);
                    $tipo = 1020;

                    $telefones_para_migrar[] = [
                        'pessoa_id' => $pessoa->id,
                        'ddd' => $ddd_trabalho,
                        'telefone' => $telefone_sem_ddd,
                        'tipo_telefone' => $tipo
                    ];
                }
            }

            foreach($telefones_para_migrar as $telefone){
                Telefone::create(
                    [
                        'pessoa_id' => $telefone['pessoa_id'],
                        'ddd' => $telefone['ddd'],
                        'telefone' => $telefone['telefone'],
                        'tipo_telefone' => $telefone['tipo']
                    ]
                );
            }
        });

        Schema::table('pessoas', function(Blueprint $table){
            $table->dropColumn('telefone_fixo');
        });

        Schema::table('pessoas', function(Blueprint $table){
            $table->dropColumn('telefone_celular');
        });

        Schema::table('pessoas', function(Blueprint $table){
            $table->dropColumn('telefone_trabalho');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
