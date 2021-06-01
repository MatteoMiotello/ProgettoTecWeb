<?php
require_once(__DIR__ . '/php/library/AbstractBuilder.php');

class UserBuilder extends AbstractBuilder {
    /**
     * Le costanti aiutano a tenere traccia delle label utilizzate per la sostituzione dei parametri
     */
    const USERNAME = '{{userName}}';
    const USERSURNAME = '{{userSurname}}';
    const USEREMAIL = '{{userEmail}}';
    const USERIMG = '{{userImg}}';
    const WRITTENARTICLES = '{{numberOfArticles}}';
    const GIVENLIKES = '{{givenLikes}}';
    const RECEIVEDLIKES = '{{receivedLikes}}';
    const USERADMINOPTION = '<userAdminOption />';

    /**
     * @var string
     */
    private $UserName;

    /**
     * @var string
     */
    private $UserSurname;

    /**
     * @var string
     */
    private $UserEmail;

    /**
     * @var string
     */
    private $UserImg;

    /**
     * @var string
     */
    private $WrittenArticles;

    /**
     * @var string
     */
    private $GivenLikes;

    /**
     * @var string
     */
    private $ReceivedLikes;

    public function __construct()
    {
        $this->Params[UserBuilder::USERNAME] = 'Nessun nome presente';
        $this->Params[UserBuilder::USERSURNAME] = 'Nessun cognome presente';
        $this->Params[UserBuilder::USEREMAIL] = 'Nessuna Email presente';
    }

    /** 
     * @return mixed
     */
    public function getUserName() {
        return $this->UserName;
    }


    /**
     * @param $Name
     * @return $this
     */
    public function setUserName($Name) {
        $this->UserName = $Name;
        $this->Params[UserBuilder::USERNAME] = $this->getUserName();
        return $this;
    }


    /**
     * @return mixed
     */
    public function getUserSurname() {
        return $this->UserSurname;
    }


    /**
     * @param $Surname
     * @return $this
     */
    public function setUserSurname($Surname) {
        $this->UserSurname = $Surname;
        $this->Params[UserBuilder::USERSURNAME] = $this->getUserSurname();
        return $this;
    }

    public function getUserEmail() {
        return $this->UserEmail;
    }

    public function setUserEmail($Mail) {
        $this->UserEmail = $Mail;
        $this->Params[UserBuilder::USEREMAIL] = $this->getUserEmail();
        return $this;
    }
    /**
     * @return mixed
     */
    public function getUserImg() {
        return $this->UserImg;
    }


    /**
     * @param $Img
     * @return $this
     */
    public function setUserImg($Img) {
        $this->UserImg = $Img;
        $this->Params[UserBuilder::USERIMG] = $this->getUserImg();
        return $this;
    }


    /**
     * @return mixed
     */
    public function getNumberOfWrittenArticles() {
        return $this->WrittenArticles;
    }


    /**
     * @param $Number
     * @return $this
     */
    public function setNumberOfWrittenArticles($Number) {
        $this->WrittenArticles = $Number;
        $this->Params[UserBuilder::WRITTENARTICLES] = $this->getNumberOfWrittenArticles();
        return $this;
    }


    /**
     * @return mixed
     */
    public function getGivenLikes() {
        return $this->GivenLikes;
    }


    /**
     * @param $Number
     * @return $this
     */
    public function setGivenLikes($Number) {
        if($Number!="")
            $this->GivenLikes = $Number;
        else 
            $this->GivenLikes = '0';
        $this->Params[UserBuilder::GIVENLIKES] = $this->getGivenLikes();
        return $this;
    }


    /**
     * @return mixed
     */
    public function getReceivedLikes() {
        return $this->ReceivedLikes;
    }


    /**
     * @param $Number
     * @return $this
     */
    public function setReceivedLikes($Number) {
        if($Number != "")
            $this->ReceivedLikes = $Number;
        else 
            $this->ReceivedLikes = '0';
        $this->Params[UserBuilder::RECEIVEDLIKES] = $this->getReceivedLikes();
        return $this;
    }

    public function setUserAdminOption($bool) {
        if($bool)
            $this->Params[UserBuilder::USERADMINOPTION] =  file_get_contents(__DIR__.'/php/components/userAdminOption.phtml');
        else 
            $this->Params[UserBuilder::USERADMINOPTION] =  "";
        return $this;
    }
}
