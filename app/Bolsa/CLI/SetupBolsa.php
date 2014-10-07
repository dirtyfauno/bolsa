<?php namespace Bolsa\CLI;

use Artisan;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class SetupBolsa
 * @package Bolsa\CLI
 */
class SetupBolsa extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'bolsa:setup';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Setup inicial para el sistema. Sólo se necesita ejecutar UNA vez.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}


	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $bolsaEnv = \App::environment();

        if($bolsaEnv !== "production")
        {
            $env_file_path = base_path() . "/.env.{$bolsaEnv}.php";

            if(\File::exists($env_file_path))
            {
                $this->info("env file ya existe");
            }
            else
            {
                $this->comment("creando env file");

                file_put_contents($env_file_path, null);
            }
        }
        else
        {
            $env_file_path = base_path() . "/.env.php";

            if(\File::exists($env_file_path))
            {
                $this->info("env file ya existe");
            }
            else
            {
                $this->comment("creando env file");

                file_put_contents($env_file_path, null);
            }
        }


        if(app('config')['zackkitzmiller/tiny::key'] === "Generar : \$php artisan tiny:generate")
        {
            $this->comment("creando clave para vacantes");

            // establecer clave para las vacantes
            Artisan::call("tiny:generate");
        }
        else
        {
            $this->info("ya existe la key para las vacantes");
        }

	$this->comment("migrando bd production");
	
	Artisan::call("migrate", array(
                "--database" => "sqlite",
                "--path" => "app/database/migrations/sqlite"));
               
        // $db_path = app_path() . "/database/";

        // if(\File::exists($db_path . "production.sqlite"))
        // {
        //     $this->info("ya existe la bases de datos \"production\"");
        // }
        // else
        // {
        //     $this->comment("creando bd production");

        //     // crear bases de datos sqlite
        //     file_put_contents($db_path . "production.sqlite", null);

        //     Artisan::call("migrate", array(
        //         "--database" => "sqlite",
        //         "--path" => "app/database/migrations/sqlite"));

        // }

	$this->comment("creando bd reportes");
                
        Artisan::call("migrate", array(
                "--database" => "reportes",
                "--path" => "app/database/migrations/reportes"));
                
        // if(\File::exists($db_path . "reportes.sqlite"))
        // {
        //     $this->info("ya existe las bases de datos \"reportes\"");
        // }
        // else
        // {
        //     $this->comment("creando bd reportes");

        //     // crear bases de datos sqlite
        //     file_put_contents($db_path . "reportes.sqlite", null);

        //     // migrar bases de datos
        //     Artisan::call("migrate", array(
        //         "--database" => "reportes",
        //         "--path" => "app/database/migrations/reportes"));
        // }

		$this->info("setup exitoso.");
	}

}
