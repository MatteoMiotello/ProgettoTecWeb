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
        $connection = \DBAccess::openDBConnection();

        $usernameQuery = "SELECT * FROM `utente` WHERE email = '$email'";

        $riga = $connection
            ->query($usernameQuery)
            ->fetch_assoc();

        if (is_null($riga) or empty( $riga )) {
            return false;
        }

        $user = new \User( $riga['ID'], $riga['nome'], $riga['cognome'], $riga['email'], $riga['password'], $riga['permesso'], $riga['img_path'] );

        if ( !password_verify( $user->getPassword(), $password ) ) {
            return false;
        }

        return $user;
    }
}