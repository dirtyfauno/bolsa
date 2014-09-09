<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CarrerasTableSeeder extends Seeder {

    public function run()
    {
        $carreras = array(
            'Arquitectura',
            'Eléctrica',
            'Eléctrónica',
            'Gestión',
            'Industrial',
            'Logística',
            'Materiales',
            'Mecánica',
            'Mecatrónica',
            'Sistemas'
        );

        foreach ($carreras as $carrera)
        {
            CarreraModel::create(array(
                'nombre' => $carrera,
                'slug'   => Str::slug($carrera)
            ));
        }
    }
}