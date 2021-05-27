<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/UserLevelType.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/modello.php';

class User {
    private $Id;


    private $Name;


    private $Surname;


    private $Email;


    private $Password;


    private $Permission;


    private $Img;


    /**
     * User constructor.
     * @param $Id
     * @param string $Name
     * @param $Surname
     * @param $Email
     * @param $Password
     * @param $Permission
     * @param $Img
     */
    public function __construct($ID, $nome, $cognome, $email, $password, $permesso, $img_path)
    {
        if(!CheckValues::checkForCorrectValues($nome, "alpha", 255))
          throw new Exception("Invalid name");
        if(!CheckValues::checkForCorrectValues($cognome, "alpha", 255))
          throw new Exception("Invalid surname");
        if(!CheckValues::checkForCorrectValues($email, "email", 255))
          throw new Exception("Invalid email");
        $this->Id = $ID;
        $this->Name = $nome;
        $this->Surname = $cognome;
        $this->Email = $email;
        $this->Password = $password;
        $this->Permission = $permesso;
        $this->Img = $img_path;
    }


    /**
     * @return User|null|User[]
     */
    public static function getAllUsers(): ?User {
        $access = DBAccess::openDBConnection();

        $querySelect = 'SELECT * FROM utente';

        $queryResult = mysqli_query($access->getConnection(), $querySelect);

        if (mysqli_num_rows($queryResult) == 0) {
            return null;
        } else {
            $userList = [];
            while ($riga = mysqli_fetch_assoc($queryResult)) {
                $user = new User($riga['ID'], $riga['nome'], $riga['cognome'], $riga['email'], $riga['password'], $riga['permesso'], $riga['img_path']);
                array_push($listaCategorie, $user);
            }
        }

        return $userList;
    }


    public static function getArticleAuthor($id_articolo) {
        $connection = DBAccess::openDBConnection();
        $querySelect = "SELECT utente.ID, utente.nome, utente.cognome, utente.email, utente.password, utente.permesso, utente.img_path FROM utente INNER JOIN articolo on (utente.ID = articolo.autore) WHERE articolo.ID = $id_articolo ";
        $queryResult = mysqli_query($connection, $querySelect);
        if (mysqli_num_rows($queryResult) == 0) {
            return null;
        } else {
            $riga = mysqli_fetch_assoc($queryResult);
            $autore = new User($riga['ID'], $riga['nome'], $riga['cognome'], $riga['email'], $riga['password'], $riga['permesso'], $riga['img_path']);
            return $autore;
        }
    }


    public static function getUserById($Id) {
        $Connection = DBAccess::openDBConnection();

        $querySelect = "SELECT * FROM utente WHERE utente.ID = $Id";

        $row = $Connection
            ->query($querySelect)
            ->fetch_assoc();

        if (is_null($row) or empty($row)) {
            return null;
        }

        return (new User($row['ID'], $row['nome'], $row['cognome'], $row['email'], $row['password'], $row['permesso'], $row['img_path']));
    }


    public static function getNumberOfWrittenArticles($Id) {
        $Connection = DBAccess::openDBConnection();

        $querySelect = "SELECT count(*) FROM articolo WHERE autore = $Id";

        $result = mysqli_query($Connection, $querySelect);

        if (!$result) {
            return null;
        }

        if (mysqli_num_rows($result) == 0) {
            return null;
        }

        $row = mysqli_fetch_assoc($result);

        return $row;
    }


    public static function getNumberOfLikesReceived($Id) {
        $Connection = DBAccess::openDBConnection();
        $querySelect = "SELECT SUM(articolo.upvotes) as result from articolo, utente where utente.ID=$Id and utente.ID = articolo.autore";
        $queryResult = mysqli_query($Connection, $querySelect);
        if (mysqli_num_rows($queryResult) == 0)
            return null;
        else {
            return mysqli_fetch_row($queryResult)[0];
        }
    }


    public static function getNumberOfGivenLikes($Id) {
        $Connection = DBAccess::openDBConnection();

        $querySelect = "SELECT SUM(voto.up) from voto where utente=$Id";
        $queryResult = mysqli_query($Connection, $querySelect);

        if (!$queryResult)
            return null;

        if (mysqli_num_rows($queryResult) == 0)
            return null;
        else {
            return mysqli_fetch_assoc($queryResult);
        }
    }


    /**
     * @param $User
     */

    public static function loadNewUser($User) {
        $name = $User->getName();
        $Surname = $User->getSurname();
        $Email = $User->getEmail();
        $pass = $User->getPassword();
        $perm = $User->getPermission();
        $img = $User->getImg();
        $connection = DBAccess::openDBConnection();
        $querySelect = 'insert into utente(nome, cognome, email,password, permesso, img_path) values("' . $name . '","' . $Surname . '", "' . $Email . '", "' . $pass . '", "' . $perm . '", "' . $img . '")';
        $queryResult = mysqli_query($connection, $querySelect);
        if (mysqli_affected_rows($connection) == 0 || !$queryResult) {
            return null;
        } else {
            return true;
        }
    }


    public static function checkVote($id_articolo, $id_utente) {
        $Connection = DBAccess::openDBConnection();
        $querySelect = "SELECT * from voto WHERE utente=$id_utente AND articolo=$id_articolo";
        $queryResult = mysqli_query($Connection, $querySelect);
        if (mysqli_num_rows($queryResult) == 0)
            return null;
        else {
            return true;
        }
    }


    /**
     * @param UserLevelType $levelType
     */
    public static function getUserByAccess(UserLevelType $levelType) {
        //todo
    }


    /**
     * @return mixed
     */
    public function getId() {
        return $this->Id;
    }

    /**
     * @return string
     */
    public function getName() //: string
    {
        return $this->Name;
    }


    /**
     * @param string $Name
     */
    public function setName(string $Name) {
        if (!(strlen($Name) < 30)) {
            throw new Exception('Name is too long');
        }

        $this->Name = $Name;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getSurname() {
        return $this->Surname;
    }


    /**
     * @param mixed $Surname
     */
    public function setSurname($Surname) {
        if (!(strlen($Surname) < 30)) {
            throw new Exception('Surname is too long');
        }

        $this->Surname = $Surname;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getEmail() {
        return $this->Email;
    }


    /**
     * @param $Email
     */
    public function setEmail($Email) {
        if (!(strlen($Email) < 50) or !(strstr($Email, '@'))) {
            throw new Exception('User email is invalid ');
        }

        $this->Email = $Email;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getPassword() {
        return $this->Password;
    }


    /**
     * @param mixed $Password
     */
    public function setPassword($Password) {
        if (!strlen($Password) < 128) {
            throw new Exception('Password is invalid');
        }
        $this->Password = $Password;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getImg() {
        return $this->Img;
    }


    /**
     * @param $Img
     * @return $this
     * @throws Exception
     */
    public function setImg($Img) {
        if (!strlen($Img) < 255) {
            throw new Exception('image path is invalid');
        }

        $this->img = $Img;

        return $this;
    }


    public function isAdmin(): bool {
        if ($this->getPermission() == UserLevelType::ADMINISTRATOR)
            return true;
        else return false;
    }


    /**
     * @return mixed
     */
    public function getPermission() {
        return $this->Permission;
    }


    /**
     * @param mixed $Permission
     */
    public function setPermission($Permission) {
        if (!$Permission == UserLevelType::ADMINISTRATOR or !$Permission == UserLevelType::CUSTOMER) {
            throw new Exception('Permission is not a UserLevelType');
        }

        $this->Permission = $Permission;

        return $this;
    }
}
