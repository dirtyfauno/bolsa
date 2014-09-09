<?php

class VerificarRutas extends TestCase {

    public function setUp()
    {
        parent::setUp();
        $this->t("set-up");
        Artisan::call('migrate', array(
            '--path'     => 'app/database/migrations/sqlite',
            '--database' => 'sqlite'
        ));
        $this->t("migracion");
        Artisan::call('db:seed');
        $this->t("seed");
        DB::beginTransaction();
        $this->t("transac");
    }

    function test_bolsa_carrera()
    {
        $this->route('get', 'bolsa.inicio');
        $this->assertResponseOk();

        $this->route('get', 'bolsa.carrera', array('sistemas'));
        $this->assertResponseOk();
    }

    public function tearDown()
    {
        DB::rollBack();
        $this->t("rollback");
    }

    private function t($string)
    {
        echo "\n" . get_class($this) . " @{$string}\n";
    }
}

/**
 * Created by f.
 */