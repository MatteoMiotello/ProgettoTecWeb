<?php

require_once '../php/library/TemplateHandler.php';
require_once '../php/dBConnection.php';

$handler = new TemplateHandler();

$handler->setPageTitle( 'Login' );
$handler->setBreadcrumb( 'Login' )
    ->addLink( '/index.php', 'Home' );

$content = file_get_contents( '../html/login.html' );
$handler->setContent( $content );

if ( isset( $_GET['error'] ) and $_GET['error'] == 1  ) {
    $handler->setOperationError( 'Email o pasword sbagliati! Riprova!' );
}

$handler->render();

?>
