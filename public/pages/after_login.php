<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/LoginHandler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/models/User.php';

$email = $_POST['email_addr'];
$password = $_POST['pw'];
var_dump( $email );
var_dump( $password );
$result = LoginHandler::checkLogin( $email, $password );

if ( $result instanceof User ) {
    $_SESSION['authenticated'] = true;
    $_SESSION['user_id'] = $result->getId();
    header( 'Location: /index.php' );
} else {
    $_SESSION[ 'login_error' ] = $result;
    header( 'Location: /pages/login.php' );
}


