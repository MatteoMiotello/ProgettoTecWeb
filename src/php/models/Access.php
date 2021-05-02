<?php

namespace models;

use User;

class Access
{
    /**
     * @var User $User
     */
    private $User;

    /**
     * Access constructor.
     * @param $User
     */
    public function __construct($User, $Password=null)
    {
        $this->User = $User;

    }


    private function storeInSession(){
        session_start();

        $_SESSION[ 'user_id' ]= $this->User->getId();

        return $this;
    }


    public function logIn( User $user ){
        $this->User = $user;


    }


    public function logOut(): bool{
        if ( !session_destroy() ){
            throw new \Exception( 'non è stato possibile eliminare la sessione corrente' );
        } else {
            return true;
        }
    }


    public static function getSession(){
        session_start();

        return new Access( $_SESSION['user_id'] );
    }


    public function getSessionUser() {
        $this->User = User::getUserById( $_SESSION[ 'user_id' ] );
        return $this->User;
    }
}