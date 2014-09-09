<?php
$I = new AcceptanceTester($scenario);

$I->wantTo('crear reporte mensual');

$I->runShellCommand("php artisan bolsa:actualizar-reporte");

$I->seeInShellOutput("Reporte Actualizado");
