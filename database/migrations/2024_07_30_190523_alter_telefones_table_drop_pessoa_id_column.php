<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterTelefonesTableDropPessoaIdColumn extends Migration
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
            Schema::table('telefones', function(Blueprint $table){
                $table->dropColumn('pessoa_id');
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
        Schema::table('telefones', function(Blueprint $table){
            $table->unsignedBigInteger('pessoa_id')->nullable();
        });

        DB::transaction(function($closure){

            $resultado = DB::select('SELECT I.PESSOACODIGO, IT.TELEFONE_ID 
                FROM INQUILINOS I 
                JOIN INQUILINOS_TELEFONES IT ON IT.INQUILINO_ID = I.ID');
            
            $sql = 'UPDATE TELEFONES SET PESSOA_ID = ? WHERE ID = ?';
            foreach ($resultado as $registro) {
                $bindings = [$registro->pessoacodigo, $registro->telefone_id];
                DB::update($sql, $bindings);
            }

        });
    }
}
