<?php


class ReportesTableSeeder extends Seeder
{

    public function run()
    {
        # todo: detectar dinámicamente el tipo de base de datos
        // DB::statement('PRAGMA foreign_keys = OFF'); //sqlite
               DB::statement("SET FOREIGN_KEY_CHECKS=0"); // mysql

        foreach ($this->tablas() as $tabla)
        {
            DB::connection("reportes")->table($tabla)->truncate();
        }

        DB::connection("reportes")->table("general")->truncate();

        // DB::statement('PRAGMA foreign_keys = ON');
               DB::statement("SET FOREIGN_KEY_CHECKS=1");

        If (app('env') === "local" || app('env') === "testing")
        {
            Artisan::call("bolsa:actualizar-reporte", array(
                "--meses" => 12
            ));
        }
    }

    /**
     * @return array
     */
    public function tablas()
    {
        return CarreraModel::lists("slug");
    }

}