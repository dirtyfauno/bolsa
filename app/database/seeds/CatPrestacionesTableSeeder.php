<?php

class CatPrestacionesTableSeeder extends Seeder {

  public function run()
  {
    $tipos = array(
      'Superiores a la Ley',
      'Conforme a la Ley'
    );

    foreach ($tipos as $tipo)
    {
      TipoPrestacionModel::create(array(
        'tipo' => $tipo,
        'slug' => Str::slug($tipo)
      ));
    }
  }
}