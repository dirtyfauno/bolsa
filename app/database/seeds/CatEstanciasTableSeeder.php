<?php

class CatEstanciasTableSeeder extends Seeder {

  public function run()
  {
    $tipos = array(
      'Trabajo Local',
      'Trabajo Remoto',
      'Trabajo Foráneo'
    );

    foreach ($tipos as $tipo)
    {
      TipoEstanciaModel::create(array(
        'tipo' => $tipo,
        'slug' => Str::slug($tipo)
      ));
    }
  }
}