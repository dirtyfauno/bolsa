<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CatExperienciaTableSeeder extends Seeder {

    public function run()
    {
        $exp = array(
            "6 Meses - 1 Año",
            "1 - 3 Años",
            "Más de 3 Años",
            "No Requerida",
        );

        foreach ($exp as $index)
        {
            ExperienciaModel::create(array(
                "nombre" => $index,
                "slug"   => Str::slug($index)
            ));
        }
    }
}