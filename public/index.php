<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ .  '/php/library/TemplateHandler.php';
require_once __DIR__ .  '/php/models/Articolo.php';
require_once __DIR__ .  '/php/models/dBConnection.php';
require_once __DIR__ .  '/php/library/ArticleBuilder.php';

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
$filePath = __DIR__ . '/../html/index_nuovo.html';

$handler->setKeywords("home, articoli, news, aggiornamenti, notizie");
$handler->setDescription("Scorri la nostra home e rimani aggiornato sulle ultime notizie in Italia e nel mondo intero.");
$handler->setAuthors("Andrea, Giosuè, Tommaso, Matteo");

$handler->setBreadcrumb('Home');

if (!file_exists($filePath)) {
    throw new Exception('file non esistente');
}

$handler->setContent(file_get_contents($filePath));
$handler->setCurrentRoute('home');

$rawArticles = Articolo::getArticoli(null, null, 1);
$articlesList = '';
if ($rawArticles != null) {
    foreach ($rawArticles as $articolo) {
            $articlesList .= (new ArticleBuilder)
                ->setArticleID($articolo->getId())
                ->setTitle($articolo->getTitle())
                ->setDescription($articolo->getDescription())
                ->setImgArticlePath($articolo->getImgPath())
                ->setImgArticleAlt($articolo->getAltImg())
                ->build(file_get_contents(__DIR__ . '/php/components/articlePreview.phtml'));
    }
} else {
    // messaggio che dice che non ci sono articoli del db
    $articlesList = "<div>nessun articolo presente</div>";
}

$covidNews = Articolo::getArticoli('Covid', 5, 1);
$covidNewsList = '';
if ($covidNews != null) {
    foreach ($covidNews as $articolo) {
            $covidNewsList .= (new ArticleBuilder)
                ->setTitle($articolo->getTitle())
                ->setArticleID($articolo->getId())
                ->build(file_get_contents(__DIR__ . '/php/components/articleNews.phtml'));
    }
} else {
    // messaggio che dice che non ci sono articoli del db
    $covidNewsList = "<div>nessuna news covid presente</div>";
}

// controllo se e' appena stato effettuato il login, nel caso printo un messaggio di avvenuto login
if(isset($_GET['login']))
    $handler->setOperationDone("Login avvenuto con successo, commenta, lascia un like oppure scrivi un articolo!");
else
    $handler->setNoOperation();

$handler->setParam("<listaArticoli />", $articlesList);
$handler->setParam("<news />", $covidNewsList);

$handler->render();
