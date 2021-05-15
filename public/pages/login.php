<?php

require_once '../php/library/TemplateHandler.php';

$handler = new TemplateHandler();

$handler->setPageTitle( 'Login' );
$content = file_get_contents( '../html/login.html' );
$handler->setContent( $content );
$handler->render();
?>