<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAplicantesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplicantes', function (Blueprint $table)
        {
            $table->increments('id');

            $table->tinyInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('nombre', 80);

            $table->tinyInteger("carrera")->unsigned();
            $table->foreign('carrera')->references('id')->on('cat_carreras');

            $table->tinyInteger("universidad_id")->unsigned();
            $table->foreign('universidad_id')->references('id')->on('cat_universidades');

            $table->string("matricula", 30);

            $table->string('cv')->nullable();

            $table->boolean('mailing');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('aplicantes');
    }
}
