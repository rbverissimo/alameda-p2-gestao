<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprovantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprovantes', function (Blueprint $table) {
            $table->id();
            $table->double('valor');
            $table->string('dataComprovante', 9);
            $table->integer('referencia');
            $table->string('descricao', 300)->nullable();
            $table->integer('inquilino');
            $table->timestamps();

            $table->foreign('inquilino')
                ->references('id')
                ->on('inquilinos')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comprovantes', function(Blueprint $table){
            $table->dropForeign('comprovantes_inquilino_foreign');
        });

        Schema::dropIfExists('comprovantes');
    }
}
