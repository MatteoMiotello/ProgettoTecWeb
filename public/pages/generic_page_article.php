<?php
// nel caso in cui non esistesse nessun id deve essere ritornato un errore
if ($_GET['art_id'])
    $id_articolo = $_GET['art_id'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/../php/library/TemplateHandler.php';
require_once __DIR__ .  '/../php/models/CheckValues.php';
require_once __DIR__ .  '/../php/models/Articolo.php';
require_once __DIR__ .  '/../php/models/Categoria.php';
require_once __DIR__ . '/../php/models/Comment.php';
require_once __DIR__ . '/../php/models/User.php';
require_once __DIR__ . '/../php/models/dBConnection.php';
require_once __DIR__ . '/../php/library/ArticleBuilder.php';
require_once __DIR__ . '/../php/library/CommentBuilder.php';
require_once __DIR__ . '/../php/library/voteBuilder.php';
require_once __DIR__ . '/../php/library/Access.php';
//require_once __DIR__ . '/php/library/voteHandler.php';
require_once __DIR__ . '/../php/library/VoteHandler.php';

$handler = new TemplateHandler();
$handler->setPageTitle('Articolo');
$filePath = __DIR__ . '/../html/generic_page_articolo_nuovo.html';
$handler->setContent(file_get_contents($filePath));

$connessione = DBAccess::openDBConnection();

// controllo che la connessione al db sia andata a buon fine, altrimenti stampo un messaggio di errore
if (!$connessione) {
    $handler->setOperationError("Errore nell'apertura del db");
    return;
}
else
    $handler->setNoOperation();

if (isset($_POST['comment']) && Access::isAuthenticated()) {
    if(CheckValues::sanitize($_POST['comment'])!='') {
        $utente = Access::getUser();
        $result = Comment::uploadNewComment($id_articolo, $utente->getId(), '' . $_POST['comment'] . '', '' . date("Y-m-d h:i:s") . '');
        $handler->setOperationDone("Messaggio inviato correttamente");
    }
    else {
        $handler->setOperationError("Inserisci un messaggio non vuoto");
    }
}

$articoloModel = Articolo::getArticolo($id_articolo);
$handler->setBreadcrumb($articoloModel->getTitle());
if (!empty($_SERVER['HTTP_REFERER'])) {
    if (strpos($_SERVER['HTTP_REFERER'], 'categorie.php')) {
        $handler->addLink('/apolato/pages/categorie.php', 'Categorie');
    }

    // reperisco il link alla categoria dalla quale arriva tramite referer
    if (strpos($_SERVER['HTTP_REFERER'], '?cat_name=')) {
        $array = explode('=', $_SERVER['HTTP_REFERER']);
        $categoryName = array_pop($array);
        $categoryName = ucfirst($categoryName);

        $linkTitle = 'Articoli della categoria: ' . $categoryName;

        $_SESSION['breadcrumbs_title'] = $linkTitle;
        $_SESSION['breadcrumbs_link'] = $_SERVER['HTTP_REFERER'];
        $_SESSION['id_art'] = $articoloModel->getID();
    }

    if ( strpos( $_SERVER['HTTP_REFERER'], 'index.php' )  ) {
        $_SESSION['breadcrumbs_title'] = 'Home';
        $_SESSION['breadcrumbs_link'] = '/apolato/index.php';
        $_SESSION['id_art'] = $articoloModel->getID();
    }
}

if ( isset( $_SESSION['breadcrumbs_title'] ) and isset( $_SESSION['breadcrumbs_link'] ) and isset( $_SESSION['id_art'] ) and $_SESSION['id_art'] == $articoloModel->getID() ) {
    if ( $_SESSION['breadcrumbs_title'] != 'Home' ) {
        $handler->addLink('/apolato/pages/categorie.php', 'Categorie');
    }
    $handler->addLink($_SESSION['breadcrumbs_link'], $_SESSION['breadcrumbs_title']);
}

if (!file_exists($filePath)) {
    throw new Exception('file non esistente');
}


// prelevo l'articolo dal db e costruisco la visualizzazione dello stesso tramite builder
$printArticolo = '';
if ($articoloModel) {
    $autore = User::getArticleAuthor($id_articolo);
    $listaCategorie = Categoria::getCategorieArticolo($articoloModel->getID());
    $nameAuthor = $autore->getName().' '.$autore->getSurname();
    $articolo = (new ArticleBuilder)
        ->setImgArticlePath($articoloModel->getImgPath())
        ->setImgArticleAlt($articoloModel->getAltImg())
        ->setTitle($articoloModel->getTitle())
        ->setContent($articoloModel->getContent())
        ->setImgPathAuthor($autore->getImg())
        ->setNameAuthor($nameAuthor)
        ->setEmailAuthor($autore->getEmail());
    if ($listaCategorie) {
        foreach ($listaCategorie as $categoria) {
            $articolo->addCategory($categoria->getNome());
        }
    }
    $printArticolo .= $articolo->build(file_get_contents(__DIR__ . '/../php/components/article.phtml'));
}
/**
 * Nel caso in cui non venisse trovato l'articolo si imposta un messaggio di errore attraverso il template
 */
else {
    //setto la pagina di errore come nuovo contenuto in modo da non avere tag fittizi presenti
    $filePath = __DIR__ . '/../html/error.html';
    $handler->setContent(file_get_contents($filePath));
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
            ->build(file_get_contents(__DIR__ . '/../php/components/previusComment.phtml'));
    }
} else  $comment = '<p>Nessun commento trovato</p>';

