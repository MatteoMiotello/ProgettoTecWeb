<?php

require_once __DIR__ . '/php/library/Access.php';
require_once __DIR__ . '/php/models/dBConnection.php';
if ( Access::create()->logOut() ) {
    header( 'Location: /index.php' );
}