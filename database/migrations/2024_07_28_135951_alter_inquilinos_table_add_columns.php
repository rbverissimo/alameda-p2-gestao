<?php

use App\Models\Endereco;
use App\Models\Inquilino;
use App\Models\Pessoa;
use App\Models\Telefone;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterInquilinosTableAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inquilinos', function(Blueprint $table){
            $table->string('nome', 60)->index()->nullable();
            $table->string('cpf', 11)->index()->nullable();
            $table->unsignedBigInteger('endereco_trabalho')->nullable();
            $table->string('profissao',60)->nullable();

            $table->foreign('endereco_trabalho')
                ->references('id')
                ->on('enderecos')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });

        Schema::create('inquilinos_telefones', function(Blueprint $table){
            $table->unsignedBigInteger('inquilino_id');
            $table->unsignedBigInteger('telefone_id')->unique();
            $table->primary(['inquilino_id', 'telefone_id']);

            $table->foreign('inquilino_id')
                ->references('id')
                ->on('inquilinos')
                ->onUpdate('cascade');
            
            $table->foreign('telefone_id')
                ->references('id')
                ->on('telefones')
                ->onUpdate('cascade');
            
        });

        DB::transaction(function($closure) {
            $inquilinos = Inquilino::with('pessoa');

            foreach($inquilinos as $inquilino){
                if(!$inquilino->has('pessoa')){
                    continue;
                }
                
                $pessoa = $inquilino->getRelation('pessoa');
                
                $inquilino->nome = $pessoa['nome'];
                $inquilino->cpf = $pessoa['cpf'];
                $inquilino->endereco_trabalho = $pessoa['endereco_trabalho'];
                $inquilino->profissao = $pessoa['profissao'];

                $telefones = Telefone::where('pessoa_id', $pessoa['id'])->get();

                $sql = 'INSERT INTO INQUILINOS_TELEFONES(inquilino_id, telefone_id) VALUES(?,?)';
                $inquilino_id = $inquilino['id'];
                foreach ($telefones as $telefone) {
                    $binding = [$inquilino_id, $telefone['id']];
                    DB::insert($sql, $binding);
                }

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


        DB::transaction(function($closure){
            $inquilinos = Inquilino::all();
            foreach($inquilinos as $inquilino){
                Pessoa::create([
                    'nome' => $inquilino->nome,
                    'cpf' => $inquilino->cpf,
                    'endereco_trabalho' => $inquilino->endereco_trabalho,
                    'profissao' => $inquilino->profissao,
                ]);

                $pessoa_id = DB::getPdo()->lastInsertId();

                $telefones = DB::select('select telefone_id from inquilinos_telefones where id = ?', [$inquilino->id]);

                foreach($telefones as $telefone){
                    $telefone_update = Telefone::find($telefone);
                    $telefone_update->pessoa_id = $pessoa_id;
                }
            }
        });

        Schema::table('inquilinos', function(Blueprint $table){
            $table->dropColumn('nome');
        });

        Schema::table('inquilinos', function(Blueprint $table){
            $table->dropColumn('cpf');
        });

        Schema::table('inquilinos', function(Blueprint $table){
            $table->dropForeign('inquilinos_endereco_trabalho_foreign');
        });

        Schema::table('inquilinos', function(Blueprint $table){
            $table->dropColumn('endereco_trabalho');
        });

        Schema::dropIfExists('inquilinos_telefones');
    }
}
