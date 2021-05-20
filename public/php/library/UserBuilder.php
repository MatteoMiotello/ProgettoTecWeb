<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/php/library/AbstractBuilder.php');

class UserBuilder extends AbstractBuilder {
    /**
     * Le costanti aiutano a tenere traccia delle label utilizzate per la sostituzione dei parametri
     */
    CONST USERNAME = '{{userName}}';
    CONST USERSURNAME = '{{userSurname}}';
    CONST USEREMAIL = '{{userEmail}}';
    CONST USERIMG = '{{userImg}}';
    CONST WRITTENARTICLES = '{{numberOfArticles}}';
    CONST GIVENLIKES = '{{givenLikes}}';
    CONST RECEIVEDLIKES = '{{receivedLikes}}';

    private $UserName;
    private $UserSurname;
    private $UserEmail;
    private $UserImg;
    private $WrittenArticles;
    private $GivenLikes;
    private $ReceivedLikes;

    public function getUserName() {
        return $this->UserName;
    }

    public function setUserName($Name) {
        $this->UserName = $Name;
        $this->Params[UserBuilder::USERNAME] = $this->getUserName();
        return $this;
    }

    public function getUserSurname() {
        return $this->UserSurname;
    }

    public function setUserSurname($Surname) {
        $this->UserSurname = $Surname;
        $this->Params[UserBuilder::USERSURNAME] = $this->getUserSurname();
        return $this;
    }

    public function getUserImg() {
        return $this->UserImg;
    }

    public function setUserImg($Img) {
        $this->UserImg = $Img;
        $this->Params[UserBuilder::USERIMG] = $this->getUserImg();
        return $this;
    }

    public function getNumberOfWrittenArticles() {
        return $this->WrittenArticles;
    }

    public function setNumberOfWrittenArticles($Number) {
        $this->WrittenArticles = $Number;
        $this->Params[UserBuilder::WRITTENARTICLES] = $this->getNumberOfWrittenArticles();
        return $this;
    }

    public function getGivenLikes() {
        return $this->GivenLikes;
    }
    public function setGivenLikes($Number) {
        $this->GivenLikes = $Number;
        $this->Params[UserBuilder::GIVENLIKES] = $this->getGivenLikes();
        return $this;
    }

    public function getReceivedLikes() {
        return $this->GivenLikes;
    }
    public function setReceivedLikes($Number) {
        $this->ReceivedLikes = $Number;
        $this->Params[UserBuilder::RECEIVEDLIKES] = $this->getReceivedLikes();
        return $this;
    }
}
