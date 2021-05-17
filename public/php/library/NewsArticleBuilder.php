<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php/library/AbstractBuilder.php');

class NewsArticleBuilder extends AbstractBuilder {

/**
 * Le costanti aiutano a tenere traccia delle label utilizzate per la sostituzione dei parametri
 */
CONST TITOLO = '{{title}}';
CONST ARTICLEID = '{{articleID}}';

private $Title;
private $ID;

function __construct() {
    $this->Params[NewsArticleBuilder::TITOLO] = 'Nessun titolo presente';
}

/**
 * @return string
 */
public function getTitle() {
    return $this->Title;
}

/**
 * @param $Title
 */
public function setTitle($Title){
    $this->Title = $Title;
    $this->Params[NewsArticleBuilder::TITOLO] = $this->getTitle();
    return $this;
}

/**
 * @return int
 */
public function getID() {
    return $this->ID;
}

/**
 * @param $ID
 */
public function setID($ID){
    $this->ID = $ID;
    $this->Params[NewsArticleBuilder::ARTICLEID] = $this->getID();
    return $this;
}
}
