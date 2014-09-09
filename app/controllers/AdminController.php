<?php

use Bolsa\Correo\AdminMailer;
use Bolsa\Formularios\RegistroAdminForm;
use Laracasts\Validation\FormValidationException;

/**
 * Class AdminController
 */
class AdminController extends \BaseController {

    /**
     * @var Bolsa\Formularios\RegistroAdminForm
     */
    private $adminForm;
    /**
     * @var Bolsa\Correo\AdminMailer
     */
    private $adminMailer;

    /**
     * @param RegistroAdminForm $adminForm
     * @param AdminMailer $adminMailer
     */
    public function __construct(RegistroAdminForm $adminForm, AdminMailer $adminMailer)
    {
        View::share("admin", Auth::getUser());

        View::share("isGeneralAdmin", Auth::getUser()->isGeneralAdmin());

        View::share("admin_activos", (int) User::where("id", "<>", Auth::getUser()->getAuthIdentifier())->where("tipo_usuario", TipoUsuarioModel::ADMIN)->count());

        View::share("admin_desactivados", (int) User::onlyTrashed()->where("id", "<>", Auth::getUser()->getAuthIdentifier())->where("tipo_usuario", TipoUsuarioModel::ADMIN)->count());

        View::share("e_pendientes_c", (int) EmpresaModel::withTrashed()->where("status", EmpresaModel::PENDIENTE)->count());

        View::share("e_activas_c", (int) EmpresaModel::where("status", EmpresaModel::ACTIVA)->count());

        View::share("e_desactivadas_c", (int) EmpresaModel::withTrashed()->where("status", EmpresaModel::DESACTIVADA)->count());

        View::share("a_desactivados_c", (int) AplicanteModel::onlyTrashed()->count());

        View::share("admin_vacantes_c", (int) VacanteModel::count());

        View::share("admin_aplicantes_c", (int) AplicanteModel::count());

        $this->adminForm = $adminForm;

        $this->adminMailer = $adminMailer;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (User::where("tipo_usuario", TipoUsuarioModel::ADMIN_GENERAL)->count("id") == 0)
        {
            $userCollection = User::where("id", "<>", Auth::getUser()->getAuthIdentifier())->where("tipo_usuario", TipoUsuarioModel::ADMIN)->get();

            $data = array("admins" => $userCollection);

            return View::make("inicio.crear_admin", $data);
        }

        $pendientes = EmpresaModel::onlyTrashed()->with(array(
            "reclutador" => function ($query)
                {
                    $query->withTrashed();
                }
        ))->where("status", EmpresaModel::PENDIENTE)->orderBy("updated_at", "desc")->get();

        $data = array("empresas" => $pendientes);

        return View::make("responsive.admin.inicio", $data);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function desactivados()
    {
        $desactivadas = User::onlyTrashed()->where("id", "<>", Auth::getUser()->getAuthIdentifier())->where("tipo_usuario", TipoUsuarioModel::ADMIN)->get();

        $data = array("admins" => $desactivadas);

        return View::make("responsive.admin.desactivados", $data);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activar()
    {
        $id = (int) Input::get("admin_id");

        $admin = User::onlyTrashed()->findOrFail($id);

        $admin->restore();

        // enviar correo de activación
        $this->adminMailer->cuenta_activada($admin->present()->correo);

        Flash::success("Cuenta admin <strong>{$admin->present()->nombre}</strong> ha sido activada");
        return Redirect::back();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception
     */
    public function desactivar()
    {
        $id = (int) Input::get("admin_id");

        /** @var $admin Eloquent */
        $admin = User::withTrashed()->findOrFail($id);

        // soft-delete empresa
        $admin->delete();

        // enviar correo de desactivación
        $this->adminMailer->cuenta_desactivada($admin->present()->correo);

        Flash::success("Cuenta Admin <strong>{$admin->present()->correo}</strong> ha sido desactivada");

        return Redirect::back();
    }

    /**
     * @return \Illuminate\View\View
     */
    public function nuevo()
    {
        $userCollection = User::where("id", "<>", Auth::getUser()->getAuthIdentifier())->where("tipo_usuario", TipoUsuarioModel::ADMIN)->get();

        $data = array("admins" => $userCollection);

        return View::make("responsive.admin.nuevo", $data);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function crear()
    {
        try
        {
            $this->adminForm->validate(Input::all());
        }
        catch (FormValidationException $e)
        {
            Flash::error("Hubo un problema con los datos, corrígelos por favor.");
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        User::create(array(
            "tipo_usuario" => TipoUsuarioModel::ADMIN,
            "email"        => Input::get("email"),
            "password"     => Hash::make(Input::get("password"))
        ));

        Flash::success("Admin Creado.");
        return Redirect::back();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function crearPrincipal()
    {
        try
        {
            $this->adminForm->validate(Input::all());
        }
        catch (FormValidationException $e)
        {
            Flash::error("Hubo un problema con los datos, corrígelos por favor.");
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        User::create(array(
            "tipo_usuario" => TipoUsuarioModel::ADMIN_GENERAL,
            "email"        => Input::get("email"),
            "password"     => Hash::make(Input::get("password"))
        ));

        Auth::logout();

        User::findOrFail(1)->forceDelete();

        Session::flush();

        return Redirect::route("bolsa.inicio")->with("mensaje", "Inicia sesión con el nuevo usuario");
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function hacerPrincipal()
    {
        User::where("id", Input::get("admin_id"))
            ->firstOrFail()
            ->update(array("tipo_usuario" => TipoUsuarioModel::ADMIN_GENERAL));

        Auth::getUser()
            ->update(array("tipo_usuario" => TipoUsuarioModel::ADMIN));

        Flash::warning("Has dejado de ser Admnistrador General.");
        return Redirect::route("admin.inicio");
    }

    /**
     * @return \Illuminate\View\View
     */
    public function vacantes()
    {
        $requests = Request::all();

        $query = VacanteModel::query();

        $data = array(
            "carreras"       => $this->lista_carreras("slug", "Carrera"),
            "tipos"          => array("null" => "Tipo Vacante") + TipoVacanteModel::lists("tipo", "slug"),
            "niveles_ingles" => array("null" => "Nivel Inglés") + NivelInglesModel::lists("nivel", "slug"),
            "request"        => $requests
        );

        // query buscar ("empresa")
        if (! empty($requests['buscar']) && $requests['buscar'] !== "null")
        {
            $query->whereHas("empresa", function ($query) use ($requests)
            {
                $query->where("nombre", "LIKE", "%{$requests['buscar']}%");
            });
        }

        // query carrera
        if (! empty($requests['carrera']) && $requests['carrera'] !== "null")
        {
            $query->whereHas("carrera", function ($query) use ($requests)
            {
                $query->where("slug", $requests['carrera']);
            });
        }

        // query tipo_vacante
        if (! empty($requests['tipo']) && $requests['tipo'] !== "null")
        {
            $query->whereHas("tipo", function ($query) use ($requests)
            {
                $query->where("slug", $requests['tipo']);
            });
        }

        // query ingles
        if (! empty($requests['ingles']) && $requests['ingles'] !== "null")
        {
            $query->whereHas("ingles", function ($query) use ($requests)
            {
                $query->where("slug", $requests['ingles']);
            });
        }

        // with
        $query->with(array("empresa", "carrera", "tipo", "ingles"))->orderBy("updated_at", "desc");

        /** @var $vacantes Illuminate\Pagination\Paginator */
        $vacantes = $query->paginate(6);

        $data = array_add($data, "vacantes", $vacantes);

        $data = array_add($data, "vacantes_c", (int) $vacantes->getTotal());

        return View::make("responsive.admin.vacantes_actuales", $data);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function aplicantes_actuales()
    {
        $requests = Request::all();

        /** @var $query Eloquent */
        $query = AplicanteModel::query();

        $data = array(
            "carreras"      => $this->lista_carreras("slug", "Carrera"),
            "request"       => Request::all(),
            "universidades" => array("null" => "Universidad") + UniversidadModel::lists("nombre", "id"),
        );

        // query carrera
        if (! empty($requests['carrera']) && $requests['carrera'] !== "null")
        {
            $query->whereHas("carrera_relacion", function ($query) use ($requests)
            {
                $query->where("slug", $requests['carrera']);
            });
        }

        // query universidad
        if (! empty($requests['universidad']) && $requests['universidad'] !== "null")
        {
            $query->whereHas("universidad", function ($query) use ($requests)
            {
                $query->where("id", $requests['universidad']);
            });
        }

        $query->with("user", "carrera_relacion", "universidad")->orderBy("created_at", "desc");

        $aplicantes = $query->paginate(6);

        $data = array_add($data, "aplicantes", $aplicantes);

        $data = array_add($data, "aplicantes_actuales_c", (int) $aplicantes->getTotal());

        return View::make("responsive.admin.aplicantes_actuales", $data);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function aplicantes_desactivados()
    {

        $requests = Request::all();

        $aplicanteQuery = AplicanteModel::query();

        $data = array(
            "carreras"      => $this->lista_carreras("slug", "Carrera"),
            "request"       => Request::all(),
            "universidades" => array("null" => "Universidad") + UniversidadModel::lists("nombre", "id"),
        );

        // query carrera
        if (! empty($requests['carrera']) && $requests['carrera'] !== "null")
        {
            $aplicanteQuery->whereHas("carrera_relacion", function ($query) use ($requests)
            {
                $query->where("slug", $requests['carrera']);
            });
        }

        // query universidad
        if (! empty($requests['universidad']) && $requests['universidad'] !== "null")
        {
            $aplicanteQuery->whereHas("universidad", function ($query) use ($requests)
            {
                $query->where("id", $requests['universidad']);
            });
        }

        $aplicanteQuery->onlyTrashed()->with(array(
            "user" => function ($query)
                {
                    $query->withTrashed();
                },
            "carrera_relacion",
            "universidad"
        ))->orderBy("updated_at", "desc");

        $aplicantes = $aplicanteQuery->paginate(6);

        $data = array_add($data, "aplicantes", $aplicantes);

        $data = array_add($data, "aplicantes_actuales_c", (int) $aplicantes->getTotal());

        return View::make("responsive.admin.aplicantes_desactivados", $data);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function empresas_activas()
    {
        $activas = EmpresaModel::with("reclutador")->where("status", EmpresaModel::ACTIVA)->orderBy("updated_at", "desc")->get();

        $data = array("empresas" => $activas);

        return View::make("responsive.admin.empresas_activas", $data);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function empresas_desactivadas()
    {
        $desactivadas = EmpresaModel::onlyTrashed()->with(array(
            "reclutador" => function ($query)
                {
                    $query->withTrashed();
                }
        ))->where("status", EmpresaModel::DESACTIVADA)->orderBy("updated_at", "desc")->get();

        $data = array("empresas" => $desactivadas);

        return View::make("responsive.admin.empresas_desactivadas", $data);
    }

    /**
     * @param $empresa_slug
     * @return \Illuminate\View\View
     */
    public function empresa_info($empresa_slug)
    {
        $info = EmpresaModel::withTrashed()->with(array(
            "reclutador" => function ($query)
                {
                    $query->withTrashed();
                }
        ))->where("slug", $empresa_slug)->firstOrFail();

        $data = array("empresa" => $info);

        return View::make("responsive.admin.empresa", $data);
    }

    /**
     * @param string $clave
     * @param string $textoOpcionNull
     * @return array
     */
    private function lista_carreras($clave = "id", $textoOpcionNull = "- Selecciona -")
    {
        return array("null" => $textoOpcionNull) + CarreraModel::lists("nombre", $clave);
    }
}