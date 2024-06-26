<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
            'name' => 'Renato',
            'email' => 'renatobarbosaverissimo@gmail.com',
            'password' => 'Guitarra12@'
        ]);

        User::create([
            'name' => 'Marivalda',
            'email' => 'm_bverissimo@yahoo.com.br',
            'password' => 'marivalda$acesso@90'
        ]);
        
        User::create([
            'name' => 'testes',
            'email' => 'hotstreetbrasil@gmail',
            'password' => 'te$t3R@101'
        ]);
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
