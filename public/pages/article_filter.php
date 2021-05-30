<?php

$CategoryName = '';
if (isset($_GET['cat_name']))
    $CategoryName = $_GET['cat_name'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require $_SERVER['DOCUMENT_ROOT'] . '/php/library/TemplateHandler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/modello.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dBConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'] .  '/php/library/ArticleBuilder.php';

$connessione = DBAccess::openDBConnection();

$handler = new TemplateHandler();
$handler->setPageTitle('Categoria' . $CategoryName);
$handler->setBreadcrumb('Articoli della categoria: ' . $CategoryName)
    ->addLink('/pages/categorie.php', 'Categorie');

$filePath = $_SERVER['DOCUMENT_ROOT'] . '/html/article_filter_nuovo.html';
$handler->setContent(file_get_contents($filePath));

// controllo che la connessione al db sia andata a buon fine, altrimenti stampo un messaggio di errore
if (!$connessione) {
    $handler->setOperationError("Errore nell'apertura del db");
    return;
}

$rawArticles = Articolo::getArticoli($CategoryName, null,1);
$articlesList = '';
if ($rawArticles != null) {
    foreach ($rawArticles as $articolo) {
        $articlesList .= (new ArticleBuilder)
            ->setArticleID($articolo->getId())
            ->setTitle($articolo->getTitle())
            ->setDescription($articolo->getDescription())
            ->setImgArticlePath($articolo->getImgPath())
            ->setImgArticleAlt($articolo->getAltImg())
            ->build(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/php/components/articlePreview.phtml'));
    }
    $handler->setNoOperation();
} else {
    // messaggio che dice che non ci sono articoli del db
    $handler->setOperationError("Nessun articolo trovato per questa categoria");;
}

$handler->setParam("{{categoryName}}", "Categoria: " . $CategoryName);
$handler->setParam("<listaArticoli />", $articlesList);
$handler->render();
