<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/LoginHandler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/models/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/Access.php';

if(!Access::isAuthenticated()){
  $email = CheckValues::sanitize($_POST['email']);
  $password = md5(CheckValues::sanitize($_POST['password']));
  var_dump( $email );
  $result = LoginHandler::checkLogin($email, $password);
  var_dump($result);
  if ($result) {
      Access::create()->logIn( $result );
      header('Location: /index.php');
  } else {
      $_SESSION['login_error'] = $result;
      header('Location: /pages/login.php?error=1');
  }
}
else{
  header('Location: /index.php');
}
