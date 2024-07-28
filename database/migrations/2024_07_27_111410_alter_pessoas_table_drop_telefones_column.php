<?php

use App\Models\Pessoa;
use App\Models\Telefone;
use App\Utils\ProjectUtils;
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

                if(!$this->isNullOrBlank($pessoa->telefone_celular)){
                    $telefoneArr = $this->converterTelefones($pessoa->telefone_celular);
                    $tipo = 1010;

                    $telefones_para_migrar[] = [
                        'pessoa_id' => $pessoa->id,
                        'ddd' => $telefoneArr['ddd'],
                        'telefone' => $telefoneArr['telefone'],
                        'tipo_telefone' => $tipo
                    ];
                }

                if(!$this->isNullOrBlank($pessoa->telefone_fixo)){
                    $telefoneArr = $this->converterTelefones($pessoa->telefone_fixo);
                    $tipo = 1000;

                    $telefones_para_migrar[] = [
                        'pessoa_id' => $pessoa->id,
                        'ddd' => $telefoneArr['ddd'],
                        'telefone' => $telefoneArr['telefone'],
                        'tipo_telefone' => $tipo
                    ];
                }

                if(!$this->isNullOrBlank($pessoa->telefone_trabalho)){
                    $telefoneArr = $this->converterTelefones($pessoa->telefone_trabalho);
                    $tipo = 1020;

                    $telefones_para_migrar[] = [
                        'pessoa_id' => $pessoa->id,
                        'ddd' => $telefoneArr['ddd'],
                        'telefone' => $telefoneArr['telefone'],
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
                        'tipo_telefone' => $telefone['tipo_telefone']
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
        Schema::table('pessoas', function(Blueprint $table){
            $table->string('telefone_fixo', 10)->nullable();
            $table->string('telefone_celular', 11)->nullable();
            $table->string('telefone_trabalho')->nullable();
        });

        $telefones = Telefone::all();

        foreach ($telefones as $telefone) {
            $pessoaId = $telefone->pessoa_id;
            $telefonePessoa = $telefone->ddd.$telefone->telefone;
            $tipoTelefone = $telefone->tipo_telefone;

            $pessoa = Pessoa::find($pessoaId);

            switch ($tipoTelefone) {
                case 1000:
                    $pessoa->telefone_fixo = $telefonePessoa;
                    break;
                case 1020:
                    $pessoa->telefone_trabalho = $telefonePessoa;
                    break;
                case 1010:
                    $pessoa->telefone_celular = $telefonePessoa;
                    break;
                default:
                    break;
            }

            $pessoa->save();

        }

        $telefones = Telefone::destroy($telefones);

    }

    private function converterTelefones($telefoneComDDD){
        $ddd = substr(ProjectUtils::tirarMascara($telefoneComDDD), 0, 2);
        $telefone = substr(ProjectUtils::tirarMascara($telefoneComDDD), 2);

        return [ 'ddd' => $ddd, 'telefone' => $telefone];
    }

    private function isNullOrBlank($str){
        return $str === null || $str === '';
    }
}
