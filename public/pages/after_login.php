<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/LoginHandler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/models/User.php';


$email = $_POST['email'];
$password = $_POST['password'];

$result = LoginHandler::checkLogin($email, $password);

if ($result instanceof User) {
    $_SESSION['authenticated'] = true;
    $_SESSION['user_id'] = $result->getId();
    header('Location: /index.php');
} else {
    $_SESSION['login_error'] = $result;
    header('Location: /after_login.php?error=1');
}



