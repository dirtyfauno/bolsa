<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeneralTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('general', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('mes')->unsigned();
			$table->integer('year')->unsigned();

			$table->integer('total')->unsigned();
			$table->integer('total_oferta')->unsigned();
			$table->integer('formal_total')->unsigned();
			$table->integer('formal_oferta')->unsigned();
			$table->integer('practicas_total')->unsigned();
			$table->integer('practicas_oferta')->unsigned();

			$table->integer('no_ingles_formal_total')->unsigned();
			$table->integer('no_ingles_formal_oferta')->unsigned();
			$table->integer('no_ingles_practicas_total')->unsigned();
			$table->integer('no_ingles_practicas_oferta')->unsigned();

			$table->integer('ingles_formal_total')->unsigned();
			$table->integer('ingles_formal_oferta')->unsigned();
			$table->integer('ingles_formal_basico_total')->unsigned();
			$table->integer('ingles_formal_basico_oferta')->unsigned();
			$table->integer('ingles_formal_intermedio_total')->unsigned();
			$table->integer('ingles_formal_intermedio_oferta')->unsigned();
			$table->integer('ingles_formal_avanzado_total')->unsigned();
			$table->integer('ingles_formal_avanzado_oferta')->unsigned();

			$table->integer('ingles_practicas_total')->unsigned();
			$table->integer('ingles_practicas_oferta')->unsigned();
			$table->integer('ingles_practicas_basico_total')->unsigned();
			$table->integer('ingles_practicas_basico_oferta')->unsigned();
			$table->integer('ingles_practicas_intermedio_total')->unsigned();
			$table->integer('ingles_practicas_intermedio_oferta')->unsigned();
			$table->integer('ingles_practicas_avanzado_total')->unsigned();
			$table->integer('ingles_practicas_avanzado_oferta')->unsigned();

			$table->text('programas');

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
		Schema::drop('general');
	}

}
