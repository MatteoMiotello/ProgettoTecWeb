<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php/library/AbstractBuilder.php');

class CategoryBuilder extends AbstractBuilder {
    CONST CATEGORYNAME = '{{categoryName}}';
    CONST CATEGORYIMG = '{{categoryImg}}';
    CONST CATEGORYDESCRIPTION = '{{categoryDescription}}';

    private $Name;
    private $Description;
    private $ImgCategoryPath;

    function __construct() {
        $this->Params[CategoryBuilder::CATEGORYNAME] = 'Nessun nome categoria presente';
        $this->Params[CategoryBuilder::CATEGORYDESCRIPTION] = 'Nessuna descrizione categoria presente';
    }

    public function getName() {
        return $this->Name;
    }

    public function setName($Name) {
        $this->Name = $Name;
        $this->Params[CategoryBuilder::CATEGORYNAME] = $this->getName();
        return $this;
    }

    public function getDescription() {
        return $this->Description;
    }

    public function setDescription($Description) {
        $this->Description = $Description;
        $this->Params[CategoryBuilder::CATEGORYDESCRIPTION] = $this->getDescription();
        return $this;
    }

    public function getImgCategoryPath() {
        return $this->ImgCategoryPath;
    }

    public function setImgCategoryPath($Img) {
        $this->ImgCategoryPath = $Img;
        $this->Params[CategoryBuilder::CATEGORYIMG] = $this->getImgCategoryPath();
        return $this;
    }
}
?>