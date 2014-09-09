<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table)
        {
            $table->increments('id');

            $table->tinyInteger('tipo_usuario')->unsigned();

            $table->string('username', 20)->unique()->nullable();

            $table->string('email')->unique();

            $table->string('password', 60);

            $table->string('remember_token')->nullable();

            $table->softDeletes();

            $table->timestamps();

            $table->foreign('tipo_usuario')->references('id')->on('cat_usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
