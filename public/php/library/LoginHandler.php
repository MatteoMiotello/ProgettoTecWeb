<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dbConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/models/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/LoginErrorTypeSet.php';

class LoginHandler {
    /**
     * @param $email
     * @param $password
     * @return bool|User
     * @throws \Exception
     */
    public static function checkLogin($email, $password) {
        $connection = DBAccess::openDBConnection();
        $usernameQuery = "SELECT * FROM `utente` WHERE email = '$email'";

        $riga = $connection
            ->query($usernameQuery)
            ->fetch_assoc();
        var_dump($riga);
        if (is_null($riga) or empty( $riga )) {
            return false;
        }

        $user = new User( $riga['ID'], $riga['nome'], $riga['cognome'], $riga['email'], $riga['password'], $riga['permesso'], $riga['img_path'] );
        var_dump($password);
        print($user->getPassword());
        if (!($password == $user->getPassword())) {
            return false;
        }

        return $user;
    }
}
