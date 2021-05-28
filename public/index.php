<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require $_SERVER['DOCUMENT_ROOT'] .  '/php/library/TemplateHandler.php';
require_once $_SERVER['DOCUMENT_ROOT'] .  '/php/modello.php';
require_once $_SERVER['DOCUMENT_ROOT'] .  '/php/dBConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'] .  '/php/library/PreviewArticleBuilder.php';

$connessione = DBAccess::openDBConnection();

/**
 * Si eseguono controlli per verificare che effettivamente l'utente sia loggato e sia un amministratore
 */
// controllo che la connessione al db sia andata a buon fine, altrimenti stampo un messaggio di errore
if (!$connessione) {
    $handler->setOperationError("Errore nell'apertura del db");
    return;
}

$handler = new TemplateHandler();
$handler->setPageTitle('Home');
$filePath = $_SERVER['DOCUMENT_ROOT'] . '/html/index_nuovo.html';

$handler->setBreadcrumb('Home');

if (!file_exists($filePath)) {
    throw new Exception('file non esistente');
}

$handler->setContent(file_get_contents($filePath));
$handler->setCurrentRoute('home');

$rawArticles = Articolo::getArticoli(null, null);
$articlesList = '';
if ($rawArticles != null) {
    foreach ($rawArticles as $articolo) {
        $articlesList .= (new PreviewArticleBuilder)
            ->setID($articolo->getId())
            ->setTitle($articolo->getTitle())
            ->setDescription($articolo->getDescription())
            ->setImgPath($articolo->getImgPath())
            ->setImgAlt($articolo->getAltImg())
            ->build(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/php/components/articlePreview.phtml'));
    }
} else {
    // messaggio che dice che non ci sono articoli del db
    $articlesList = "<div>nessun articolo presente</div>";
}

$covidNews = Articolo::getArticoli('Covid', 5);
$covidNewsList = '';
if ($covidNews != null) {
    foreach ($covidNews as $articolo) {
        $covidNewsList .= (new PreviewArticleBuilder)
            ->setTitle($articolo->getTitle())
            ->setID($articolo->getId())
            ->build(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/php/components/articleNews.phtml'));
    }
} else {
    // messaggio che dice che non ci sono articoli del db
    $covidNewsList = "<div>nessuna news covid presente</div>";
}

$handler->setParam("<listaArticoli />", $articlesList);
$handler->setParam("<news />", $covidNewsList);

$handler->render();
