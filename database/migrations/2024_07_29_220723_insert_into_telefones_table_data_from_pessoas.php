<?php

use App\Models\Pessoa;
use App\Models\Telefone;
use App\Utils\ProjectUtils;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InsertIntoTelefonesTableDataFromPessoas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function($closure){

            $pessoas = Pessoa::all();

            foreach ($pessoas as $pessoa) {
                
                if($this->isTelefoneValido($pessoa->telefone_fixo)){
                    $telefone_valido = $this->converterTelefone($pessoa->telefone_fixo);
                    Telefone::create([
                        'pessoa_id' => $pessoa->id,
                        'ddd' => $telefone_valido['ddd'],
                        'telefone' => $telefone_valido['telefone'],
                        'tipo_telefone' => 1000
                    ]);
                }

                if($this->isTelefoneValido($pessoa->telefone_celular)){
                    $telefone_valido = $this->converterTelefone($pessoa->telefone_celular);
                    Telefone::create([
                        'pessoa_id' => $pessoa->id,
                        'ddd' => $telefone_valido['ddd'],
                        'telefone' => $telefone_valido['telefone'],
                        'tipo_telefone' => 1010
                    ]);
                }

                if($this->isTelefoneValido($pessoa->telefone_trabalho)){
                    $telefone_valido = $this->converterTelefone($pessoa->telefone_trabalho);
                    Telefone::create([
                        'pessoa_id' => $pessoa->id,
                        'ddd' => $telefone_valido['ddd'],
                        'telefone' => $telefone_valido['telefone'],
                        'tipo_telefone' => 1020
                    ]);
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
            $pessoas = Pessoa::select('id')->get();
            foreach ($pessoas as $pessoa) {
                DB::delete('DELETE FROM TELEFONES WHERE PESSOA_ID = ?', [$pessoa->id]);
            }
        });
    }

    private function converterTelefone($telefone){
        $ddd = substr(ProjectUtils::tirarMascara($telefone), 0, 2);
        $telefone_sem_ddd = substr(ProjectUtils::tirarMascara($telefone), 2);
        return [ 'ddd' => $ddd, 'telefone' => $telefone_sem_ddd];
    }

    private function isTelefoneValido($telefone){
        $telefone_string = ProjectUtils::tirarMascara($telefone);
        return $telefone_string !== null && $telefone_string !== '';
    }
}
