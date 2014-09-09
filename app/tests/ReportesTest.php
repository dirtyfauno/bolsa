<?php

use Bolsa\Reportes\ReporteFechas;
use Bolsa\Reportes\ReporteQueries;
use Bolsa\Reportes\ReporteMensual;
use Carbon\Carbon;

/**
 * Class ReportesTest
 */
class ReportesTest extends TestCase {

    /**
     * @var ReporteMensual
     */
    protected $reporteMensual;
    /**
     * @var
     */
    protected $carreras;

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();

        Artisan::call('migrate', array(
            '--path'     => 'app/database/migrations/sqlite',
            '--database' => 'sqlite'
        ));

        Artisan::call('migrate', array(
            '--path'     => 'app/database/migrations/reportes',
            '--database' => 'reportes'
        ));


        Artisan::call('db:seed', array(
            "--database" => "sqlite"
        ));

        DB::beginTransaction();

        // fecha de inicio del mes pasado
        $inicioMes = Carbon::now('America/Mexico_city')->subMonth()->firstOfMonth();

        // fecha del final del mes pasado
        $finMes = Carbon::now('America/Mexico_city')->subMonth()->endOfMonth();

        $this->carreras = CarreraModel::lists('slug', "id");

        $this->reporteMensual = new ReporteMensual(new ReporteFechas($inicioMes, $finMes), new ReporteQueries);

        $this->reporteMensual->setFechas(new ReporteFechas($inicioMes, $finMes));

        $this->reporteMensual->setCarreras(CarreraModel::lists("slug", "id"));
    }

    /**
     *
     */
    public function tearDown()
    {
        DB::rollBack();
    }

    /**
     *
     */
    function test_vacantes_totales_son_la_suma_de_las_vacantes_formales_y_practicantes()
    {

        foreach ($this->carreras as $carrera)
        {
            $totales = $this->reporteMensual->tabla($carrera)->totales();

            $formales = $this->reporteMensual->tabla($carrera)->formal();

            $practicantes = $this->reporteMensual->tabla($carrera)->practicas();

//            echo "\ncarrera: " . $carrera;
//            echo "\ntotal: {$totales}";

            $this->assertEquals($formales + $practicantes, $totales);
        }
    }

    /**
     *
     */
    function test_vacantes_ingles()
    {
        foreach ($this->carreras as $carrera)
        {
            $totales = $this->reporteMensual->tabla($carrera)->ingles_formal();

            $basico = $this->reporteMensual->tabla($carrera)->ingles_basico_formal();

            $intermedio = $this->reporteMensual->tabla($carrera)->ingles_intermedio_formal();

            $avanzado = $this->reporteMensual->tabla($carrera)->ingles_avanzado_formal();

            $suma = $basico + $intermedio + $avanzado;

//            echo "\ncarrera: " . $carrera;
//            echo "\ntotal: {$totales}";

            $this->assertEquals($suma, $totales);
        }

        foreach ($this->carreras as $carrera)
        {
            $totales = $this->reporteMensual->tabla($carrera)->ingles_practicas();

            $basico = $this->reporteMensual->tabla($carrera)->ingles_basico_practicas();

            $intermedio = $this->reporteMensual->tabla($carrera)->ingles_intermedio_practicas();

            $avanzado = $this->reporteMensual->tabla($carrera)->ingles_avanzado_practicas();

            $suma = $basico + $intermedio + $avanzado;

//            echo "\ncarrera: " . $carrera;
//            echo "\ntotal: {$totales}";

            $this->assertEquals($suma, $totales);
        }
    }

    /**
     *
     */
    function test_reportes_parciales_suman_el_total()
    {
        $sumaGlobal = 0;

        foreach ($this->carreras as $carrera)
        {
            $total = $this->reporteMensual->tabla($carrera)->totales();

            $parcial1 = $this->reporteMensual->tabla($carrera)->no_ingles_formal();

            $parcial2 = $this->reporteMensual->tabla($carrera)->no_ingles_practicas();

            $parcial3 = $this->reporteMensual->tabla($carrera)->ingles_formal();

            $parcial4 = $this->reporteMensual->tabla($carrera)->ingles_practicas();

            $suma = $parcial1 + $parcial2 + $parcial3 + $parcial4;

            $sumaGlobal += $total;

//            echo "\ncarrera: " . $carrera;
//            echo "\ntotal: {$total}";

            $this->assertEquals($suma, $total);
        }

        // fecha de inicio del mes pasado
        $inicio = Carbon::now('America/Mexico_city')->subMonth()->firstOfMonth();

        // fecha del final del mes pasado
        $fin = Carbon::now('America/Mexico_city')->subMonth()->endOfMonth();

        $totalGlobal = VacanteModel::withTrashed()->whereBetween('created_at', array(
            $inicio,
            $fin
        ))->count();

//        echo "\nglobal: " . $totalGlobal;
//        echo "\nsuma: " . $sumaGlobal;

        $this->assertEquals($sumaGlobal, $totalGlobal);
    }
}

/**
 * Created by f.
 */