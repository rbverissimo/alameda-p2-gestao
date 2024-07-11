<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterTipoContaTableAddFlagFatorDivisorColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipocontas', function(Blueprint $table){
            $table->char('isFatorDivisor', 1)->default('S');
        });

        DB::update('UPDATE tipocontas SET isFatorDivisor = ?', ['S']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipocontas', function(Blueprint $table){
            $table->dropColumn('isFatorDivisor');
        });
    }
}
