<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require( './php/library/TemplateHandler.php' );
require_once('./php/modello.php');
require_once('./php/dBConnection.php');

$handler = new TemplateHandler();
$handler->setPageTitle('Home');
$handler->setCurrentRoute( 'cat' );

$dbAccess = new DBAccess();


$connessioneRiuscita = DBAccess::openDBConnection();
$connessioneRiuscita = $connessioneRiuscita->getConnection();

$filePath = $_SERVER['DOCUMENT_ROOT'].'/html/index_nuovo.html';
if ( !file_exists( $filePath ) ) {
    throw new Exception( 'file non esistente' );
}
$handler->setContent(file_get_contents($filePath));

if ($connessioneRiuscita == null)
    die("Errore nell'apertura del db"); // non si prosegue all'esecuzione della pagina 
else {
    $rawArticles = Articolo::getArticoli(null, $connessioneRiuscita);
    $articlesList = '';
    if ($rawArticles != null) {
        foreach ($rawArticles as $articolo) {
          $autore = User::getArticleAuthor($articolo->getID(), $connessioneRiuscita);
            $articlesList .= '<article class="articolo" >';
            $articlesList .= '<img src="'.$articolo->getImgPath().'" class="fotoArticolo"  alt="'. $articolo->getAltImg() .'" />';
            $articlesList .= '<div>';
            $articlesList .= '<h3>' . $articolo->getTitolo() . '</h1>';
            $articlesList .= '<p>' . $articolo->getDescrizione();
            $articlesList .= ' <a href="generic_page_articolo.html/?art_id={id}">Continua a leggere</a>';
            $articlesList .=  ' </p>';
            $articlesList .= '</div>';
            $articlesList .= '</article>';
        }
    } else {
        // messaggio che dice che non ci sono articoli del db
        $articlesList = "<div>nessun articolo presente</div>";
    }
}

$handler->setParam("<listaArticoli />",$articlesList);
$handler->render(); 
?>