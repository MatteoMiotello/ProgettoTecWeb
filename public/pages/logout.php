<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/Access.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dBConnection.php';
if ( Access::create()->logOut() ) {
    header( 'Location: /index.php' );
}