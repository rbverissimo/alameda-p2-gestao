<?php

use App\Models\Inquilino;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InsertIntoInquiliosTelefonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function($closure){

            $inquilinos = Inquilino::with('pessoa.telefones')->get();

            foreach ($inquilinos as $inquilino) {
                $pessoa = $inquilino->getRelation('pessoa');
                $telefones = $pessoa->getRelation('telefones');

                $sql = 'INSERT INTO INQUILINOS_TELEFONES(INQUILINO_ID,TELEFONE_ID,CREATED_AT,UPDATED_AT)VALUES(?,?,?,?)';
                foreach ($telefones as $telefone) {
                    $bindings = [ $inquilino->id, $telefone->id, $telefone->created_at, $telefone->updated_at];
                    DB::insert($sql, $bindings);
                }
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
        DB::transaction(function($closure){
            $inquilinos = Inquilino::all();

            foreach ($inquilinos as $inquilino) {
                $sql = 'DELETE FROM INQUILINOS_TELEFONES WHERE INQUILINO_ID = ?';
                DB::delete($sql, [$inquilino->id]);
            }
        });
    }
}
