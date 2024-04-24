<?php

use App\Models\Acesso;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterUsersAddAcessoFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table){
            $table->unsignedBigInteger('id_acesso')->default(1); 
            $table->foreign('id_acesso')->references('id')->on('acessos');
        });

        $id_admin = Acesso::where('titulo', 'admin')->first();
        $id_tester = Acesso::where('titulo', 'tester')->first();

        DB::update("UPDATE users SET id_acesso = ? WHERE name in('Renato', 'Marivalda')", [$id_admin->id]);

        DB::update("UPDATE users SET id_acesso = ? WHERE name in('testes')", [$id_tester->id]);

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropForeign('users_id_acesso_foreign');
            $table->dropColumn('id_acesso');
        });
    }
}
