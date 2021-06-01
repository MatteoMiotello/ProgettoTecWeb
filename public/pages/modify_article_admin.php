<?php

$id_articolo = null;

if (isset($_GET['art_id']))
    $id_articolo = $_GET['art_id'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/../php/library/TemplateHandler.php';
require_once __DIR__ .  '/../php/models/Articolo.php';
require_once __DIR__ .  '/../php/models/Categoria.php';
require_once __DIR__ . '/../php/models/dBConnection.php';
require_once __DIR__ . '/../php/library/CategoryBuilder.php';
require_once __DIR__ . '/../php/library/ArticleBuilder.php';

$connessione = DBAccess::openDBConnection();

$handler = new TemplateHandler();
$handler->setPageTitle('Form Articolo');
$handler->setBreadcrumb('Scrivi un articolo');


/**
 * Si eseguono controlli per verificare che effettivamente l'utente sia loggato e sia un amministratore
 */
// controllo che la connessione al db sia andata a buon fine, altrimenti stampo un messaggio di errore
if (!$connessione) {
    $handler->setOperationError("Errore nell'apertura del db");
    return;
}

$filePath = __DIR__ . '/../html/error.html';
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

$articolo = Articolo::getArticolo($id_articolo);

if (!$articolo) {
    $handler->setOperationError("Articolo non presente");
    $handler->render();
    return;
} else $handler->setNoOperation();

$filePath = __DIR__ . '/../html/form_articolo_admin_modifica.html';
$handler->setContent(file_get_contents($filePath));
$handler->setParam('{{ id_articolo }}', $articolo->getID());

$autore = User::getArticleAuthor($articolo->getID());
$categorieArticolo = Categoria::getCategorieArticolo($articolo->getID());
$categorie = Categoria::getCategorie();
$articleContent = (new ArticleBuilder)
    ->setTitle($articolo->getTitle())
    ->setDescription($articolo->getDescription())
    ->setContent($articolo->getContent())
    ->build(file_get_contents(__DIR__ . '/../php/components/formArticleContent.phtml'));
if ($categorie) {
    $listaCategoria = '';
    foreach ($categorie as $singolaCategoria) {
        $value = (new CategoryBuilder)
            ->setName($singolaCategoria->getNome());

        if ($categorieArticolo) {
            foreach ($categorieArticolo as $cat) {
                if ($singolaCategoria->getNome() == $cat->getNome())
                    $value->setActive();
            }
        }

        $listaCategoria .= $value->build(file_get_contents(__DIR__ . '/../php/components/chooseCategoryFormArticle.phtml'));
    }
} else {
    // messaggio che dice che non ci sono categorie del db
    $listaCategoria = "<div>nessuna categoria presente</div>";
}

$handler->setParam("<formArticleContent />", $articleContent);
$handler->setParam("<listaCategorie />", $listaCategoria);
$handler->render();
