<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/php/library/AbstractBuilder.php');

class PreviewArticleBuilder extends AbstractBuilder {
    /**
     * Le costanti aiutano a tenere traccia delle label utilizzate per la sostituzione dei parametri
     */
    CONST TITOLO = '{{title}}';
    CONST DESCRIPTION = '{{description}}';
    CONST IMGALT = '{{altImg}}';
    CONST IMGPATH = '{{imgPath}}';
    CONST ID = '{{articleID}}';
    /**
     * Titolo dell'articolo
     * @var string
     */
    private $Title = 'Nessun titolo impostato';

    /**
     * Descrizione dell'articolo
     * @var string
     */
    private $Description = 'Nessuna descrizione impostata';

    /**
     * ID dell'articolo
     * @var string
     */
    private $ID = null;

    /**
     * Path dell'immagine usata per l'articolo
     * @var string 
     */
    private $imgPath;

    /**
     * Alt usato per l'immagine dell'articolo
     * @var string 
     */
    private $imgAlt;

    /**
     * @return mixed
     */
    public function getTitle() {
        return $this->Title;
    }
    /**
     * @param mixed $Title
     */
    public function setTitle($Title): self {
        $this->Title = $Title;
        $this->Params[PreviewArticleBuilder::TITOLO] = $this->getTitle();
        return $this;
    }

    /**
     * @return mixed 
     */
    public function getDescription() {
        return $this->Description;
    }

    /**
     * @param mixed $Description
     */
    public function setDescription($Description){
        $this->Description = $Description;
        $this->Params[PreviewArticleBuilder::DESCRIPTION] = $this->getDescription();
        return $this;
    }

    /**
     * @return mixed 
     */
    public function getID() {
        return $this->ID;
    }

    /**
     * @param mixed ID
     */
    public function setID($ID) {
        $this->ID = $ID;
        $this->Params[PreviewArticleBuilder::ID] = $this->getID();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImgPath() {
        return $this->imgPath;
    }

    /**
     * @param $imgPath
     */
    public function setImgPath($imgPath) {
        $this->imgPath = $imgPath;
        $this->Params[PreviewArticleBuilder::IMGPATH] = $this->getImgPath();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImgAlt() {
        return $this->imgAlt;
    }

    /**
     * @param $imgAlt
     */
    public function setImgAlt($imgAlt) {
        $this->imgAlt = $imgAlt;
        $this->Params[PreviewArticleBuilder::IMGALT] = $this->getImgAlt();
        return $this;
    }
}
