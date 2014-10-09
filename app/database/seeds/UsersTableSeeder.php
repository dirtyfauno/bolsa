<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        $this->crearAdmin();

        If (app('env') === "local" || app('env') === "testing")
        {
            $this->crearReclutadores();

            $this->crearAplicantes();
        }
    }

    private function crearAdmin()
    {
        # admins
        User::create(array(
            'tipo_usuario' => TipoUsuarioModel::ADMIN,
            'email'        => "admin@bolsa.com",
            'password'     => Hash::make('01234567'),
        ));
    }

    /**
     * @return void
     */
    private function crearReclutadores()
    {
        # reclutadores (empresas)
        foreach (range(10, 8) as $index)
        {
            User::create(array(
                'tipo_usuario' => TipoUsuarioModel::RECLUTADOR,
                'email'        => "{$index}@reclutador.com",
                'password'     => Hash::make('01234567'),
            ));
        }
    }

    private function crearAplicantes()
    {
        # aplicantes
        foreach (range(100, 130) as $index)
        {
            User::create(array(
                'tipo_usuario' => TipoUsuarioModel::APLICANTE,
                'email'        => "{$index}@aplicante.com",
                'password'     => Hash::make('01234567'),
            ));
        }
    }
}