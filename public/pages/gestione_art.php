<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require $_SERVER['DOCUMENT_ROOT'] . '/php/library/TemplateHandler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/modello.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dBConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'] .  '/php/library/PreviewArticleBuilder.php';

$connessioneRiuscita = DBAccess::openDBConnection();

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
        //controllo se l'operazione da eseguire e' un'eliminazione
        if (isset($_GET['del'])) {
            $result = Articolo::deleteArticle($_GET['art_id']);
            if ($result)
                $handler->setOperationDone('Articolo con id=' . $_GET['art_id'] . ' è stato eliminato con successo');
            else
                $handler->setOperationError('L\'articolo con id=' . $_GET['art_id'] . ' selezionato per l\'eliminazione non è presente');
        } else {
            $result = Articolo::validateArticle($_GET['art_id']);
            if ($result)
                $handler->setOperationDone('Articolo con id=' . $_GET['art_id'] . ' è stato validato con successo');
            else
                $handler->setOperationError('L\'articolo selezionato non è presente');
        }
    } else $handler->setNoOperation();
    $rawArticles = Articolo::getArticoli(null, null);
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
