<?php
$I = new AcceptanceTester($scenario);

$I->wantTo('enviar correo con las nuevas vacantes a los aplicantes resgistrados');

$I->runShellCommand("php artisan bolsa:notificar");

$I->seeInShellOutput("notificaciones enviadas");
