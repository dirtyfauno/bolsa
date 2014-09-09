<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AplicanteVacanteTableSeeder extends Seeder {

    public function run()
    {
        If (app('env') === "local" || app('env') === "testing")
        {
            $faker = Faker::create();

            $aplicantes = AplicanteModel::lists('id');

            $vacantes = VacanteModel::lists('id');

            # aps = aplicaciones
            if(app("env") === "testing")
            {
                $apsMax = 40;
            }
            else
            {
                $apsMax = 1000;
            }

            for ($aps = 0; $aps < $apsMax; $aps ++)
            {
                $aplicanteRandom = $faker->randomElement($aplicantes);

                $vacante = $faker->randomElement($vacantes);

                /** @var $aplicante AplicanteModel */
                $aplicante = AplicanteModel::with("aplicaciones")->findOrFail($aplicanteRandom);

                if (! $aplicante->aplicaciones->contains($vacante))
                {
                    $aplicante->aplicaciones()->attach($vacante);
                }
                else
                {
                    $aps --;
                }
            }
        }
    }
}