<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterTiposContasAddSistema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipocontas', function(Blueprint $table){
            $table->char('sistema', 1)->default('N');
        });


        DB::update("UPDATE tipocontas SET sistema = 'S'");
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salas', function(Blueprint $table){
            $table->dropColumn('sistema');
        });
    }
}
