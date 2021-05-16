<?php
$id_articolo = $_GET['art_id'];
print($id_art);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require $_SERVER['DOCUMENT_ROOT'] . '/php/library/TemplateHandler.php' ;
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/modello.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dBConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/ArticleBuilder.php';

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
$autore = User::getArticleAuthor($articolo->getID(), $connessioneRiuscita);
$listaCategorie = Categoria::getCategorieArticolo($articolo->getID(), $connessioneRiuscita);

if($articolo != null) {
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
 /*   $printArticolo .= '<div class="printArticolo">';
    $printArticolo .= '<div class="upperPrint">';
    $printArticolo .= '<img src="'.$articolo->getImgPath().'" alt="'.$articolo->getAltImg().'">';
    $printArticolo .= '<h1>'.$articolo->getTitolo().'</h1>';
    $printArticolo .= '</div>';
    $printArticolo .= '<p>'.$articolo->getTesto().'</p>';
    $printArticolo .= '</div>';
    $printArticolo .=  '<div class="info_art">';
    $printArticolo .= '<div id="author">';
    if($autore) {
        $printArticolo .= '<img src="'.$autore->getImg().'">';
        $printArticolo .= '<p>'.$autore->getName().'</p>';
        $printArticolo .= '<p>'.$autore->getEmail().'</p>';
    }
    else $printArticolo .= '<p>Autore non presente</p>';
    $printArticolo .= '</div>'; 
    $printArticolo .= '<div id="get_cat">';
    if($listaCategorie) {
        foreach($listaCategorie as $categoria) {
            $printArticolo .= '<p>'.$categoria->getNome().'</p>';
        }
    }   
    else $printArticolo .= '<p>Categoria non presente</p>';
    $printArticolo .= '</div>';
    $printArticolo .= '</div>';*/
}
else {
    $printArticolo .= "<div>Nessun articolo presente</div>";
}
}
$handler->setParam("<articolo />", $printArticolo);

$handler->render(); 
?>