<?php

require_once '../php/library/TemplateHandler.php';

$handler = new TemplateHandler();

$handler->setPageTitle( 'Login' );
$handler->setBreadcrumb( 'Login' )
    ->addLink( '/index.php', 'Home' );

$content = file_get_contents( '../html/login.html' );
$handler->setContent( $content )
    ->setJsFooter( "console.log('ciao') " );

if ( isset( $_GET['error'] ) and $_GET['error'] == 1  ) {
    $handler->setOperationError( 'Email o pasword sbagliati' );
}

$handler->render();

?>
