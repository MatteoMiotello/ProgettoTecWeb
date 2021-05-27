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
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/voteBuilder.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/Access.php';
//require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/voteHandler.php';
require_once '../php/library/VoteHandler.php';

$handler = new TemplateHandler();
$handler->setPageTitle('Articolo');
$handler->setBreadcrumb('Articolo');
$filePath = $_SERVER['DOCUMENT_ROOT'] . '/html/generic_page_articolo_nuovo.html';
$handler->setContent(file_get_contents($filePath));

$connessioneRiuscita = DBAccess::openDBConnection();

if ($connessioneRiuscita && isset($_POST['comment']) && Access::isAuthenticated()) {
    $utente = Access::getUser();
    $result = Comment::uploadNewComment($id_articolo,'', $utente->getId() , '' .$_POST['comment'] . '', '' . date("Y-m-d h:i:s") . '', $connessioneRiuscita);
}

if ( !empty( $_SERVER['HTTP_REFERER'] ) ) {
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
}


if (!file_exists($filePath)) {
    throw new Exception('file non esistente');
}


if (!$connessioneRiuscita)
    die("Errore nell'apertura del db"); // non si prosegue all'esecuzione della pagina
else {
    // prelevo l'articolo dal db e costruisco la visualizzazione dello stesso tramite builder
    $printArticolo = '';
    $articoloModel = Articolo::getArticolo($id_articolo);
    if ($articoloModel) {
        $autore = User::getArticleAuthor($articoloModel->getID());
        $listaCategorie = Categoria::getCategorieArticolo($articoloModel->getID());
        $articolo = (new ArticleBuilder)
            ->setImgArticlePath($articoloModel->getImgPath())
            ->setImgArticleAlt($articoloModel->getAltImg())
            ->setTitle($articoloModel->getTitle())
            ->setContent($articoloModel->getContent())
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
    // prelevo i commenti dell'articolo da visualizzare dal db
    $rawComments = Comment::getCommentsFromArticle($id_articolo);
    if ($rawComments) {
        $comment = '';
        foreach ($rawComments as $rawCommento) {
            $author = $rawCommento->getAuthor();
            $comment .= (new CommentBuilder)
                ->setComment($rawCommento->getTesto())
                ->setName($author->getName())
                ->setSurname($author->getSurname())
                ->setImg($author->getImg())
                ->build(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/php/components/previusComment.phtml'));
        }
    }
    else  $comment = '<p>Nessun commento trovato</p>';

    $upVotes = Articolo::getUpVotesFromArticle($id_articolo);
    $downVotes = Articolo::getDownVotesFromArticle($id_articolo);
    $votes = (new VoteBuilder)
    ->setUpVotes($upVotes['SUM(voto.up)'])
    ->setDownVote($downVotes['SUM(voto.down)'])
    ->setArticleId($id_articolo);
    // controllo se l'utente e' loggato, in tal caso puo' commentare l'articolo, altrimenti no
    if(Access::isAuthenticated()) {
        $user = null;
        if(isset($_SESSION['user_id']))
            $user = Access::getUser();
        if($user) {
            // se esiste una chiave di sessione per l'utente, e se effettivamente l'utente esiste allora
            //do la possibilita' di commentare l'articolo altrimenti se l'utente non esiste non mostro nulla
            $comment .= (new CommentBuilder)
            ->setImg($user->getImg())/* qui al posto di author va l'utente loggato */
            ->setArticleId($id_articolo)
            ->build(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/php/components/newComment.phtml'));
            // se l'utente effettivamente esiste allora do anche la possibilita' di dare un voto all'articolo
            $votes->setAutenticationOptions();
            $voteHandler = new VoteHandler( $articoloModel );

            if ( isset( $_GET['type'] ) ) {
                if ($_GET['type'] == "up") {
                    $voteHandler->addUpVote($user);
                    header("Refresh: 0; url=generic_page_article.php?art_id=$id_articolo");
                } elseif ($_GET['type'] == "down") {
                    $voteHandler->addDownVote($user);
                    header("Refresh: 0; url=generic_page_article.php?art_id=$id_articolo");
                }
            }

            if ( $voteHandler->getVotes( $user ) ) {
                $votes->setUpVotesColored(  );
            } elseif ( $voteHandler->getVotes( $user ) === false ) {
                $votes->setDownVotesColored(  );
            } else {
                $votes->resetVotesColored();
            }
        }
    }
    $votes = $votes->build(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/php/components/commentArea.phtml'));
}
$handler->setParam("<commentArea />", $votes);
$handler->setParam("<listaCommenti />", $comment);

$handler->setParam("<articolo />", $printArticolo);

$handler->render();
