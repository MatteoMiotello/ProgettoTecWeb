<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require( '../php/library/TemplateHandler.php' );
require_once('../php/modello.php');
require_once('../php/dBConnection.php');

$dbAccess = new DBAccess();
$connessioneRiuscita = DBAccess::openDBConnection();
$connessioneRiuscita = $connessioneRiuscita->getConnection();

$handler = new TemplateHandler();
$handler->setPageTitle('Categorie');
$filePath = $_SERVER['DOCUMENT_ROOT'].'/html/cat_nuovo.html';
$handler->setContent(file_get_contents($filePath));

if (!$connessioneRiuscita)
    die("Errore nell'apertura del db"); // non si prosegue all'esecuzione della pagina
else {
$categorie = Categoria::getCategorie($connessioneRiuscita);
if ($categorie != null) {
    $listaCategoria = "<div class="."cat_page".">";
    foreach ($categorie as $singolaCategoria) {
        $listaCategoria .= '<a href="article_filter.html/?cat_name='. $singolaCategoria->getNome() . '">';
        $listaCategoria .= '<figure>';
        $listaCategoria .= '<img src="'.$singolaCategoria->getImg().'" alt="'.$singolaCategoria->getDescrizione().'">';
        $listaCategoria .= '<figcaption>'. $singolaCategoria->getNome() . '</figcaption>';
        $listaCategoria .= '</figure>';
        $listaCategoria .= '</a>';
    }
    $listaCategoria = $listaCategoria . "</div>";
} else {
    // messaggio che dice che non ci sono categorie del db
    $listaCategoria = "<div>nessuna categoria presente</div>";
}
$handler->setParam("<listaCategorie />",$listaCategoria);
$handler->render(); 
}
