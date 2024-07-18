<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterServicosAddSalaColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servicos', function(Blueprint $table){
            $table->unsignedBigInteger('salacodigo')->nullable();
            $table->unsignedBigInteger('tipo_servico')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servicos', function(Blueprint $table){
            $table->dropColumn('salacodigo');
        });
    }
}
