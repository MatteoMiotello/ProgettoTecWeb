<?php
class LoginHandler {
    /**
     * @param $email
     * @param $password
     * @return bool|string
     * @throws \Exception
     */
    public static function checkLogin($email, $password) {
        $connection = \DBAccess::openDBConnection();

        $usernameQuery = "SELECT * FROM `utente` WHERE email = '$email'";

        $result = $connection
            ->query($usernameQuery)
            ->fetch_assoc();

        if (is_null($result) or empty( $result )) {
            return 'Username non trovato';
        }

        $user = ( new \User( ) )
            ->setName( $result['name'] )
            ->setEmail( $result['email'] )
            ->setPassword( $result['password'] );

        if ( !password_verify( $user->getPassword(), $password ) ) {
            return 'Password non valida';
        }

        return true;
    }
}