<?php

$CategoryName = '';
if (isset($_GET['cat_name']))
    $CategoryName = $_GET['cat_name'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/../php/library/TemplateHandler.php';
require_once __DIR__ .  '/../php/models/Articolo.php';
require_once __DIR__ . '/../php/models/dBConnection.php';
require_once __DIR__ .  '/../php/library/ArticleBuilder.php';

$connessione = DBAccess::openDBConnection();

$handler = new TemplateHandler();
$handler->setPageTitle('Categoria' . $CategoryName);
$handler->setBreadcrumb('Articoli della categoria: ' . $CategoryName)
    ->addLink('/apolato/pages/categorie.php', 'Categorie');

$filePath = __DIR__ . '/../html/article_filter_nuovo.html';
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
            ->build(file_get_contents(__DIR__ . '/../php/components/articlePreview.phtml'));
    }
    $handler->setNoOperation();
} else {
    // messaggio che dice che non ci sono articoli del db
    $handler->setOperationError("Nessun articolo trovato per questa categoria");;
}

$handler->setParam("{{categoryName}}", "Categoria: " . $CategoryName);
$handler->setParam("<listaArticoli />", $articlesList);
$handler->render();
