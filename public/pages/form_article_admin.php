<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require $_SERVER['DOCUMENT_ROOT'] . '/php/library/TemplateHandler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/modello.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dBConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'] .  '/php/library/CategoryBuilder.php';
require_once $_SERVER['DOCUMENT_ROOT'] .  '/php/library/ArticleBuilder.php';

$connessione = DBAccess::openDBConnection();

$handler = new TemplateHandler();
$handler->setPageTitle('Form Articolo');
$handler->setBreadcrumb('Scrivi un articolo');

$filePath = $_SERVER['DOCUMENT_ROOT'] . '/html/error.html';

$handler->setContent(file_get_contents($filePath));
$handler->setCurrentRoute('form_articolo');

// controllo che la connessione al db sia andata a buon fine, altrimenti stampo un messaggio di errore
if (!$connessione) {
    $handler->setOperationError("Errore nell'apertura del db");
    return;
} 

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

$filePath = $_SERVER['DOCUMENT_ROOT'] . '/html/form_articolo_admin_nuovo.html';

$handler->setContent(file_get_contents($filePath));
$handler->setCurrentRoute('form_articolo');
$handler->setNoOperation();

$categorie = Categoria::getCategorie();
if ($categorie != null) {
    $listaCategoria = '';
    foreach ($categorie as $singolaCategoria) {
        $listaCategoria .= (new CategoryBuilder)
            ->setName($singolaCategoria->getNome())
            ->build(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/php/components/chooseCategoryFormArticle.phtml'));
    }
} else {
    // messaggio che dice che non ci sono categorie del db
    $listaCategoria = "<div>nessuna categoria presente</div>";
}

$articleContent = (new ArticleBuilder)->build(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/php/components/formArticleContent.phtml'));
$handler->setParam("<formArticleContent />", $articleContent);

$handler->setParam("<listaCategorie />", $listaCategoria);
$handler->render();
