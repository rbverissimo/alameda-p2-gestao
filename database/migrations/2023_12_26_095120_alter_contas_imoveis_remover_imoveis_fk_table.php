<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterContasImoveisRemoverImoveisFkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contas_imoveis', function(Blueprint $table){
            $table->unsignedBigInteger('imovelcodigo')->nullable()->change();
            $table->unsignedBigInteger('salacodigo')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contas_imoveis', function(Blueprint $table){
            $table->unsignedBigInteger('imovelcodigo');
            $table->unsignedBigInteger('salacodigo');
        });
    }
}
