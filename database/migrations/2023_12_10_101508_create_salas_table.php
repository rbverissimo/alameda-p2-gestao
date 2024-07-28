<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salas', function (Blueprint $table) {
            $table->id();
            $table->integer('imovelcodigo');
            $table->string('nomesala', 100);
            $table->timestamps();

            $table->foreign('imovelcodigo')->references('id')
                ->on('imoveis')
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

        Schema::table('salas', function(Blueprint $table){
            $table->dropForeign('salas_imovelcodigo_foreign');
        });

        Schema::dropIfExists('salas');
    }
}
