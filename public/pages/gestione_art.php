<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/php/library/TemplateHandler.php';
require_once __DIR__ .  '/php/models/Articolo.php';
require_once __DIR__ . '/php/models/dBConnection.php';
require_once __DIR__ .  '/php/library/ArticleBuilder.php';

$connessione = DBAccess::openDBConnection();

$handler = new TemplateHandler();
$handler->setPageTitle('Gestione Articoli');
$handler->setBreadcrumb('Gestione Articoli')
        ->addLink('/pages/user.php', 'Il mio profilo');

/**
 * Si eseguono controlli per verificare che effettivamente l'utente sia loggato e sia un amministratore
 */
// controllo che la connessione al db sia andata a buon fine, altrimenti stampo un messaggio di errore
if (!$connessione) {
    $handler->setOperationError("Errore nell'apertura del db");
    return;
}

$filePath = __DIR__ . '/html/error.html';
$handler->setContent(file_get_contents($filePath));

if (!Access::isAuthenticated()) {
    $handler->setOperationError("Non sei loggato, esegui il login!");
    $handler->render();
    return;
}
$user = Access::create();
if (!($user->isAdministrator())) {
    $handler->setOperationError("Non sei un amministratore! Non puoi accedere a questa sezione!");
    $handler->render();
    return;
}

$filePath = __DIR__ . '/html/article_filter_nuovo.html';
$handler->setContent(file_get_contents($filePath));
$handler->setNoOperation();

if (isset($_GET['success'])) {
    if($_GET['success'] == 'true')
        $handler->setOperationDone('Salvataggio avvenuto con successo');
    else
        $handler->setOperationDone('Il Salvataggio non è andato a buon fine, riprova!');
}

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
}
$rawArticles = Articolo::getArticoli(null, null, null);
if ($rawArticles != null) {
    foreach ($rawArticles as $articolo) {
        $articlesList .= (new ArticleBuilder)
            ->setValidationOption($articolo->getValidation())
            ->setArticleID($articolo->getId())
            ->setTitle($articolo->getTitle())
            ->build(file_get_contents(__DIR__ . '/php/components/articleManager.phtml'));
    }
} else {
    // messaggio che dice che non ci sono articoli del db
    $articlesList = "<div>nessun articolo presente</div>";
}
$handler->setParam("<listaArticoli />", $articlesList);
$handler->setParam("{{categoryName}}", "Articoli");
$handler->render();
