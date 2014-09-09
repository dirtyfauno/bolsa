<?php namespace Bolsa\CLI;

use AplicanteModel;
use CarreraModel;
use Config;
use Exception;
use Indatus\Dispatcher\Drivers\Cron\Scheduler;
use Indatus\Dispatcher\Scheduling\Schedulable;
use Indatus\Dispatcher\Scheduling\ScheduledCommand;
use Log;
use Mandrill;
use Mandrill_Error;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use TipoUsuarioModel;
use User;
use VacanteModel;
use View;

/**
 * Class NotificarVacantes
 * @package Bolsa\CLI
 */
class NotificarVacantes extends ScheduledCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'bolsa:notificar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'enviar correo con las nuevas vacantes a los aplicantes resgistrados';

    /**
     * @var string
     */
    protected $carreraNombre;

    /**
     * @var
     */
    protected $minimoVacantes;

    /**
     * @var int
     */
    protected $aplicantesNotificados = 0;

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
        $this->minimoVacantes =  Config::get('bolsa.notificador.vacantes');

        /** @var $adminGeneral User */
        $adminGeneral = User::where("tipo_usuario", TipoUsuarioModel::ADMIN_GENERAL)->firstOrFail();

        $this->notificar($adminGeneral->present()->correo);

        $this->info("notificaciones enviadas");
    }

    /**
     * @param $carrera_id
     * @param $vacantes
     *
     * @param $fromEmail
     * @throws Exception
     * @return int
     */
    private function notificarAplicantes($carrera_id, $vacantes, $fromEmail)
    {
        $aplicantesCollection = $this->obtenerAplicantes($carrera_id);

        if($aplicantesCollection->isEmpty())
        {
            Log::alert("ningún aplicante");
            return 0;
        }

        // se van a procesar existan o no aplicantes
        $aplicantesArray = $this->crear_arreglo_de_aplicantes($aplicantesCollection);

        $lotes = $this->crear_lotes_de_correos($aplicantesArray);

        $html = $this->obtener_vista_html($vacantes, $carrera_id);

        foreach ($lotes as $lote)
        {
            try
            {
                $this->enviar_lote_de_correos($html, $lote, $fromEmail);
            }
            catch (Mandrill_Error $e)
            {
                Log::error($e->getMessage());
                throw new Exception("No se ha ingresado la clave para enviar los correo, revisar \".env.php\"");
            }

        }

        Log::debug("bolsa:notificar - {$this->carreraNombre} - notificados: {$aplicantesCollection->count()}");

        return $aplicantesCollection->count();
    }

    /**
     * @param $html
     * @param $lote
     * @param $fromEmail
     */
    private function enviar_lote_de_correos($html, $lote, $fromEmail)
    {
        $m = new Mandrill($_ENV["MANDRILL_KEY"]);


        $mensaje = array(
            "html"                => $html,
            "subject"             => "Bolsa de Trabajo, nuevas vacantes" . " [{$this->carreraNombre}]",
            "from_email"          => $fromEmail,
            "from_name"           => Config::get("mail.from.name"),
            "to"                  => $lote,
            "preserve_recipients" => false
        );

        $m->messages->send($mensaje, true);
    }

    /**
     * @param $vacantes
     * @param $carrera_id
     *
     * @return string
     */
    private function obtener_vista_html($vacantes, $carrera_id)
    {
        $data = array(
            "vacantes" => $vacantes,
            "carrera"  => CarreraModel::find($carrera_id)
        );

        $html = View::make("correo.notificar.nuevas_vacantes", $data)->render();

        return $html;
    }

    /**
     * @param array $aplicantes_arr
     *
     * @return array
     */
    private function crear_lotes_de_correos(array $aplicantes_arr)
    {
        // aqui sólo creamos arreglos de 1000 aplicantes
        $lotes_emails = array_chunk($aplicantes_arr, 1000);
        return $lotes_emails;
    }

    /**
     * @param array $aplicantes
     *
     * @return array
     * @throws \Exception
     */
    private function crear_arreglo_de_aplicantes($aplicantes)
    {
        // https://mandrillapp.com/api/docs/messages.php.html
        $aplicantes_arr = array();

        /** @var \AplicanteModel $aplicante */
        foreach ($aplicantes as $aplicante)
        {
            $aplicantes_arr[] = array(
                "email" => $aplicante->present()->correo,
                "name"  => $aplicante->present()->nombreCompleto,
                "type"  => "to"
            );
        }

        if (empty($aplicantes_arr))
        {
            Log::error("no hay aplicantes - {$this->carreraNombre}");
        }

        return $aplicantes_arr;
    }

    /**
     * @param $vacantes
     *
     * @return bool
     */
    private function existenVacantesSuficientes($vacantes)
    {
        /** @var \Illuminate\Support\Collection $vacantes */
        if ($vacantes->count() >= $this->minimoVacantes)
        {
            return true;
        }
        else
        {
            \Log::debug("bolsa:notificar - jobs: {$vacantes->count()}");
            return false;
        }
    }

    /**
     * @param $carrera_id
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function obtenerAplicantes($carrera_id)
    {
        $aplicantes = AplicanteModel::with("user")->where("carrera", $carrera_id)->where("mailing", true)->get();
        return $aplicantes;
    }

    /**
     * @param $vacantesCollection
     */
    private function actualizarVacantes($vacantesCollection)
    {
        /** @var \Eloquent $vacante */
        foreach ($vacantesCollection as $vacante)
        {
            $vacante->update(array("mailed" => true));
        }
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     * @throws \Exception
     */
    private function obtenerVacantes($id)
    {
        $vacantesCollection = VacanteModel::where("mailed", false)->where("carrera_id", $id)->get();

        /** @var CarreraModel $carrera */
        $carrera = CarreraModel::findOrFail($id);

        if (is_null($carrera->nombre))
        {
            throw new Exception("la columna nombre no existe en el catálogo de carreras");
        }

        $this->carreraNombre = $carrera->nombre;

        return $vacantesCollection;
    }

    /**
     *
     */
    private function notificar($correo)
    {
        $start_time = microtime(true);

        Log::debug("\n#####################################\n" . "#       BEGIN bolsa:notificar, mínimo de vacantes: {$this->minimoVacantes}       #\n" . "#####################################\n");

        foreach (CarreraModel::lists('id') as $carrera)
        {
            $vacantesCollection = $this->obtenerVacantes($carrera);

            if ($this->existenVacantesSuficientes($vacantesCollection))
            {
                $this->aplicantesNotificados += $this->notificarAplicantes($carrera, $vacantesCollection, $correo);

                $this->actualizarVacantes($vacantesCollection);
            }
            else
            {
                Log::debug("bolsa:notificar - {$this->carreraNombre} - vacantes insuficientes.");
            }
        }

        $end_time = microtime(true);

        $time = $end_time - $start_time;

        \Log::debug("\n#####################################\n" . "#       END bolsa:notificar         #\n" . "#       correos enviados: {$this->aplicantesNotificados}         #\n" . "#       time: {$time} seg    #\n" . "#####################################\n");
    }

    /**
     * When a command should run
     *
     * @param Scheduler|Schedulable $scheduler
     *
     * @return \Indatus\Dispatcher\Scheduling\Schedulable|\Indatus\Dispatcher\Scheduling\Schedulable[]
     */
    public function schedule(Schedulable $scheduler)
    {
        return $scheduler->everyWeekday()->hours(12)->minutes(0);
    }
}
