<?php

class CatUniversidadesTableSeeder extends Seeder {

    public function run()
    {
        $universidades = array(
            "Universidad Politécnica de Querétaro (UPQ)",
            "Universidad Tecnológica de Querétaro (UTEQ)",
            "Instituto Tecnológico de Querétaro (ITQ)",
            "Instituto Tecnológico de San Juan del Río",
            "Universidad Tecnológica de San Juan del Río (UTSJR)",
            "Universidad Autónoma de Querétaro (UAQ)",
            "Centro Educativo Grupo CEDVA",
            "Tecnológico de Monterrey (ITESM)",
            "Universidad Anáhuac Querétaro ",
            "Universidad Contemporánea de Querétaro",
            "Universidad Cuauhtémoc",
            "Universidad de Londres",
            "Universidad del Valle de Atemajac (UNIVA)",
            "Universidad del Valle de México (UVM)",
            "Universidad Interamericana del Norte (UIN)",
            "Universidad Interglobal",
            "Universidad TecMilenio",
            "Universidad UNIVER",
            "Universidad Azteca de San Juan del Río",
            "_Otra"
        );
        foreach ($universidades as $u)
        {
            UniversidadModel::create(array(
                'nombre' => $u,
                'slug'   => Str::slug($u)
            ));
        }
    }
}