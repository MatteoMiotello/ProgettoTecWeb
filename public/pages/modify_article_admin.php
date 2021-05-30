<?php

$id_articolo = null;

if (isset($_GET['art_id']))
    $id_articolo = $_GET['art_id'];

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


/**
 * Si eseguono controlli per verificare che effettivamente l'utente sia loggato e sia un amministratore
 */
// controllo che la connessione al db sia andata a buon fine, altrimenti stampo un messaggio di errore
if (!$connessione) {
    $handler->setOperationError("Errore nell'apertura del db");
    return;
}

$filePath = $_SERVER['DOCUMENT_ROOT'] . '/html/error.html';
$handler->setContent(file_get_contents($filePath));

if(!Access::isAuthenticated()) {
    $handler->setOperationError("Non sei loggato, esegui il login!");
    $handler->render();
    return;
}
$user = Access::create();
if(!($user->isAdministrator())) {
    $handler->setOperationError("Non sei un amministratore! Non puoi accedere a questa sezione!");
    $handler->render();
    return;
}

$articolo = Articolo::getArticolo($id_articolo);

if(!$articolo) {
    $handler->setOperationError("Articolo non presente");
    $handler->render();
    return;
}
else $handler->setNoOperation();

$filePath = $_SERVER['DOCUMENT_ROOT'] . '/html/form_articolo_admin_nuovo.html';
$handler->setContent(file_get_contents($filePath));


/**
 * controllo se la form e' gia' stata compilata, in tal caso emetto un messaggio di avvenuta operazione con relativo esito
 */
if (isset($_POST['titolo_art']) && isset($_POST['descr_art']) && isset($_POST['testo_art']) && isset($_POST['img']) && isset($_POST['alt']) && $author) {
    try {
        // provo a caricare l'articolo nel db
        $articleId = Articolo::getMaxId()+1;
        $authorId = $author->getId();
        $newArticle = new Articolo($articleId, $_POST['titolo_art'], $_POST['descr_art'], $_POST['testo_art'], $authorId, date('Y-m-d G:i:s'), '0', '0', $_POST['img'],$_POST['alt'] , 1);
        $result = Articolo::loadNewArticle($newArticle);

        // se sono state settate categorie per l'articolo allora le carico nel db

        if(isset($_POST['category'])) {
            $selectedCat = array();
            foreach($_POST['category'] as $cat) {
                $res = Categoria::loadNewCategoryForArticle($cat, $articleId);  
            }
        }

        // controllo che l'operazione sia andata a buon fine
        if ($result) {
            header('Location: /pages/gestione_art.php?changed=true');
        } else {
            header('Location: /pages/gestione_art.php?changed=false');
        }
    } catch (Exception $e) {
        $handler->setOperationError($e->getMessage());
    }
}


$autore = User::getArticleAuthor($articolo->getID());
$categorieArticolo = Categoria::getCategorieArticolo($articolo->getID());
$categorie = Categoria::getCategorie();
$articleContent = (new ArticleBuilder)
    ->setTitle($articolo->getTitle())
    ->setDescription($articolo->getDescription())
    ->setContent($articolo->getContent())
    ->build(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/php/components/formArticleContent.phtml'));
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

        $listaCategoria .= $value->build(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/php/components/chooseCategoryFormArticle.phtml'));
    }
} else {
    // messaggio che dice che non ci sono categorie del db
    $listaCategoria = "<div>nessuna categoria presente</div>";
}

$handler->setParam("<formArticleContent />", $articleContent);
$handler->setParam("<listaCategorie />", $listaCategoria);
$handler->render();
