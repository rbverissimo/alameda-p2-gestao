<?php

use App\Models\Pessoa;
use App\Utils\ProjectUtils;
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
        
        DB::transaction(function($closure){
            Schema::table('telefones', function(Blueprint $table){
                $table->unsignedBigInteger('pessoa_id')->nullable();
            });

            $resultado = DB::select('SELECT I.PESSOACODIGO, IT.TELEFONE_ID 
                FROM INQUILINOS I 
                JOIN INQUILINOS_TELEFONES IT ON IT.INQUILINO_ID = I.ID');
            
            $sql = 'UPDATE TELEFONES SET PESSOA_ID = ? WHERE ID = ?';
            foreach ($resultado as $registro) {
                $bindings = [$registro->pessoacodigo, $registro->telefone_id];
                DB::update($sql, $bindings);
            }

            $telefones_null_pessoa = DB::select('SELECT ID, DDD, TELEFONE, TIPO_TELEFONE FROM TELEFONES WHERE PESSOA_ID IS NULL');

            $ids_filtrados = array_map(function($item){
                return intval($item->pessoacodigo);
            }, $resultado);

            //telefone_fixo
            $pessoas = DB::table('pessoas')
                ->select('ID', 'TELEFONE_FIXO', 'TELEFONE_CELULAR', 'TELEFONE_TRABALHO')->whereNotIn('id', $ids_filtrados)
                ->get();

            foreach ($telefones_null_pessoa as $tnp) {
                $telefone = $tnp->ddd.$tnp->telefone; 
                if($tnp->tipo_telefone === '1000'){

                    foreach ($pessoas as $pessoa) {
                        $telefone_pessoa_normalizado = ProjectUtils::tirarMascara($pessoa->telefone_fixo);

                        if(strcmp($telefone, $telefone_pessoa_normalizado) === 0){
                            DB::update('UPDATE TELEFONES SET PESSOA_ID = ? WHERE ID = ?', [$pessoa->id, $tnp->id]);
                            break;
                        }
                    }
                }

                if($tnp->tipo_telefone === '1010'){
                    foreach ($pessoas as $pessoa) {
                        $telefone_pessoa_normalizado = ProjectUtils::tirarMascara($pessoa->telefone_celular);

                        if(strcmp($telefone, $telefone_pessoa_normalizado) === 0){
                            DB::update('UPDATE TELEFONES SET PESSOA_ID = ? WHERE ID = ?', [$pessoa->id, $tnp->id]);
                            break;
                        }
                    }
                }

                if($tnp->tipo_telefone === '1020'){
                    foreach ($pessoas as $pessoa) {
                        $telefone_pessoa_normalizado = ProjectUtils::tirarMascara($pessoa->telefone_trabalho);

                        if(strcmp($telefone, $telefone_pessoa_normalizado) === 0){
                            DB::update('UPDATE TELEFONES SET PESSOA_ID = ? WHERE ID = ?', [$pessoa->id, $tnp->id]);
                            break;
                        }
                    }
                }
            }
        });
    }
}
