<?php
// nel caso in cui non esistesse nessun id deve essere ritornato un errore
if($_GET['art_id'])
    $id_articolo = $_GET['art_id'];
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require $_SERVER['DOCUMENT_ROOT'] . '/php/library/TemplateHandler.php' ;
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/modello.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/models/Comment.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/models/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dBConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/ArticleBuilder.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/CommentBuilder.php';

$dbAccess = new DBAccess();
$connessioneRiuscita = DBAccess::openDBConnection();
$connessioneRiuscita = $connessioneRiuscita->getConnection();

if($connessioneRiuscita && isset($_POST['comment'])) {
    $utente = 125333;
    Comment::uploadNewComment($id_articolo, $utente,''. $_POST['comment'].'', ''.date("Y-m-d h:i:s").'', $connessioneRiuscita);
}

$handler = new TemplateHandler();
$handler->setPageTitle('Articolo');
$filePath = $_SERVER['DOCUMENT_ROOT'].'/html/generic_page_articolo_nuovo.html';

if ( !file_exists( $filePath ) ) {
    throw new Exception( 'file non esistente' );
}

$handler->setContent(file_get_contents($filePath));

if (!$connessioneRiuscita)
    die("Errore nell'apertura del db"); // non si prosegue all'esecuzione della pagina
else {
$printArticolo = '';
$articolo = Articolo::getArticolo($id_articolo, $connessioneRiuscita);

if($articolo != null) {
    $autore = User::getArticleAuthor($articolo->getID(), $connessioneRiuscita);
    $listaCategorie = Categoria::getCategorieArticolo($articolo->getID(), $connessioneRiuscita);
    $articolo = (new ArticleBuilder)
    ->setImgArticlePath($articolo->getImgPath())
    ->setImgArticleAlt($articolo->getAltImg())
    ->setTitle($articolo->getTitolo())
    ->setContent($articolo->getTesto())
    ->setImgPathAuthor($autore->getImg())
    ->setNameAuthor($autore->getName())
    ->setEmailAuthor($autore->getEmail());
    if($listaCategorie) {
        foreach($listaCategorie as $categoria) {
            $articolo->addCategory($categoria->getNome());
        }
    } 
    $printArticolo .= $articolo->build(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/php/components/article.phtml'));
}
else {
    $printArticolo .= "<div>Nessun articolo presente</div>";
}
$rawComments = Comment::getCommentsFromArticle($connessioneRiuscita, $id_articolo);
if($rawComments) {
    $comment = '';
    foreach($rawComments as $rawCommento) {
        $author = User::getUserById($connessioneRiuscita, $rawCommento->getIdAutore());
        $comment .= (new CommentBuilder)
        ->setComment($rawCommento->getTesto())
        ->setName($author->getName())
        ->setSurname($author->getSurname())
        ->setImg($author->getImg())
        ->build(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/php/components/previusComment.phtml'));
    }
    // controllo se l'utente e' loggato o meno
    $comment .= (new CommentBuilder)
    ->setImg($author->getImg()) /* qui al posto di author va l'utente loggato */
    ->setArticleId($id_articolo)
    ->build(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/php/components/newComment.phtml'));
}
else  $comment = '<p>Nessun commento trovato</p>';
}
$handler->setParam("<articolo />", $printArticolo);
$handler->setParam("<listaCommenti />", $comment);

$handler->render();
