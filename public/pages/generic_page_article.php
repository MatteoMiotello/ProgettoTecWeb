<?php
// nel caso in cui non esistesse nessun id deve essere ritornato un errore
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
        print($rawCommento->getTesto(). " ");
        $author = User::getUserById($connessioneRiuscita, $rawCommento->getIdAutore());
        $comment .= (new CommentBuilder)
        ->setComment($rawCommento->getTesto())
        ->setName($author->getName())
        ->setSurname($author->getSurname())
        ->build(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/php/components/comment.phtml'));
    }
}
else  $comment = '<p>Nessun commento trovato</p>';
}
$handler->setParam("<articolo />", $printArticolo);
$handler->setParam("<listaCommenti />", $comment);

$handler->render();
