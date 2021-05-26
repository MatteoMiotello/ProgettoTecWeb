<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/Access.php';

if ( Access::create()->logOut() ) {
    header( 'Location: /index.php' );
}