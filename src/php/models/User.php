<?php


class User
{


    private $Id;

    /**
     * @var string
     */
    private $Name;


    private $Surname;


    private $Email;


    private $Password;


    private $Permission;


    private $img;


    /**
     * User constructor.
     * @param $Id
     * @param string $Name
     * @param $Surname
     * @param $Email
     * @param $Password
     * @param $Permission
     * @param $img
     */
    public function __construct($Id, string $Name, $Surname, $Email, $Password, $Permission, $img)
    {
        $this->Id = $Id;
        $this->Name = $Name;
        $this->Surname = $Surname;
        $this->Email = $Email;
        $this->Password = $Password;
        $this->Permission = $Permission;
        $this->img = $img;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->Id;
    }


    /**
     * @param mixed $Id
     */
    public function setId($Id): void
    {
        $this->Id = $Id;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->Name;
    }


    /**
     * @param string $Name
     */
    public function setName(string $Name): void
    {
        $this->Name = $Name;
    }


    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->Surname;
    }


    /**
     * @param mixed $Surname
     */
    public function setSurname($Surname): void
    {
        $this->Surname = $Surname;
    }


    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->Email;
    }


    /**
     * @param mixed $Email
     */
    public function setEmail($Email): void
    {
        $this->Email = $Email;
    }


    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->Password;
    }


    /**
     * @param mixed $Password
     */
    public function setPassword($Password): void
    {
        $this->Password = $Password;
    }


    /**
     * @return mixed
     */
    public function getPermission()
    {
        return $this->Permission;
    }


    /**
     * @param mixed $Permission
     */
    public function setPermission($Permission): void
    {
        $this->Permission = $Permission;
    }


    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }


    /**
     * @param mixed $img
     */
    public function setImg($img): void
    {
        $this->img = $img;
    }


    /**
     * @return User|null|User[]
     */
    public static function getAllUsers(): ?User{

        $access = DBAccess::openDBConnection();

        $querySelect = 'SELECT * FROM utente';

        $queryResult = mysql_query($access->getConnection(), $querySelect);

        if (mysqli_num_rows($queryResult) == 0)
            return null;
        else { // ritorno la lista delle categorie all'interno del db
            $userList = [];
            while ($riga = mysqli_fetch_assoc($queryResult)) {
                $user = new User($riga['ID'], $riga['nome'], $riga['cognome'], $riga['email'], $riga['password'], $riga['permesso'], $riga['img_path']);
                array_push($listaCategorie, $user);
            }
        }

        return $userList;
    }


    public static function getUserById( $id ): User  {



    }


    public static function getUserByAccess( UserLevelType $levelType ){

    }





}