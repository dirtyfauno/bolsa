<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class EmpresasTableSeeder extends Seeder {

    public function run()
    {
        If (app('env') === "local" || app('env') === "testing")
        {
            $f = Faker::create();

            User::where('tipo_usuario', TipoUsuarioModel::RECLUTADOR)->get()->each(function (User $recluta) use ($f)
            {
                $empresa = $f->unique()->company();
                $nombre = $f->unique()->name();

                EmpresaModel::create(array(
                    'user_id'           => $recluta->id,
                    "status"            => EmpresaModel::ACTIVA,
                    'nombre'            => $empresa,
                    'reclutador_nombre' => $nombre,
                    'giro'              => $f->word,
                    'rfc'               => $f->randomNumber(8),
                    'telefono'          => $f->phoneNumber,
                    'direccion'         => $f->address,
                    'slug'              => Str::slug($empresa)
                ));
            });
        }
    }
}