<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAplicanteVacanteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aplicante_vacante', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('aplicante_id')->unsigned()->index();
			$table->foreign('aplicante_id')->references('id')->on('users')->onDelete('cascade');
			$table->integer('vacante_id')->unsigned()->index();
			$table->foreign('vacante_id')->references('id')->on('vacantes')->onDelete('cascade');
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
		Schema::drop('aplicante_vacante');
	}

}