$votes = (new VoteBuilder);
// controllo se l'utente e' loggato, in tal caso puo' commentare l'articolo, altrimenti no
if (Access::isAuthenticated()) {
    $user = null;
    if (isset($_SESSION['user_id']) && Access::getUser()!=null)
        $user = Access::getUser();
    if ($user) {
        // se esiste una chiave di sessione per l'utente, e se effettivamente l'utente esiste allora
        //do la possibilita' di commentare l'articolo altrimenti se l'utente non esiste non mostro nulla
        $comment .= (new CommentBuilder)
            ->setImg($user->getImg())/* qui al posto di author va l'utente loggato */
            ->setArticleId($id_articolo)
            ->build(file_get_contents(__DIR__ . '/../php/components/newComment.phtml'));
        // se l'utente effettivamente esiste allora do anche la possibilita' di dare un voto all'articolo
        $votes->setAutenticationOptions();
        $voteHandler = new VoteHandler($articoloModel);

        if (isset($_GET['type'])) {
            if ($_GET['type'] == "up") {
                if($voteHandler->getVotes($user)==-1 || $voteHandler->getVotes($user)==0)
                  $voteHandler->addUpVote($user);
                else
                  $voteHandler->deleteUpVote($user);
            }
            elseif ($_GET['type'] == "down") {
                if($voteHandler->getVotes($user)==1 || $voteHandler->getVotes($user)==0)
                  $voteHandler->addDownVote($user);
                else
                  $voteHandler->deleteDownVote($user);
            }
        }

        if ($voteHandler->getVotes($user)==1) {
            $votes->setUpVotesColored();
        } elseif ($voteHandler->getVotes($user) == -1) {
            $votes->setDownVotesColored();
        } else {
            $votes->resetVotesColored();
        }
    }
}

// Prendo il numero di upVotes e downVotes per questo articolo dal db
$upVotes = Articolo::getUpVotesFromArticle($id_articolo);
$downVotes = Articolo::getDownVotesFromArticle($id_articolo);
// Inserisco i valori tornati
$votes->setUpVotes($upVotes['SUM(voto.up)'])
    ->setDownVote($downVotes['SUM(voto.down)'])
    ->setArticleId($id_articolo);

$votes = $votes->build(file_get_contents(__DIR__ . '/../php/components/commentArea.phtml'));

$handler->setParam("<commentArea />", $votes);
$handler->setParam("<listaCommenti />", $comment);

$handler->setParam("<articolo />", $printArticolo);

$handler->render();
