<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/LoginHandler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/models/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/Access.php';


$email = $_POST['email'];
$password = $_POST['password'];
var_dump( $email );
$result = LoginHandler::checkLogin($email, $password);

if ($result instanceof User) {
    Access::create()->logIn( $result );
    header('Location: /index.php');
} else {
    $_SESSION['login_error'] = $result;
    header('Location: /pages/login.php?error=1');
}



