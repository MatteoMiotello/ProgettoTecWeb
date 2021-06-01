<?php

require_once __DIR__.'/../php/library/TemplateHandler.php';
require_once __DIR__.'/../php/models/dBConnection.php';

$handler = new TemplateHandler();

$handler->setPageTitle( 'Accedi' );
$handler->setBreadcrumb( 'Accedi' );

$content = file_get_contents(__DIR__.'/../html/login.html' );
$handler->setContent( $content );
$handler->setCurrentRoute("login");
$handler->setKeywords("login, utente");
$handler->setDescription("Questa è la pagina in cui puoi effettuare il login, accedi per scrivere e commentare gli articoli.");
$handler->setAuthors("Andrea, Giosuè, Tommaso, Matteo");

if ( isset( $_GET['error'] ) and $_GET['error'] == 1  ) {
    $handler->setOperationError( 'Email o pasword sbagliati! Riprova!' );
}
else $handler->setNoOperation();

$handler->render();

?>
