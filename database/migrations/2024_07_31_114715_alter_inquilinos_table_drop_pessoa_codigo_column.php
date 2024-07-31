<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterInquilinosTableDropPessoaCodigoColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('PRAGMA foreign_keys = OFF;');
        DB::transaction(function () {
            Schema::table('inquilinos', function(Blueprint $table){
                $table->dropColumn('pessoacodigo');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('PRAGMA foreign_keys = OFF;');
        DB::transaction(function(){
            Schema::table('inquilinos',function(Blueprint $table){
                $table->unsignedBigInteger('pessoacodigo')->nullable();
                $table->foreign('pessoacodigo')
                    ->references('id')
                    ->on('pessoas');
            });
            
            $inquilinos = DB::table('inquilinos')->select('id', 'nome', 'cpf')->get();

            foreach ($inquilinos as $inquilino) {
                $cpf = $inquilino->cpf; 
                if($cpf !== null){
                    $sql = 'SELECT ID FROM PESSOAS WHERE NOME = ? AND CPF = ?';
                    $bindings = [$inquilino->nome, $cpf];
                    $pessoa = DB::select($sql, $bindings);

                    $id = $pessoa[0]->id; 

                    $update_query = 'UPDATE INQUILINOS SET PESSOACODIGO = ? WHERE ID = ?';
                    $update_bindings = [$id, $inquilino->id];
                    DB::update($update_query, $update_bindings);
                    continue;
                }

                $select_query = 'SELECT ID FROM PESSOAS WHERE NOME = ?';
                $select_bindings = [$inquilino->nome];
                $pessoa = DB::select($select_query, $select_bindings);

                $pessoa_id = $pessoa[0]->id; 

                $update_query = 'UPDATE INQUILINOS SET PESSOACODIGO = ? WHERE ID = ?';
                $update_bindings = [$pessoa_id, $inquilino->id];
                DB::update($update_query, $update_bindings);
            }

        });
    }
}
