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

$connessioneRiuscita = DBAccess::openDBConnection();

$handler = new TemplateHandler();
$handler->setPageTitle('Form Articolo');
$handler->setBreadcrumb('Scrivi un articolo');

$filePath = $_SERVER['DOCUMENT_ROOT'] . '/html/form_articolo_nuovo.html';

$handler->setContent(file_get_contents($filePath));
$handler->setCurrentRoute('form_articolo');

if (!$connessioneRiuscita)
    die("Errore nell'apertura del db"); // non si prosegue all'esecuzione della pagina
else {
    /**
     * controllo che l'utente sia loggato 
    */ 
    $author = null;
    $articleContent = '';
    if(Access::isAuthenticated()) {
        if(isset($_SESSION['user_id']))
            $author = Access::getUser();
    } 
    /**
     * controllo se la form e' gia' stata compilata, in tal caso emetto un messaggio di avvenuta operazione con relativo esito
     */
    if (isset($_POST['titolo_art']) && isset($_POST['descr_art']) && isset($_POST['testo_art']) && $author) {
        try{
            $newArticle = new Articolo(1, $_POST['titolo_art'], $_POST['descr_art'], $_POST['testo_art'], $author->getId(), date('Y-m-d h:i:s'), 0,0,' ', ' ',0 );
            $result = Articolo::loadNewArticle($newArticle);
            // controllo che l'operazione sia andata a buon fine
            if($result)
                $articleContent = '<article class="articolo_validato" ><p>Articolo inviato correttamente</p></article>';
            else 
                $articleContent = '<article class="articolo_non_validato" ><p>Errore nel database, l\'articolo non è stato salvato!</p></article>';

        }
        catch(Exception $e) {
            // qui sarebbe da settare l'errore direttamente nel template e rendirizzare quello
            $articleContent = '<article class="articolo_non_validato" ><p>'.$e->getMessage().'</p></article>';
        }
        
    }
    /**
     * Nel caso non fosse stata compilata la form allora presento la pagina per poter scrivere l'articolo
     */
    else {
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
    }
    $handler->render();
}
