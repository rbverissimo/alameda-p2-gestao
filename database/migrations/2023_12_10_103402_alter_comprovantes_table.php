<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;

class AlterComprovantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comprovantes', function(Blueprint $table){
            $table->integer('tipocomprovante')->nullable();

            $table->foreign('tipocomprovante')
                ->references('id')
                ->on('tipos_comprovantes')
                ->onUpdate('cascade')
                ->onDelete('set null');
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
            
            $table->dropForeign('comprovanteS_tipocomprovante_foreign');
            $table->dropColumn('tipocomprovante');
            
        });
    }
}
