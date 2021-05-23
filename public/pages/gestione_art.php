<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require $_SERVER['DOCUMENT_ROOT'] . '/php/library/TemplateHandler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/modello.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dBConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'] .  '/php/library/PreviewArticleBuilder.php';

$dbAccess = new DBAccess();
$connessioneRiuscita = DBAccess::openDBConnection();
$connessioneRiuscita = $connessioneRiuscita->getConnection();

$handler = new TemplateHandler();
$handler->setPageTitle('Gestione Articoli');

$filePath = $_SERVER['DOCUMENT_ROOT'] . '/html/article_filter_nuovo.html';

$handler->setContent(file_get_contents($filePath));

if ($connessioneRiuscita == null)
    die("Errore nell'apertura del db"); // non si prosegue all'esecuzione della pagina
else {
    $articlesList = '';
    /**
     * controllo se viene passato un id tramite URL, in tal caso valido l'articolo con quell'Id
     */
    $id_art = null;
    if (isset($_GET['art_id'])) {
        $id_art = $_GET['art_id'];
        $result = Articolo::validateArticle($id_art, $connessioneRiuscita);
        if ($result)
            $articlesList .= '<article class="articolo_validato"><p>Articolo con id=' . $id_art . ' è stato validato con successo </p></article>';
        else
            $articlesList .= '<article class="articolo_validato"><p>Articolo con id=' . $id_art . ' è stato validato con successo </p></articl>';
    }
    $rawArticles = Articolo::getArticoli(null, $connessioneRiuscita, null);
    if ($rawArticles != null) {
        foreach ($rawArticles as $articolo) {
            $articlesList .= (new PreviewArticleBuilder)
                ->setValidationOption($articolo->getValidation())
                ->setID($articolo->getId())
                ->setTitle($articolo->getTitle())
                ->build(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/php/components/articleManager.phtml'));
        }
    } else {
        // messaggio che dice che non ci sono articoli del db
        $articlesList = "<div>nessun articolo presente</div>";
    }
}
$handler->setParam("<listaArticoli />", $articlesList);
$handler->setParam("{{categoryName}}", "Articoli");
$handler->render();
