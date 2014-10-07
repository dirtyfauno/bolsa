<?php

class DatabaseSeeder extends Seeder {

    protected $tables = array(
        "cat_carreras",
        "cat_vacantes",
        "cat_ingles",
        "cat_experiencia",
        "cat_titulado",
        "cat_usuarios",
        "cat_universidades",
        "users",
        "empresas",
        "vacantes",
        "aplicantes",
        "aplicante_vacante",

    );

    protected $seeders = array(
        "CarrerasTableSeeder",
        "TipoVacanteTableSeeder",
        "InglesTableSeeder",
        "CatExperienciaTableSeeder",
        "CatTituladoTableSeeder",
        "CatUsuariosTableSeeder",
        "CatUniversidadesTableSeeder",
        "UsersTableSeeder",
        "EmpresasTableSeeder",
        "VacantesTableSeeder",
        "AplicantesTableSeeder",
        "AplicanteVacanteTableSeeder",
        "ReportesTableSeeder"
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(app('env') !== "production")
        {
            $start_time = microtime(true);

            Eloquent::unguard();

            $this->cleanDB();

            foreach ($this->seeders as $seed)
            {
                $this->call($seed);
            }

            $end_time = microtime(true);

            $time = $end_time - $start_time;

            echo "tiempo: {$time}\n";
        }
        else
        {
            throw new Exception("El sistema esta en PRODUCCION!!");
        }
    }

    private function cleanDB()
    {
        # todo: detectar dinámicamente el tipo de base de datos
        #DB::statement('PRAGMA foreign_keys = OFF'); //sqlite

       DB::statement("SET FOREIGN_KEY_CHECKS = 0;"); // mysql
        foreach ($this->tables as $table)
        {
            DB::table($table)->truncate();
        }

        #DB::statement('PRAGMA foreign_keys = ON');
       DB::statement("SET FOREIGN_KEY_CHECKS = 1;");
    }
}