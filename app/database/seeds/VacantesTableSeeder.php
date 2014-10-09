<?php

use Carbon\Carbon;
use Faker\Factory as Faker;

class VacantesTableSeeder extends Seeder {

    public function run()
    {
        If (app('env') === "local" || app('env') === "testing")
        {
            $fakeFactory = Faker::create();

            $this->crear_vacantes($fakeFactory);

//            $this->simular_actualizacion_de_algunas_vacantes($fakeFactory);

//            $this->desactivar_algunas_empresas();
        }
    }

    private function desactivar_algunas_empresas()
    {
        EmpresaModel::with("vacantes")->where("status", "<>", EmpresaModel::ACTIVA)->get()->each(function (EmpresaModel $e)
        {
            $e->delete(); //soft-delete
            $e->vacantes()->delete();
        });
    }

    /**
     * @param $f
     */
    private function simular_actualizacion_de_algunas_vacantes($f)
    {
        $inicio = Carbon::now('America/Mexico_city')->subMonths(1)->firstOfMonth();

        $fin = Carbon::now('America/Mexico_city')->endOfMonth();

        VacanteModel::whereBetween('created_at', array(
            $inicio,
            $fin
        ))->get()->each(function (VacanteModel $v) use ($f)
                    {
                        $v->mailed = false;
                        $v->updated_at = $f->dateTimeBetween("-1 month", 'now');
                        $v->save();
                    });
    }

    /**
     * @param $faker
     */
    private function crear_vacantes($faker)
    {
        if (App::environment() === "testing")
        {
            $max_vacantes = 20;
            $meses_anteriores = '-1 month';
        }
        else
        {
            $max_vacantes = 1000;
            $meses_anteriores = '-5 month';
        }

        foreach (range(1, $max_vacantes) as $index)
        {
//            $id = $index + (int) Config::get('bolsa.ofuscator.offset');

            $fecha_de_creacion = $faker->dateTimeBetween($meses_anteriores, 'now');

            VacanteModel::create(array(
                'string_id'      => Tiny::to($index),
                'empresa_id'     => $faker->randomElement(EmpresaModel::lists('id')),
                'correo'         => $faker->companyEmail,
                'carrera_id'     => $faker->randomElement(CarreraModel::lists('id')),
                "mailed"         => true,
                "puesto"         => $faker->catchPhrase,
                "titulado_id"    => $faker->randomElement(TituladoModel::lists("id")),
                "experiencia_id" => $faker->randomElement(ExperienciaModel::lists("id")),
                'tipo_id'        => $faker->randomElement(TipoVacanteModel::lists('id')),
                'area'           => $faker->sentence(2),
                'software'       => "{$faker->word}, {$faker->word}, {$faker->word}",
                'oferta'         => $faker->numberBetween(8000, 60000),
                'ingles_id'      => $faker->randomElement(NivelInglesModel::lists('id')),
                'titulo'         => $faker->sentence(4),
                'contenido'      => $faker->text(800),
                "rotar"          => $faker->boolean(),
                "viajar"         => $faker->boolean(),
                "prima"          => $faker->boolean(),
                "vales"          => $faker->boolean(),
                "transporte"     => $faker->boolean(),
                "residencia"     => $faker->boolean(),
                "aguinaldo"      => $faker->boolean(),
                "comision"       => $faker->boolean(),
                "seguro"         => $faker->boolean(),
                "comedor"        => $faker->boolean(),
                "viaticos"       => $faker->boolean(),
                "gasolina"       => $faker->boolean(),
                "honorarios"     => $faker->boolean(),
                'created_at'     => $fecha_de_creacion,
                'updated_at'     => $fecha_de_creacion
            ));
        }
    }
}