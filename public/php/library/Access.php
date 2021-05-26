<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/php/models/User.php';

class Access {
    /**
     * @var User $User
     */
    private $User;


    /**
     * Access constructor.
     * @param null|User $User
     */
    public function __construct(User $User = null) {
        $this->User = $User;
    }


    public function logOut(): bool {
        if (!session_destroy()) {
            throw new \Exception('non è stato possibile eliminare la sessione corrente');
        } else {
            return true;
        }
    }


    /**
     * crea un nuovo Access prendendo l'id dell'utente dalla sessione
     * @return Access|null
     */
    public static function create(): ?Access {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['user_id'])) {
            return new static();
        }

        $user = User::getUserById($_SESSION['user_id']);

        return new static($user);
    }


    /**
     * @return User|null
     */
    public static function getUser(): User {
        $User = User::getUserById($_SESSION['user_id']);
        return $User;
    }


    /**
     * Indica se un utente é loggato in sessione
     *
     * @return bool
     */
    public static function isAuthenticated(): bool {
        if ( !isset( $_SESSION['authenticated'] ) or !$_SESSION['authenticated']) {
            return false;
        }

        return true;
    }


    /**
     * Indica se l'utente loggato in sessione é un admin
     *
     * @return bool
     */
    public function isAdministrator(): bool {
        if ($this->User->getPermission() == UserLevelType::ADMINISTRATOR) {
            return true;
        }

        return false;
    }


    /**
     * Indica se l'utente loggato in sessione é un utente finale
     *
     * @return bool
     */
    public function isEndUser(): bool {
        if ($this->User->getPermission() == UserLevelType::CONSUMER) {
            return true;
        }

        return false;
    }

    public function logIn( User $user ) {
        $_SESSION[ 'authenticated' ] = true;
        $_SESSION[ 'user_id' ] = $user->getId();
    }
}