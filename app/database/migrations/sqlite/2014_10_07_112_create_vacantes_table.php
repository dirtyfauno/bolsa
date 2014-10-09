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

            $table->integer('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas');

            $table->string('correo');

            $table->integer('carrera_id')->unsigned();
            $table->foreign('carrera_id')->references('id')->on('cat_carreras');

            $table->boolean("mailed")->default(false);

            $table->string("puesto", 50);

            $table->integer('titulado_id')->unsigned();
            $table->foreign('titulado_id')->references('id')->on('cat_titulado');

            $table->integer('experiencia_id')->unsigned();
            $table->foreign('experiencia_id')->references('id')->on('cat_experiencia');

            $table->integer('tipo_id')->unsigned();
            $table->foreign('tipo_id')->references('id')->on('cat_vacantes');

            $table->string('area', 50);

            $table->string('software', 50);

            $table->integer('oferta')->unsigned();

            $table->integer('ingles_id')->unsigned();
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

            $table->softDeletes();

            $table->timestamps();
        });

        DB::statement("ALTER TABLE `vacantes` CHANGE `string_id` `string_id` VARCHAR(255)  CHARACTER SET utf8  COLLATE utf8_bin  NOT NULL  DEFAULT '';");
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
