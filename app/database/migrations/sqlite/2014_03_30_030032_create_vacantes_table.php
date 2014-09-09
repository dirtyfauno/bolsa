<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVacantesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacantes', function (Blueprint $table)
        {
            $table->increments('id');

            $table->string('string_id')->unique();

            $table->tinyInteger('status')->default(VacanteModel::ACTIVA)->unsigned();

            $table->tinyInteger('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas');

            $table->string('correo');

            $table->tinyInteger('carrera_id')->unsigned();
            $table->foreign('carrera_id')->references('id')->on('cat_carreras');

            $table->boolean("mailed")->default(false);

            $table->string("puesto", 50);

            $table->tinyInteger('titulado_id')->unsigned();
            $table->foreign('titulado_id')->references('id')->on('cat_titulado');

            $table->tinyInteger('experiencia_id')->unsigned();
            $table->foreign('experiencia_id')->references('id')->on('cat_experiencia');

            $table->tinyInteger('tipo_id')->unsigned();
            $table->foreign('tipo_id')->references('id')->on('cat_vacantes');

            $table->string('area', 50);

            $table->string('software', 50);

            $table->integer('oferta')->unsigned();

            $table->tinyInteger('ingles_id')->unsigned();
            $table->foreign('ingles_id')->references('id')->on('cat_ingles');

            $table->boolean("rotar")->default(false);
            $table->boolean("viajar")->default(false);
            $table->boolean("prima")->default(false);
            $table->boolean("vales")->default(false);
            $table->boolean("transporte")->default(false);
            $table->boolean("residencia")->default(false);
            $table->boolean("aguinaldo")->default(false);
            $table->boolean("comision")->default(false);
            $table->boolean("seguro")->default(false);
            $table->boolean("comedor")->default(false);
            $table->boolean("viaticos")->default(false);
            $table->boolean("gasolina")->default(false);
            $table->boolean("honorarios")->default(false);

            $table->string('titulo', 50);

            $table->text('contenido');

            //            $table->string('keyword1', 20);

            //            $table->string('keyword2', 20);

            //            $table->tinyInteger('tipo_sueldo')->unsigned();
            //            $table->foreign('tipo_sueldo')->references('id')->on('cat_sueldos');

            //            $table->tinyInteger('tipo_prestacion')->unsigned();
            //            $table->foreign('tipo_prestacion')->references('id')->on('cat_prestaciones');

            //            $table->tinyInteger('tipo_estancia')->unsigned();
            //            $table->foreign('tipo_estancia')->references('id')->on('cat_estancias');

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
        Schema::drop('vacantes');
    }
}
