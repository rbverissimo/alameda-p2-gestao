<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterServicosTableAddCodigoNomeColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servicos', function(Blueprint $table){
            $table->string('ud_codigo', 10)->nullable();
            $table->string('ud_nome', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::transaction(function(){
            Schema::table('servicos', function(Blueprint $table){
                $table->dropColumn('ud_codigo');
            });
    
            Schema::table('servicos', function(Blueprint $table){
                $table->dropColumn('ud_nome', 50);
            });
        });
    }
}
