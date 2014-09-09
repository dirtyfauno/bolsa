<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmpresasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->tinyInteger("status")->default(EmpresaModel::PENDIENTE)->unsigned();
            $table->string('nombre', 40);
            $table->string('reclutador_nombre', 80);
            $table->string('logo')->nullable();
            $table->string('giro', 40);
            $table->string('rfc', 50);
            $table->string('telefono', 40);
            $table->string('direccion');
            $table->string('slug', 50)->unique();
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
        Schema::drop('empresas');
    }
}
