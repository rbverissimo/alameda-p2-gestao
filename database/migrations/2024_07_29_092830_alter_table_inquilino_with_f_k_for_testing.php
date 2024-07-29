<?php

use App\Models\Inquilino;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterTableInquilinoWithFKForTesting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        DB::transaction(function($closure){

            Schema::rename('inquilinos', 'inquilinos_temp');

            Schema::create('inquilinos', function (Blueprint $table){
                $table->char('situacao', 1)->default('A');
                $table->unsignedBigInteger('salacodigo');
                $table->integer('qtdePessoasFamilia')->nullable();
                $table->timestamps();
                $table->string('nome', 60);
                $table->string('cpf', 11)->nullable();
                $table->unsignedBigInteger('endereco_trabalho')->nullable();
                $table->string('profissao', 60)->nullable();

                $table->foreign('endereco_trabalho')
                    ->references('id')
                    ->on('enderecos')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
                
            });

            $inquilinos = DB::select('select * from inquilinos_temp');

            $sql = 'INSERT INTO INQUILINOS(SITUACAO, SALACODIGO, QTDEPESSOASFAMILIA, CREATED_AT, UPDATED_AT, NOME, CPF, ENDERECO_TRABALHO, PROFISSAO) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)';
            foreach ($inquilinos as $inquilino) {
                
                $binding = [$inquilino->situacao, $inquilino->salacodigo, $inquilino->qtdePessoasFamilia, $inquilino->created_at, $inquilino->updated_at, $inquilino->nome, $inquilino->cpf,$inquilino->endereco_trabalho, $inquilino->profissao];
                DB::insert($sql, $binding);
                
            }

            Schema::dropIfExists('inquilinos_temp');
        
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
