<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class InglesTableSeeder extends Seeder {

  public function run()
  {
    $faker = Faker::create();

    $niveles = array(
      'No Requerido',
      'Básico',
      'Intermedio',
      'Avanzado'
    );

    $descripcion = array(
      $faker->unique()->sentence(),
      $faker->unique()->sentence(),
      $faker->unique()->sentence(),
      $faker->unique()->sentence()
    );

    foreach (range(0, count($niveles) - 1) as $index)
    {
      NivelInglesModel::create(array(
        'nivel'       => $niveles[$index],
        'slug'        => Str::slug($niveles[$index]),
        'descripcion' => $descripcion[$index]
      ));
    }
  }
}