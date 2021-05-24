<?php
$CategoryName = $_GET['cat_name'];
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require $_SERVER['DOCUMENT_ROOT'] . '/php/library/TemplateHandler.php' ;
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/modello.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dBConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'] .  '/php/library/PreviewArticleBuilder.php';

$connessioneRiuscita = DBAccess::openDBConnection();
// TODO: manca la parte in cui vengono raccolt i valori 
$handler = new TemplateHandler();
$handler->setPageTitle('Registrati'.$CategoryName);
/*$handler->setBreadcrumb( 'Articoli della categoria: ' . $CategoryName )
    ->addLink( '/index.php', 'Home' )
    ->addLink( '/pages/categorie.php', 'Categorie' );*/

$filePath = $_SERVER['DOCUMENT_ROOT'].'/html/registrati_nuovo.html';

$handler->setContent(file_get_contents($filePath));

if ($connessioneRiuscita == null)
    die("Errore nell'apertura del db"); // non si prosegue all'esecuzione della pagina 
else {
}

$handler->render(); 

?>

