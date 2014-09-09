<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AplicantesTableSeeder extends Seeder {

    public function run()
    {
        If (app('env') === "local" || app('env') === "testing")
        {
            $f = Faker::create();

            $usuarios = User::where('tipo_usuario', TipoUsuarioModel::APLICANTE)->lists('id');

            $carreras = CarreraModel::lists('id');

            $universidades = UniversidadModel::lists("id");

            foreach ($usuarios as $id)
            {
                AplicanteModel::create(array(
                    "user_id"        => $id,
                    "nombre"         => $f->name,
                    "carrera"        => $f->randomElement($carreras),
                    "universidad_id" => $f->randomElement($universidades),
                    "matricula"      => $f->randomNumber(8),
                    "mailing"        => $f->randomElement(array(true, true, true, false))
                ));
            }
        }
    }
}