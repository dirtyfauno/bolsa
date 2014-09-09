<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CatTituladoTableSeeder extends Seeder {

    public function run()
    {
        $titulado = array(
            "Sí",
            "No",
            "Indistinto"
        );

        foreach ($titulado as $index)
        {
            TituladoModel::create(array(
                "nombre" => $index,
                "slug"   => Str::slug($index)
            ));
        }
    }
}