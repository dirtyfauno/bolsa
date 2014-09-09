<?php

// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

class TipoVacanteTableSeeder extends Seeder {

  public function run()
  {

    $tipos = array(
      'Formal',
      'Practicante'
    );

    foreach ($tipos as $tipo)
    {
      TipoVacanteModel::create(array(
        'tipo' => $tipo,
        'slug' => Str::slug($tipo)
      ));
    }
  }
}