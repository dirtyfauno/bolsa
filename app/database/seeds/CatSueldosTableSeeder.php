<?php

class CatSueldosTableSeeder extends Seeder {

  public function run()
  {
    $tipos = array(
      '100% Nómina',
      'Honorarios/Comision',
      'Combinado'
    );

    foreach ($tipos as $tipo)
    {
      TipoSueldoModel::create(array(
        'tipo' => $tipo,
        'slug' => Str::slug($tipo)
      ));
    }
  }
}