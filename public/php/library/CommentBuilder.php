<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php/library/AbstractBuilder.php');

class CommentBuilder extends AbstractBuilder {
    CONST USERNAME = '{{userName}}';
    CONST USERSURNAME = '{{userSurname}}';
    CONST USERCOMMENT = '{{text}}';

    private $Name;
    private $Surname;
    private $Comment;

    function __construct() {
        $this->Params[CommentBuilder::USERNAME] = 'Nessun nome presente';
        $this->Params[CommentBuilder::USERSURNAME] = 'Nessun cognome presente';
        $this->Params[CommentBuilder::USERCOMMENT] = 'Nessun commento presente';
    }

    public function getName() {
        return $this->Name;
    }

    public function setName($Name) {
        $this->Name = $Name;
        $this->Params[CommentBuilder::USERNAME] = $this->getName();
        return $this;
    }

    public function getSurname() {
        return $this->Surname;
    }

    public function setSurname($Surname) {
        $this->Surname = $Surname;
        $this->Params[CommentBuilder::USERSURNAME] = $this->getSurname();
        return $this;
    }

    public function getComment() {
        return $this->Comment;
    }

    public function setComment($Comment) {
        $this->Comment = $Comment;
        $this->Params[CommentBuilder::USERCOMMENT] = $this->getComment();
        return $this;
    }
}
?>