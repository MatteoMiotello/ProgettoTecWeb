<?php

require_once '../php/library/TemplateHandler.php';
require_once '../php/dBConnection.php';

$handler = new TemplateHandler();

$handler->setPageTitle( 'Login' );
$handler->setBreadcrumb( 'Login' )
    ->addLink( '/index.php', 'Home' );

$content = file_get_contents( '../html/login.html' );
$handler->setContent( $content );

$handler->setKeywords("login, utente");
$handler->setDescription("Questa è la pagina in cui puoi effettuare il login, accedi per scrivere e commentare gli articoli.");
$handler->setAuthors("Andrea, Giosuè, Tommaso, Matteo");

if ( isset( $_GET['error'] ) and $_GET['error'] == 1  ) {
    $handler->setOperationError( 'Email o pasword sbagliati! Riprova!' );
}
else $handler->setNoOperation();

$handler->render();

?>
