<?php
require_once ( './php/TemplateHandler.php' );

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

( new TemplateHandler() )
    ->setPageTitle( 'Prov' )
    ->setParam( 'ciao', 'ciao' )
    ->render();