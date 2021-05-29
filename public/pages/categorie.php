<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require $_SERVER['DOCUMENT_ROOT'] . '/php/library/TemplateHandler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/modello.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dBConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'] .  '/php/library/CategoryBuilder.php';

$connessione = DBAccess::openDBConnection();

$handler = new TemplateHandler();
$handler->setPageTitle('Categorie');
$handler->setBreadcrumb('Categorie');

$filePath = $_SERVER['DOCUMENT_ROOT'] . '/html/cat_nuovo.html';

$handler->setContent(file_get_contents($filePath));
$handler->setCurrentRoute('cat');

// controllo che la connessione al db sia andata a buon fine, altrimenti stampo un messaggio di errore
if (!$connessione) {
    $handler->setOperationError("Errore nell'apertura del db");
    return;
}

$categorie = Categoria::getCategorie();
if ($categorie != null) {
    $listaCategoria = '';
    foreach ($categorie as $singolaCategoria) {
        $listaCategoria .= (new CategoryBuilder)
            ->setName($singolaCategoria->getNome())
            ->setDescription($singolaCategoria->getDescrizione())
            ->setImgCategoryPath($singolaCategoria->getImg())
            ->build(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/php/components/categories.phtml'));
    }
    $handler->setNoOperation();
} else {
    $filePath = $_SERVER['DOCUMENT_ROOT'] . '/html/error.html';
    $handler->setContent(file_get_contents($filePath));
    // messaggio che dice che non ci sono categorie del db
    $handler->setOperationError("Nessuna categoria presente");
}
$handler->setParam("<listaCategorie />", $listaCategoria);
$handler->render();
