<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require $_SERVER['DOCUMENT_ROOT'] . '/php/library/TemplateHandler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/modello.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dBConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'] .  '/php/library/CategoryBuilder.php';
require_once $_SERVER['DOCUMENT_ROOT'] .  '/php/library/ArticleBuilder.php';
require_once $_SERVER['DOCUMENT_ROOT'] .  '/php/library/Access.php';

$connessione = DBAccess::openDBConnection();

$handler = new TemplateHandler();
$handler->setPageTitle('Form Articolo');
$handler->setBreadcrumb('Scrivi un articolo');

$filePath = $_SERVER['DOCUMENT_ROOT'] . '/html/form_articolo_nuovo.html';

$handler->setContent(file_get_contents($filePath));
$handler->setCurrentRoute('form_articolo');

// controllo che la connessione al db sia andata a buon fine, altrimenti stampo un messaggio di errore
if (!$connessione) {
    $handler->setOperationError("Errore nell'apertura del db");
    return;
} else
    $handler->setNoOperation();

/**
 * controllo che l'utente sia loggato 
 */
$author = null;
$articleContent = '';
if (Access::isAuthenticated()) {
    if (isset($_SESSION['user_id']))
        $author = Access::getUser();
} else {
    $handler->setOperationError("Non hai eseguito il login! Esegui il login per poter inviarci il tuo elaborato!");
}
/**
 * controllo se la form e' gia' stata compilata, in tal caso emetto un messaggio di avvenuta operazione con relativo esito
 */
if (isset($_POST['titolo_art']) && isset($_POST['descr_art']) && isset($_POST['testo_art']) && $author) {
    try {
        // provo a caricare l'articolo nel db
        $articleId = Articolo::getMaxId()+1;
        $authorId = $author->getId();
        $newArticle = new Articolo($articleId, $_POST['titolo_art'], $_POST['descr_art'], $_POST['testo_art'], $authorId, date('Y-m-d G:i:s'), '0', '0', 'nada', 'nada', 0);
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
            $handler->setOperationDone("Articolo inviato correttamente");
        } else {
            $handler->setOperationError("Errore, i valori inseriti non rispettano gli standard richiesti, l\'articolo non è stato salvato!");
        }
    } catch (Exception $e) {
        $handler->setOperationError($e->getMessage());
    }
}
/**
 * Presento la pagina per poter scrivere l'articolo
 */
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
$articleContent .= (new ArticleBuilder)->build(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/php/components/formArticleContent.phtml'));
$handler->setParam("<listaCategorie />", $listaCategoria);
$handler->setParam("<formArticleContent />", $articleContent);
$handler->render();
