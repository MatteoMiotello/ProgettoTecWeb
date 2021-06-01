<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../php/library/LoginHandler.php';
require_once __DIR__ . '/../php/models/User.php';
require_once __DIR__ . '/../php/library/Access.php';

if(!Access::isAuthenticated()){
  $email = CheckValues::sanitize($_POST['email']);
  $password = md5(CheckValues::sanitize($_POST['password']));
  $result = LoginHandler::checkLogin($email, $password);
  if ($result) {
      Access::create()->logIn( $result );
      header('Location: /apolato/index.php?login=1');
  } else {
      $_SESSION['login_error'] = $result;
      header('Location: /pages/login.php?error=1');
  }
}
else{
  header('Location: /apolato/index.php');
}
