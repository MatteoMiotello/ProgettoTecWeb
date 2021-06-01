<?php

require_once(__DIR__ . '/php/library/AbstractBuilder.php');

class CategoryBuilder extends AbstractBuilder {
    CONST CATEGORYNAME = '{{categoryName}}';
    CONST CATEGORYIMG = '{{categoryImg}}';
    CONST CATEGORYDESCRIPTION = '{{categoryDescription}}';
    CONST ISACTIVE = '{{checked}}';

    private $Name;
    private $Description;
    private $ImgCategoryPath;
    private $isActive;

    function __construct() {
        $this->Params[CategoryBuilder::CATEGORYNAME] = 'Nessun nome categoria presente';
        $this->Params[CategoryBuilder::CATEGORYDESCRIPTION] = 'Nessuna descrizione categoria presente';
        $this->Params[CategoryBuilder::ISACTIVE] = "";
        $this->isActive = false;
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

    public function setActive() {
        $this->isActive = true;
        $this->Params[CategoryBuilder::ISACTIVE] = "Checked";
        return $this;
    }

    public function isActive() {
        return $this->isActive;
    }
}
?>