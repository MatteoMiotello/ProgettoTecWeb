<?php
// nel caso in cui non esistesse nessun id deve essere ritornato un errore
if ($_GET['art_id'])
    $id_articolo = $_GET['art_id'];
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require $_SERVER['DOCUMENT_ROOT'] . '/php/library/TemplateHandler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/modello.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/models/Comment.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/models/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dBConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/ArticleBuilder.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/CommentBuilder.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/Access.php';

$connessioneRiuscita = DBAccess::openDBConnection();

//TODO: sistemare
if ($connessioneRiuscita && isset($_POST['comment'])) {
    $utente = 125333;
    Comment::uploadNewComment($id_articolo, $utente, '' . $_POST['comment'] . '', '' . date("Y-m-d h:i:s") . '', $connessioneRiuscita);
}

$handler = new TemplateHandler();
$handler->setPageTitle('Articolo');
$handler->setBreadcrumb('Articolo');
$filePath = $_SERVER['DOCUMENT_ROOT'] . '/html/generic_page_articolo_nuovo.html';

$handler->setContent(file_get_contents($filePath));
if (strpos($_SERVER['HTTP_REFERER'], 'categorie.php')) {
    $handler->addLink('/pages/categorie.php', 'Categorie');
}

// reperisco il link alla categoria dalla quale arriva tramite referer
if (strpos($_SERVER['HTTP_REFERER'], '?cat_name=')) {
    $array = explode('=', $_SERVER['HTTP_REFERER']);
    $categoryName = array_pop($array);
    $categoryName = ucfirst($categoryName);

    $linkTitle = 'Categoria: ' . $categoryName;
    $handler->addLink('/pages/categorie.php', 'Categorie');

    $handler->addLink($_SERVER['HTTP_REFERER'], $linkTitle);
}

if (!file_exists($filePath)) {
    throw new Exception('file non esistente');
}


if (!$connessioneRiuscita)
    die("Errore nell'apertura del db"); // non si prosegue all'esecuzione della pagina
else {
    $printArticolo = '';
    $articolo = Articolo::getArticolo($id_articolo);

    if ($articolo) {
        $autore = User::getArticleAuthor($articolo->getID());
        $listaCategorie = Categoria::getCategorieArticolo($articolo->getID());
        $articolo = (new ArticleBuilder)
            ->setImgArticlePath($articolo->getImgPath())
            ->setImgArticleAlt($articolo->getAltImg())
            ->setTitle($articolo->getTitle())
            ->setContent($articolo->getContent())
            ->setImgPathAuthor($autore->getImg())
            ->setNameAuthor($autore->getName())
            ->setEmailAuthor($autore->getEmail());
        if ($listaCategorie) {
            foreach ($listaCategorie as $categoria) {
                $articolo->addCategory($categoria->getNome());
            }
        }
        $printArticolo .= $articolo->build(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/php/components/article.phtml'));
    } 
    /**
     * Nel caso in cui non venisse trovato l'articolo si imposta un messaggio di errore attraverso il template
     */
    else {
        $handler->setOperationError("Nessun articolo trovato, you tried ;)");
        $handler->setParam("<commentArea />", "");
        $handler->render();
        return;
    }
    $rawComments = Comment::getCommentsFromArticle($id_articolo);
    if ($rawComments) {
        $comment = '';
        foreach ($rawComments as $rawCommento) {
            $author = Access::getUser();
            $comment .= (new CommentBuilder)
                ->setComment($rawCommento->getTesto())
                ->setName($author->getName())
                ->setSurname($author->getSurname())
                ->setImg($author->getImg())
                ->build(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/php/components/previusComment.phtml'));
        }
    } 
    else  $comment = '<p>Nessun commento trovato</p>';
    // controllo se l'utente e' loggato, in tal caso puo' commentare l'articolo
    if(Access::isAuthenticated()) {
        $user = null;
        if(isset($_SESSION['user_id']))
            $user = Access::getUser();
        if($user) {
            $comment .= (new CommentBuilder)
            ->setImg($user->getImg())/* qui al posto di author va l'utente loggato */
            ->setArticleId($id_articolo)
            ->build(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/php/components/newComment.phtml'));
        }
    }
}
$handler->setParam("<articolo />", $printArticolo);
$handler->setParam("<commentArea />", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/php/components/commentArea.phtml'));
$handler->setParam("<listaCommenti />", $comment);

$handler->render();
